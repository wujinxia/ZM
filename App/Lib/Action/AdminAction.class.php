<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 15/4/3
 * Time: 下午3:22
 */

class AdminAction extends Action {
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
						left join (select Z.like_user_id,Z.like_blog_id from zm_blog_like Z)I
						on I.like_blog_id = B.blog_id
						order by B.blog_time desc";
			$allNewsList = $Model->query($sql);
			$this->assign('empty','<span class="empty">还木有动态哦</span>');
			$this->assign("allNewsList",$allNewsList);

			$user = M("user");
			$userList = $user->select();
			$this->assign("userList",$userList);
			$this->display();
		}else{
			$this->redirect('Login/index',array('uid'=>1));
		}

	}

	public function delBlog(){
		$blogId = $_GET['blogId'];
		$blog = M("blog");
		if($blog->where("blog_id='$blogId' ")->delete()){
			 $this->ajaxReturn("$blogId",'删除成功',1);
		}else{
			$this->ajaxReturn("$blogId",' 删除失败',-1);
		}
	}

	public function delUser(){
		$userId = $_GET['userId'];
		$user = M("user");
		if($user->where("user_id='$userId' ")->delete()){
			$this->ajaxReturn($userId,'删除成功',1);
		}else{
			$this->ajaxReturn($userId,' 删除失败',-1);
		}
	}

	public function home(){
		$this->display();
	}


}