<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
		if(isset($_SESSION["userId"])){
			$userId = $_SESSION["userId"];
			$Model = new Model();
				$sql = "select U.user_id,U.user_avatar,U.user_name,B.blog_id,B.blog_time,B.blog_content,B.blog_pic,IFNULL(D.commentNum,0) as commentCount,IFNULL(E.likeNum,0) as likeCount,IFNULL(I.like_user_id,0) as isLike
						from zm_blog B
						left join zm_user U on U.user_id = B.blog_author_id
						left join (select C.comment_blog_id,count(*) as commentNum from zm_comment C group by C.comment_blog_id ) D
						on D.comment_blog_id = B.blog_id
						left join (select L.like_blog_id,count(*) as likeNum from zm_blog_like L group by L.like_blog_id )E
						on E.like_blog_id = B.blog_id
						left join (select Z.like_user_id,Z.like_blog_id from zm_blog_like Z where Z.like_user_id = '$userId')I
						on I.like_blog_id = B.blog_id
						where B.blog_type = 'mood'
						order by B.blog_time desc";
			$allNewsList = $Model->query($sql);
// 		print_r($allNewsList);exit();
			$this->assign('empty','<span class="empty">还木有动态哦</span>');
			$this->assign("allNewsList",$allNewsList);
			$this->display();
		}else{
			$this->redirect('Login/index',array('uid'=>1));
		}
    }

	public function blogDetail(){
		$blogId = $_GET["blogId"];
		$userId = $_SESSION["userId"];
		$Model = new Model();
		$sql = "select U.user_id,U.user_avatar,U.user_name,B.blog_id,B.blog_time,B.blog_content,B.blog_pic,IFNULL(D.commentNum,0) as commentCount,IFNULL(E.likeNum,0) as likeCount,IFNULL(I.like_user_id,0) as isLike
						from zm_blog B
						left join zm_user U on U.user_id = B.blog_author_id
						left join (select C.comment_blog_id,count(*) as commentNum from zm_comment C where  C.comment_blog_id = '$blogId' ) D
						on D.comment_blog_id = B.blog_id
						left join (select L.like_blog_id,count(*) as likeNum from zm_blog_like L where L.like_blog_id = '$blogId' )E
						on E.like_blog_id = B.blog_id
						left join (select Z.like_user_id,Z.like_blog_id from zm_blog_like Z where Z.like_user_id = '$userId' AND Z.like_blog_id = '$blogId')I
						on I.like_blog_id = B.blog_id
						where B.blog_type = 'mood' and B.blog_id = '$blogId' ";
		$blogInfo = $Model->query($sql);
		$this->assign("blogInfo",$blogInfo[0]);

		$sql2 = "select U.user_id,U.user_avatar,U.user_name,C.comment_blog_id,C.comment_time,C.comment_content
				 from zm_comment C
				 left join zm_user U on U.user_id = C.comment_user_id
				 where C.comment_blog_id = '$blogId'";
		$commentInfo = $Model->query($sql2);
		$this->assign("commentList",$commentInfo);

		$sql3 = "select U.user_id,U.user_avatar,U.user_name
				 from zm_blog_like L
				 left join zm_user U on U.user_id = L.like_user_id
				 where L.like_blog_id = '$blogId'";
		$likeInfo = $Model->query($sql3);
		$this->assign("likeList",$likeInfo);

		$this->display();
	}

	public function addBlog(){
		$blogContent = $_POST["blogContent"];
		$sendType = $_POST["sendType"];
		$picPath = "";
		if($_FILES["pic"]["name"] != ""){
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			//$upload->maxSize  = 13145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Public/upload/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
			}
			$picPath = $info[0]["savename"];
		}
		$userId = $_SESSION["userId"];
		$blog = M('blog');
		$data["blog_author_id"] = $userId;
		$data["blog_content"] = $blogContent;
		$data["blog_type"] = $sendType;
		$data["blog_pic"] = $picPath;
		$blog->add($data);
		if($sendType == 'help'){
			$this->redirect('Help/index');
		}else if($sendType == 'secret'){
			$this->redirect('Persoanal/showSecret');
		}else{
			$this->redirect('Index/index');
		}

	}

	public function comment(){
		$this->display();
	}

	public function addComment(){
		$blogId = $_POST["blogId"];
		$commentBody = $_POST["commentBody"];
		$userId = $_SESSION["userId"];
		$comment = M("comment");
		$data["comment_user_id"] = $userId;
		$data["comment_blog_id"] = $blogId;
		$data["comment_content"] = $commentBody;
		if($comment->add($data)){
			$this->ajaxReturn("","评论成功",1);
		}else{
			$this->ajaxReturn("","评论失败",-1);
		}
	}

	public function isLike(){
		$blogId = $_POST["blogId"];
		$userId = $_POST["userId"];
		$isLike = $_POST["isLike"];
		$blogLike = M("blog_like");
		$LikeCondition["like_user_id"] = $userId;
		$LikeCondition["like_blog_id"] = $blogId;

		$like = $blogLike->where($LikeCondition)->select();

		if($like != NULL){
			if($blogLike->where($LikeCondition)->delete()){
				$this->ajaxReturn("","取消赞成功",1);
			}else{
				$this->ajaxReturn("","取消赞失败",-1);
			}
		}else{
			if($blogLike->add($LikeCondition)){
				$this->ajaxReturn("","赞成功",1);
			}else{
				$this->ajaxReturn("","赞失败",-1);
			}
		}
	}

	public function temp(){
		$this->display();
	}

	public function temp1(){
		if($_FILES["myfile"]["name"] != ""){
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			//$upload->maxSize  = 13145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Public/upload/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
			}
			$picPath = $info[0]["savename"];
			var_dump($picPath);exit();
		}else{
			var_dump($_FILES);exit();
		}

//		$this->display();
	}

	public function search(){
		$this->display();
	}
}