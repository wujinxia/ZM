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

<div data-role="page" id="blogPage">
    <div data-role="header" data-theme="b" data-position="fixed">
        <h1>博客</h1>
    </div>
    <section class="">
        <!-- <img class="toppic" src="image/topbanner.jpg" alt=""/> -->
    </section>

    <?php if(is_array($allNewsList)): $k = 0; $__LIST__ = $allNewsList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?><section class="news">
            <div class="newTop">
                <!--<a><img class="newspic" src="__PUBLIC__<?php echo ($item["user_avatar"]); ?>" alt="默认头像"/></a>-->
                <a href="__APP__/Personal/myBlog?userId=<?php echo ($item["user_id"]); ?>" target="_self"><img class="newspic" src="__PUBLIC__/image/avatar/<?php echo ($item["user_avatar"]); ?>" alt="默认头像"/></a>
                <div class="newsRight">
                    <div class="useName"><a href="__APP__/Personal/myBlog?userId=<?php echo ($item["user_id"]); ?>" target="_self"><?php echo ($item["user_name"]); ?></a></div>
                    <div><?php echo ($item["blog_time"]); ?></div>
                </div>
                    <span class="deletePic" blogId="<?php echo ($item["blog_id"]); ?>"><img src="__PUBLIC__/image/delete.png"></span>
                <div class="blank"></div>
            </div>
            <div class="newsBody">
                <a href="__APP__/Index/blogDetail?blogId=<?php echo ($item["blog_id"]); ?>" target="_self"><?php echo ($item["blog_content"]); ?></a>
            </div>

            <?php if($item["blog_pic"] != ''): ?><div><a href="__APP__/Index/blogDetail?blogId=<?php echo ($item["blog_id"]); ?>" target="_self"><img class="newsBodyPic" src="__PUBLIC__/upload/<?php echo ($item["blog_pic"]); ?>" alt=""/></a></div><?php endif; ?>

            <!-- <div class="line"><hr/></div> -->
            <div class="taglist">
                <div class="newstag tagline"><span class="like" isLike="<?php echo ($item["isLike"]); ?>" cur-user="<?php echo (session('userId')); ?>" cur-blog="<?php echo ($item["blog_id"]); ?>">
                <?php if($item["isLike"] == 0 ): ?><img class="i" src="__PUBLIC__/image/disLike.png" alt="赞"/>
                    <?php else: ?><img class="i" src="__PUBLIC__/image/veryLike.png" alt="赞"/><?php endif; ?>
                <span class="m"><?php echo ($item["likeCount"]); ?></span></span></div>
                <div class="newstag"><a href="__APP__/Index/blogDetail?blogId=<?php echo ($item["blog_id"]); ?>" target="_self"><img class="i" src="__PUBLIC__/image/11764.png" alt="赞"/><span class="m">(<?php echo ($item["commentCount"]); ?>)</span></a></div>
                <div class="blank"></div>
            </div>
        </section><?php endforeach; endif; else: echo "$empty" ;endif; ?>

    <div data-role="footer" data-theme="b" data-position="fixed" data-tap-toggle="false">
        <nav data-role="navbar">
            <ul>
                <li><a href="#blogPage" target="_self">博客管理</a></li>
                <li><a href="#userPage" target="_self" data-transition="slide">用户管理</a></li>
            </ul>
        </nav>
    </div>
</div>

<div data-role="page" id="userPage" >
    <div data-role="header" data-theme="b" data-position="fixed">
        <h1> 仲明学子</h1>
    </div>

    <?php if(is_array($userList)): $j = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$item1): $mod = ($j % 2 );++$j;?><section class="userInfo friendInfo">
            <div class="personLeft"><img class="avatarpic newspic" src="__PUBLIC__/image/avatar/<?php echo ($item1["user_avatar"]); ?>" alt="好友头像"/></div>
            <div class="friendright">
                <p><?php echo ($item1["user_name"]); ?></p>
                <p>RP:<?php echo ($item1["user_rp"]); ?></p>
            </div>
            <button data-role="none" class="deleteUser" userId="<?php echo ($item1["user_id"]); ?>">注销</button>
            <div class="blank"></div>
        </section><?php endforeach; endif; else: echo "$empty" ;endif; ?>

    <div data-role="footer" data-theme="b" data-position="fixed" data-tap-toggle="false">
        <nav data-role="navbar">
            <ul>
                <li><a href="#blogPage" target="_self" data-transition="slide">博客管理</a></li>
                <li><a href="#userPage" target="_self">用户管理</a></li>
            </ul>
        </nav>
    </div>
</div>

</body>
</html>