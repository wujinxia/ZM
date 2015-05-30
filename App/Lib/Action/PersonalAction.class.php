<?php
// 个人信息
class PersonalAction extends Action {
    public function index(){

		if(isset($_SESSION["userId"])){
			$user = M("user");
			$data["user_id"] = $_SESSION["userId"];
			$userInfo = $user->where($data)->find();
			$this->assign("userInfo",$userInfo);
			$this->display();
		}else{
			$this->redirect('Login/index',array('uid'=>1));
		}
    }

	public function showSecret(){
		if(isset($_SESSION["userId"])){
			$userId = $_SESSION["userId"];
			$Model = new Model();
			$sql = "select U.user_id,U.user_avatar,U.user_name,B.blog_id,B.blog_time,B.blog_content,B.blog_pic
						from zm_blog B
						left join zm_user U on U.user_id = B.blog_author_id
						where B.blog_type = 'secret' and B.blog_author_id = '$userId'
						order by B.blog_time desc";
			$allSecretList = $Model->query($sql);
			$this->assign('empty','<span class="empty">要不写点，别人看不到哦</span>');
			$this->assign("allSecretList",$allSecretList);
			$this->display();
		}else{
			$this->redirect('Login/index',array('uid'=>1));
		}
	}

	public function showHelp(){
		$userId = $_SESSION["userId"];
		if(isset($_SESSION["userId"])){
			$Model = new Model();
			$sql = "select U.user_id,U.user_avatar,U.user_name,B.blog_id,B.blog_time,B.blog_content,IFNULL(D.commentNum,0) as commentCount
						from zm_blog B
						left join zm_user U on U.user_id = B.blog_author_id
						left join (select C.comment_blog_id,count(*) as commentNum from zm_comment C group by C.comment_blog_id ) D
						on D.comment_blog_id = B.blog_id
						where B.blog_type = 'help' and B.blog_author_id = '$userId'
						order by B.blog_time desc";
			$allHelpList = $Model->query($sql);
//			print_r(allHelpList);exit();
			$this->assign('empty','<span class="empty">还木有求助信息哦</span>');
			$this->assign("allHelpList",$allHelpList);
			$this->display("Help:index");
		}else{
			$this->redirect('Login/index',array('uid'=>1));
		}
	}

	public function myBlog(){
		$userId = $_GET["userId"];
		if(isset($_SESSION["userId"])){
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
						where B.blog_type = 'mood' and B.blog_author_id = '$userId'
						order by B.blog_time desc";
			$allNewsList = $Model->query($sql);
			$this->assign('empty','<span class="empty">还木有动态哦</span>');
			$this->assign("allNewsList",$allNewsList);
			$user = M("user");
			$data["user_id"] = $userId;
			$userInfo = $user->where($data)->find();
			$this->assign("userInfo",$userInfo);

			$this->display();
		}else{
			$this->redirect('Login/index',array('uid'=>1));
		}
	}

	public function personalInfo(){
		$userId = $_GET["userId"];
		$user = M("user");
		$data["user_id"] = $userId;
		$userInfo = $user->where($data)->find();
		$this->assign("userInfo",$userInfo);
		$this->display();
	}

	public function changeAvatar(){
		$userId = $_SESSION["userId"];
		if($_FILES["avatar"]["name"] != ""){
			import('ORG.Net.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			//$upload->maxSize  = 13145728 ;// 设置附件上传大小
			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Public/image/avatar/';// 设置附件上传目录
			if(!$upload->upload()) {// 上传错误提示错误信息
				$this->error($upload->getErrorMsg());
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
			}
			$picPath = $info[0]["savename"];

			$user = M('user');
			$data["user_id"] = $userId;
			$data["user_avatar"] = $picPath;
			$user->save($data);
		}

		$this->redirect('Personal/personalInfo',array('userId'=>$userId));
	}

	public function updateInfo(){
		$user = M("user");
		$data["user_id"] = $_SESSION["userId"];
		$data["user_grade"] = $_POST["grade"];
		$data["user_qq"] = $_POST["qq"];
		$data["user_phone"] = $_POST["phone"];
		$data["user_major"] = $_POST["major"];
		$data["user_place"] = $_POST["place"];
		if($user->save($data)){
			$this->ajaxReturn('', '修改成功', 1);
		}else{
			$this->ajaxReturn('', '修改失败', -1);
		}
	}

	public function followList(){
		$this->display();
	}
}