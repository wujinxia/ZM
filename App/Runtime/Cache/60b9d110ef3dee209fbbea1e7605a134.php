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
    <div data-role="header" data-theme="b" data-position="fixed">
        <a  data-rel="back">返回</a>
        <h1>TA的心情</h1>
    </div>
    <section class="">
        <!-- <img class="toppic" src="image/topbanner.jpg" alt=""/> -->
    </section>

    <section class="news">
        <div class="newTop">
            <a href="__APP__/Personal/myBlog?userId=<?php echo ($blogInfo["user_id"]); ?>" target="_self"><img class="newspic" src="__PUBLIC__/image/avatar/<?php echo ($blogInfo["user_avatar"]); ?>" alt="默认头像"/></a>
            <div class="newsRight">
                <div class="useName"><a href="__APP__/Personal/myBlog?userId=<?php echo ($blogInfo["user_id"]); ?>" target="_self"><?php echo ($blogInfo["user_name"]); ?></a></div>
                <div><?php echo ($blogInfo["blog_time"]); ?></div>
            </div>
            <div class="blank"></div>
        </div>
        <div class="newsBody">
            <?php echo ($blogInfo["blog_content"]); ?>
        </div>

        <?php if($blogInfo["blog_pic"] != ''): ?><div><img class="newsBodyPic" src="__PUBLIC__/upload/<?php echo ($blogInfo["blog_pic"]); ?>" alt=""/></div><?php endif; ?>
        <div class="taglist">
            <div class="newstag tagline"><span class="like" isLike="<?php echo ($blogInfo["isLike"]); ?>" cur-user="<?php echo (session('userId')); ?>" cur-blog="<?php echo ($blogInfo["blog_id"]); ?>">
                <?php if($blogInfo["isLike"] == 0 ): ?><img class="i" src="__PUBLIC__/image/disLike.png" alt="赞"/>
                    <?php else: ?><img class="i" src="__PUBLIC__/image/veryLike.png" alt="赞"/><?php endif; ?><span class="m"> 赞</span></span></div>
            <div class="newstag"><a href="__URL__/comment?blogId=<?php echo ($blogInfo["blog_id"]); ?>" target="_self"><img class="i" src="__PUBLIC__/image/11764.png" alt="评论"/> <span class="m">评论</span></a></div>
            <div class="blank"></div>
        </div>
    </section>

    <div class="txt">
        <span class="txtInfo p1">点赞 <?php echo ($blogInfo["likeCount"]); ?></span><span>  |  </span><span class="txtInfo p2" >评论 <?php echo ($blogInfo["commentCount"]); ?></span>
    </div>
    <div class="comment">
        <?php if(empty($commentList)): ?><span style="padding: 5px;margin-left: 10px;">快来抢沙发评论吧</span><?php else: ?>
        <?php if(is_array($commentList)): $k = 0; $__LIST__ = $commentList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?><div class="commentBody">
            <div>
                <a href="__APP__/Personal/myBlog?userId=<?php echo ($item["user_id"]); ?>" target="_self"><img class="commentPic" src="__PUBLIC__/image/avatar/<?php echo ($item["user_avatar"]); ?>" alt="默认头像"/></a>
                <div class="commentRight">
                    <div><?php echo ($item["user_name"]); ?></div>
                    <div><?php echo ($item["comment_time"]); ?></div>
                </div>
                <div class="blank"></div>
            </div>
            <div class="commentContent"><?php echo ($item["comment_content"]); ?></div>
        </div><?php endforeach; endif; else: echo "$empty" ;endif; endif; ?>

    </div>

    <div class="likeList">
        <?php if(empty($likeList)): ?><span style="padding: 5px;margin-left: 10px;">快来第一个赞吧</span><?php else: ?>
        <?php if(is_array($likeList)): $k = 0; $__LIST__ = $likeList;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;?><div class="oneLike">
                <a href="__APP__/Personal/myBlog?userId=<?php echo ($item["user_id"]); ?>" target="_self"><img class="likePic" src="__PUBLIC__/image/avatar/<?php echo ($item["user_avatar"]); ?>" alt="默认头像"/></a>
                <a href="__APP__/Personal/myBlog?userId=<?php echo ($item["user_id"]); ?>" target="_self"><span class="likeName"><?php echo ($item["user_name"]); ?></span></a>
            </div><?php endforeach; endif; else: echo "$empty" ;endif; endif; ?>
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