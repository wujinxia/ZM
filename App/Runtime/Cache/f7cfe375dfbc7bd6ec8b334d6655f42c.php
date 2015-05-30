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

<section data-role="page">
<section class="avatar">	                
    <img class="avatarpic" src="__PUBLIC__/image/haha.jpg" alt=""/>
</section>
<form action="__APP__/Login/login"  method="post" target="_self">
	<div class="input">
		<div class="user">
			<lable for="cardId" class="accoutIcon icon">

			</lable>
			<input type="text" data-role="none" name="cardId" id="cardId" placeholder="身份证号码" autofocus required />
		</div>
	    <div class="splite"><hr/></div>
		<div class="password">
			<lable for="password" class="passwordIcon icon">

			</lable>
			<input type="password" data-role="none" name="password" id="password" placeholder="请输入密码"  required />
		</div>
    </div>
    <div class="tip" id="tip"></div>
	<div class="submit">
		<input class="login" type="button" id="login" data-role="none" value="登录" />
	</div>
</form>

<footer class="forgetPassword">
		<a href="__APP__/Register/index" target="_self" style="color:black;">注册帐号</a><span> | </span><a href="">忘记密码</a>
</footer>
</section> 

</body>
</html>