<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh-CN">
<head>
<!-- 设置字符编码和手机端-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0" />
<!-- 设置收藏小图标 -->
<link href="__PUBLIC__/image/zm_icon.png" type="image/png" rel="shortcut icon">
<!-- 加载jquery mobile -->
<link href="__PUBLIC__/css/jquery.mobile-1.4.5.css"  rel="stylesheet">
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.mobile-1.4.5.js"></script>
<!-- 加载CSS文件 -->
<link href="__PUBLIC__/css/zm_chat.css"  rel="stylesheet">
<!-- 加载JS文件 -->
<script type="text/javascript" src="__PUBLIC__/js/zm.js"></script>
	<title>仲明互助交流首页</title>
</head>
<body>
    <div data-role="header" data-theme="b">
        <h1>大家聊聊天</h1>
    </div>
    <div class="container">
        <div class="chatRecordBox">
            <p>在线人数<span id="userNum"></span></p>
            <textarea id="message" class="chatRecord" data-role="none" rows="15"></textarea>
        </div>


        <div class="inputBigBox">
            <textarea data-role="none" userName="<?php echo (session('userName')); ?>" class="inputBox" placeholder="请输入要发送的内容" rows="2" id="input" ></textarea>
            <button data-role="none" class="chatButton" id="sub">发送</button>
            <div class="blank"></div>
         </div>
    </div>

    <div data-role="footer" data-theme="b" data-position="fixed" data-tap-toggle="false">
        <nav data-role="navbar">
            <ul>
                <li><a href="__APP__/Index/index" target="_self" data-icon="" data-iconpos="    ">首页</a></li>
                <li><a href="__APP__/Chat/index" target="_self">畅谈</a></li>
                <li><a href="__APP__/Index/mblog" target="_self">发布</a></li>
                <li><a href="__APP__/Help/index" target="_self">论坛</a></li>
                <li><a href="__APP__/Personal/index" target="_self">我</a></li>
            </ul>
        </nav>
    </div>
<script type="text/javascript">
    (function(){
        var $ = function(id){return document.getElementById(id) || null;}
        var wsServer = 'ws://127.0.0.1:8080';
        var ws = new WebSocket(wsServer);
        var isConnect = false;
        ws.onopen = function (evt) { onOpen(evt) };
        ws.onclose = function (evt) { onClose(evt) };
        ws.onmessage = function (evt) { onMessage(evt) };
        ws.onerror = function (evt) { onError(evt) };
        function onOpen(evt) {
            console.log("连接服务器成功");
            isConnect = true;
        }
        function onClose(evt) {
            console.log("Disconnected");
        }
        function onMessage(evt) {
            var data = JSON.parse(evt.data);
            switch (data.type) {
                case 'text':
                    addMsg(data.msg);
                    break;
                case 'num' :
                    updataUserNum(data.msg);
                    break;
            }
            console.log('Retrieved data from server: ' + evt.data);
        }
        function onError(evt) {
            console.log('Error occured: ' + evt.data);
        }
        function sendMsg() {
            if(isConnect){
                var userName = $('input').getAttribute('userName');
                var sendMsg = userName + ":" + $('input').value;
                ws.send(sendMsg);
                $('input').value = '';
            }
        }
        function addMsg(msg) {
            msg = JSON.parse(msg);
            var data = msg.text;
            var message = data.split(':');
            var text = message[0] + ':' + message[1] + '\n';
            $('message').value += text;
            $('message').scrollTop = $('message').scrollHeight;
        }
        function updataUserNum(msg) {
            $('userNum').innerText = msg;
        }
        $('sub').addEventListener('click',sendMsg,false);
    })();
</script>
</body>
</html>