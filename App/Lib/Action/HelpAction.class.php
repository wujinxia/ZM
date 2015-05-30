<?php
// 本类由系统自动生成，仅供测试用途
class HelpAction extends Action {
    public function index(){
		$userId = $_SESSION["userId"];
		if(isset($_SESSION["userId"])){
			$Model = new Model();
			$sql = "select U.user_id,U.user_avatar,U.user_name,B.blog_id,B.blog_time,B.blog_content,IFNULL(D.commentNum,0) as commentCount
						from zm_blog B
						left join zm_user U on U.user_id = B.blog_author_id
						left join (select C.comment_blog_id,count(*) as commentNum from zm_comment C group by C.comment_blog_id ) D
						on D.comment_blog_id = B.blog_id
						where B.blog_type = 'help' and B.blog_author_id != '$userId'
						order by B.blog_time desc";
			$allHelpList = $Model->query($sql);
//			print_r(allHelpList);exit();
			$this->assign('empty','<span class="empty">还木有求助信息哦</span>');
			$this->assign("allHelpList",$allHelpList);
			$this->display();
		}else{
			$this->redirect('Login/index',array('uid'=>1));
		}
    }

	public function helpInfo(){
		$BeHelpId = $_GET["BeHelpId"];
		$blogId = $_GET["blogId"];
		$userId = $_SESSION["userId"];
		$Model = new Model();
		$sql = "select U.user_id,U.user_avatar,U.user_name,B.blog_id,B.blog_time,B.blog_content,IFNULL(D.commentNum,0) as commentCount
						from zm_blog B
						left join zm_user U on U.user_id = B.blog_author_id
						left join (select C.comment_blog_id,count(*) as commentNum from zm_comment C where  C.comment_blog_id = '$blogId' ) D
						on D.comment_blog_id = B.blog_id
						where B.blog_type = 'help' and B.blog_id = '$blogId' ";
		$HelpInfo = $Model->query($sql);
//		var_dump($HelpInfo);exit();
		$this->assign("helpInfo",$HelpInfo[0]);

		$sql2 = "select U.user_id,C.comment_id,C.comment_time,C.comment_content,IFNULL(Y.help_user_id,0) as isUseful
				 from zm_comment C
				 left join zm_user U on U.user_id = C.comment_user_id
				 left join (select H.help_user_id,H.help_comment_id from zm_help_like H where H.help_user_id = '$BeHelpId')Y
				 on Y.help_comment_id = C.comment_id
				 where C.comment_blog_id = '$blogId'
				 order by C.comment_time desc";
		$helpInfo = $Model->query($sql2);
		$this->assign("helpList",$helpInfo);
		$this->display();
	}

	public function isUseful(){
		$commentId = $_POST["commentId"];
		$beHelpId = $_POST["beHelpId"];
		$commentUserId = $_POST["commentUserId"];
		$commentLike = M("help_like");
		$useCondition["help_user_id"] = $beHelpId;
		$useCondition["help_comment_id"] = $commentId;
		$use = $commentLike->where($useCondition)->select();
		$Model = new Model();

		if($use != NULL){
			if($commentLike->where($useCondition)->delete()){
				$sql = "update zm_user set user_rp = user_rp - 1 where user_id ='$commentUserId' ";
				$Model->execute($sql);
				$this->ajaxReturn("","取消赞成功",1);
			}else{
				$this->ajaxReturn("","取消赞失败",-1);
			}
		}else{
			if($commentLike->add($useCondition)){
				$sql = "update zm_user set user_rp = user_rp + 1 where user_id ='$commentUserId' ";
				$Model->execute($sql);
				$this->ajaxReturn("","赞成功",1);
			}else{
				$this->ajaxReturn("","赞失败",-1);
			}
		}
	}
}