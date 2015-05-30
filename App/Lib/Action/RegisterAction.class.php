<?php
// 本类由系统自动生成，仅供测试用途
class RegisterAction extends Action {
    public function index(){
    	$this->display();
    }

    public function register(){
		$user = M('user');
		$userCardId = $_POST["cardId"];
		$password = $_POST["password"];
		$userName = $_POST["name"];
		$school = $_POST["school"];
		$email = $_POST["email"];
		$data["user_card_id"] = $userCardId;
		$data["user_name"] = $userName;
		$data["user_password"] = $password;
		$data["user_email"] = $email;
		$data["user_school"] = $school;
		if($user->add($data)){
			$this->ajaxReturn('','注册成功！', 1);
		}
		else{
			$this->ajaxReturn('', '注册失败', -1);
		}
	}
}