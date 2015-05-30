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
        <h1>大家来帮忙</h1>
    </div>
    <section>
        <?php if(is_array($allHelpList)): $k = 0; $__LIST__ = $allHelpList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?><div class="helpBox">
            <div class="oneQuestionInfo">
                <div class="question"><a href="__APP__/Help/helpInfo?blogId=<?php echo ($item["blog_id"]); ?>&BeHelpId=<?php echo ($item["user_id"]); ?>" target="_self"><?php echo ($item["blog_content"]); ?></a></div>
                <div>
                    <div class="questionTime"><?php echo ($item["blog_time"]); ?></div>
                    <div class="answerNumber"><?php echo ($item["commentCount"]); ?>人回答</div>
                    <div class="blank"></div>
                </div>
            </div>
            </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
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