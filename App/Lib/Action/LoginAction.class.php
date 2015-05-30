<?php
// 本类由系统自动生成，仅供测试用途
class LoginAction extends Action {
    public function index(){
    	$this->display();
    }

    public function login(){
		$user = M('user');
		$userCardId = $_POST["cardId"];
		$password = $_POST["password"];
		$where['user_card_id'] = $userCardId;
		$where['user_password'] = $password;
		$userInfo = $user->where($where)->find();
		if(count($userInfo) > 0){
			$_SESSION['userName'] = $userInfo["user_name"];
			$_SESSION['userId'] = $userInfo["user_id"];
			$_SESSION['userCardId'] = $userInfo["user_card_id"];
			$this->ajaxReturn($_SESSION, '登陆成功！', 1);
		}
		else{
			$this->ajaxReturn('', '身份证或者密码错误', -1);
		}
		$this->redirect('Index/index');
    }

	public function doLogout(){
		$_SESSION=array();
		if(isset($_COOKIE[session_name()])){
			setcookie(session_name(),'',time()-1,'/');
		}
		session_destroy();
		$this->redirect('Index/index');
	}
}