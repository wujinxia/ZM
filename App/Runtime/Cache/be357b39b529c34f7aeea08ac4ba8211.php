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
    <div data-role="header" data-theme="b">
        <?php if($userInfo["user_id"] == $_SESSION['userId']): ?><div class="save" >保存</div>
            <?php else: endif; ?>
        <h1>我的信息</h1>
    </div>
    <section class="">
        <!-- <img class="zmpic" src="image/zm.jpg" alt=""/> -->
    </section>
    <section class="changeAvatarTip">
        <?php if($userInfo["user_id"] == $_SESSION['userId']): ?><div>点击图片换头像</div>
            <?php else: endif; ?>
    </section>
    <section class="userInfo">
        <?php if($userInfo["user_id"] == $_SESSION['userId']): ?><form method="post" class="change" data-role="none" target="_self" action="__APP__/Personal/changeAvatar" enctype="multipart/form-data">
            <?php else: endif; ?>
        <div class="personLeft">
            <img class="avatarpic" src="__PUBLIC__/image/avatar/<?php echo ($userInfo["user_avatar"]); ?>" alt="默认头像"/>
            <?php if($userInfo["user_id"] == $_SESSION['userId']): ?><input class="changeAvatar" type="file" name="avatar" data-role="none" />
                <?php else: endif; ?>

        </div>
        <div class="info">
            <div><?php echo ($userInfo["user_name"]); ?></div>

            <?php if($userInfo["user_id"] == $_SESSION['userId']): ?><div><div  id="updateInfo" data-role="none">编辑资料</div></div><div><input class="changeButton" data-role="none" type="submit" value="上传头像"/></div>
                <?php else: ?><div><?php echo ($userInfo["user_school"]); ?></div><?php endif; ?>
        </div>
        <div class="blank"></div>
        <?php if($userInfo["user_id"] == $_SESSION['userId']): ?></form>
            <?php else: endif; ?>
    </section>



    <section class="personalInfo">
        <div class="editInfo">
            <span class="infotag">姓名：</span>
            <span class="infoContent" id="userName"><?php echo ($userInfo["user_name"]); ?></span>
        </div>
        <div class="editInfo">
            <span class="infotag">性别：</span>
            <span class="infoContent"><?php echo ($userInfo["user_sex"]); ?></span>
        </div>
        <div class="editInfo">
            <span class="infotag">学校：</span>
            <span class="infoContent"><?php echo ($userInfo["user_school"]); ?></span>
        </div>
        <div class="editInfo">
            <span class="infotag">年级：</span>
            <span class="infoContent" id="grade"><?php echo ($userInfo["user_grade"]); ?></span>
        </div>
        <div class="editInfo">
            <span class="infotag">专业：</span>
            <span class="infoContent" id="major"><?php echo ($userInfo["user_major"]); ?></span>
        </div>
        <div class="editInfo">
            <span class="infotag">邮箱：</span>
            <span  class="infoContent"><?php echo ($userInfo["user_email"]); ?></span>
        </div>
        <div class="editInfo">
            <span class="infotag">QQ：</span>
            <span class="infoContent" id="qq"><?php echo ($userInfo["user_qq"]); ?></span>
        </div>
        <div class="editInfo">
            <span class="infotag">电话：</span>
            <span class="infoContent" id="phone"><?php echo ($userInfo["user_phone"]); ?></span>
        </div>
        <div class="editInfo">
            <span class="infotag">现所在地：</span>
            <span class="infoContent" id="place"><?php echo ($userInfo["user_place"]); ?></span>
        </div>
    </section>


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