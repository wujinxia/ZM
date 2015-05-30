<?php
// 本类由系统自动生成，仅供测试用途
class ChatAction extends Action {
    public function index(){
		$Model = new Model();

		$sql = "select user_school,group_concat(user_id) as userId, group_concat(user_name) as userName,group_concat(user_avatar) as userAvatar,group_concat(user_rp) as userRp from zm_user group by user_school";
		$userList = $Model->query($sql);
		$userInfo = array();
		foreach($userList as $k=>$v){
			$temp = array();
			$userIdArr = explode(",",$v["userId"]);
			$userNameArr = explode(",",$v["userName"]);
			$userAvataraArr = explode(",",$v["userAvatar"]);
			$userRpArr = explode(",",$v["userRp"]);
			for($i = 0;$i < count($userIdArr);$i++){
				$zm = array();
				$zm["userId"] = $userIdArr[$i];
				$zm["userName"] = $userNameArr[$i];
				$zm["userAvatar"] = $userAvataraArr[$i];
				$zm["userRp"] = $userRpArr[$i];
				array_push($temp,$zm);
			}
			$a = array("userSchool"=>$v["user_school"],"userList"=>$temp);
			array_push($userInfo,$a);
		}
//		print_r($userInfo);exit();
		$this->assign("userInfo",$userInfo);
		$this->display();
    }

	public function StartChat(){
		$ws = new WebSocketModel('127.0.0.1', '8080', 10);
		$ws->function['add'] = 'user_add_callback';
		$ws->function['send'] = 'send_callback';
		$ws->function['close'] = 'close_callback';
		$ws->start_server();
		//回调函数们
		function user_add_callback($ws) {
			$data = count($ws->accept);
			send_to_all($data, 'num', $ws);
		}

		function close_callback($ws) {
			$data = count($ws->accept);
			send_to_all($data, 'num', $ws);
		}

		function send_callback($data, $index, $ws) {
			$data = json_encode(array(
				'text' => $data,
				'user' => $index,
			));
			send_to_all($data, 'text', $ws);
		}

		function send_to_all($data, $type, $ws){
			$res = array(
				'msg' => $data,
				'type' => $type,
			);
			$res = json_encode($res);
			$res = $ws->frame($res);
			foreach ($ws->accept as $key => $value) {
				socket_write($value, $res, strlen($res));
			}
		}
}

	public function chat(){
		$this->display();
	}
}