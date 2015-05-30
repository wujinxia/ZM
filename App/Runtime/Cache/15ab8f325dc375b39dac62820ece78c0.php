<?php if (!defined('THINK_PATH')) exit();?>    <!doctype html>
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
    <div data-role="header" data-theme="b">
        <h1>我的信息</h1>
    </div>
    <section class="">
        <!-- <img class="zmpic" src="image/zm.jpg" alt=""/> -->
    </section>

    <section class="userInfo">
        <div class="personLeft"><img class="avatarpic" src="__PUBLIC__/image/avatar/<?php echo ($userInfo["user_avatar"]); ?>" alt="默认头像"/></div>
        <div class="info">
            <div><?php echo ($userInfo["user_name"]); ?></div>
            <div><?php echo ($userInfo["user_school"]); echo ($userInfo["user_grade"]); ?></div>
            <div data-role="none"><a target="_self" href="__APP__/Personal/personalInfo?userId=<?php echo (session('userId')); ?>">查看资料</a></div>
        </div>
        <div class="blank"></div>
    </section>

    <section class="interest">
        <div class="tag tagline"><a href="__URL__/followList">关注(11)</a></div>
        <div class="tag tagline"><a href="__URL__/myBlog?userId=<?php echo ($userInfo["user_id"]); ?>">心情(11)</a></div>
        <div class="tag">RP点(<?php echo ($userInfo["user_rp"]); ?>)</div>
        <div class="blank"></div>
    </section>

    <section class="type">
        <div><a href="__URL__/showSecret" target="_self"><div class="typeIcon"><img class="littleIcon" src="__PUBLIC__/image/secret.png" /><span class="iconText">小秘密</span></div></a></div>
        <div><a href="__URL__/showHelp" target="_self"><div class="typeIcon line"><img class="littleIcon" src="__PUBLIC__/image/help.png" /><span class="iconText">帮帮忙</span></div></a></div>
        <div><a href="__URL__/myBlog?userId=<?php echo (session('userId')); ?>" target="_self"><div class="typeIcon"><img class="littleIcon" src="__PUBLIC__/image/mood.png" /><span class="iconText">随心记</span></div></a></div>
    </section>

    <div class="submit">
        <input class="logout" type="button" id="logout" data-role="none" value="退出" />
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
</div>
</body>
</html>