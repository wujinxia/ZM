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
        <div  class="inChat" ><a href="__URL__/chat" target="_self">进入群聊</a></div>
        <h1>仲明学子列表</h1>
    </div>
    <form class="">
        <div class="box">
            <div class="search"><input data-role="none" type="search" /></div>
            <div class="searchButton">搜索</div>
        </div>
    </form>
    <?php if(is_array($userInfo)): $k = 0; $__LIST__ = $userInfo;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?><div data-role="collapsible-set">
        <div data-role="collapsible">
            <h3><?php echo ($item["userSchool"]); ?></h3>
            <?php if(is_array($item["userList"])): $j = 0; $__LIST__ = $item["userList"];if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$item1): $mod = ($j % 2 );++$j;?><section class="userInfo friendInfo">
                <div class="personLeft"><img class="avatarpic newspic" src="__PUBLIC__/image/avatar/<?php echo ($item1["userAvatar"]); ?>" alt="好友头像"/></div>
                <div class="friendright">
                    <p><?php echo ($item1["userName"]); ?></p>
                    <p>RP:<?php echo ($item1["userRp"]); ?></p>
                </div>
                <button data-role="none">关注</button>
                <div class="blank"></div>
            </section><?php endforeach; endif; else: echo "$empty" ;endif; ?>
        </div>
    </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
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