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
    <div data-role="header" data-theme="b" data-position="fixed">
        <h1>注册帐号</h1>
    </div>

    <div class="register">
        <div class="r"><input type="text" id="cardId" placeholder="身份证号码"/></div>
        <div class="r"><input type="text" id="name" placeholder="姓名"/></div>
        <div class="r"><input type="password" id="pa1" placeholder="密码"/></div>
        <div class="r"><input type="password" id="pa2" placeholder="再输入一次"/></div>
        <div class="r"><select id="school">
            <option value ="中山大学" selected>中山大学</option>
            <option value ="华南理工大学">华南理工大学</option>
            <option value="暨南大学">暨南大学</option>
            <option value="广东财经大学">广东财经大学</option>
        </select></div>
        <div class="r"><input type="email" id="email" placeholder="邮箱" required/></div>

       <div id="registerTip"></div>
        <div class="submit">
            <input class="login" type="button" id="registerButton" data-role="none" value="注册" />
        </div>
    </div>
</section>

</body>
</html>