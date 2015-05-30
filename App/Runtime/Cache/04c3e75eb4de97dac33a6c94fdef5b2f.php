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

<div data-role="page" >
    <form name="form" id="form" method="post" target="_self" action="__APP__/Index/addBlog"  enctype="multipart/form-data">
    <div data-role="header" data-theme="b" data-position="fixed" data-position="inline">
        <a  data-rel="back">返回</a>
        <!--<span class="send">发送</span>-->
        <input type="submit" data-role="none" class="send" value="发送"/>
        <h1 class="top">编辑发布</h1>
    </div>

    <!--<form name="form" id="form" method="post" action="#">-->
        <section class="sendText">
            <div class="">
                <textarea data-role="none" name="blogContent" class="inputBlog" rows="6" placeholder="请输入文字" required></textarea>
            </div>
            <div class="blogType">
                <div class="blogTypeName"><input data-role="none" type="radio" id="mood" name="sendType" value="mood"   />发心情</div>
                <div class="blogTypeName"><input data-role="none" type="radio" id="help" name="sendType" value="help" checked />求帮助</div>
                <div class="blogTypeName"><input data-role="none" type="radio" id="secret" name="sendType" value="secret" />小秘密</div>
                <div class="blank"></div>
            </div>
        </section>

        <div class="pic">
            <div class="picIcon"><img src="__PUBLIC__/image/+.png" alt=""/></div>
            <input type="file"  data-role="none" name="pic" id="picFile"  class="picUpload" onchange="preview(),send()"/>
            <!-- <div class="blank"></div> -->
        </div>
    </form>

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
</div>
</body>
</html>