//登陆判断
$(function(){
	$("#login").click(function(){
		var cardId = $("#cardId").val();
		var password = $("#password").val();
		if(cardId == "" || password == ""){
			$("#tip").html("身份证或密码不能为空");
		}
		else{
			$.post(
				"/ZM/index.php/Login/login",
				{
					cardId: $("#cardId").val(),
					password:$("#password").val()
				},
				function(data){
                    if(data['status'] == 1){
                        if(data['data']['userName'] == 'admin'){
                            window.location.href="/ZM/index.php/Admin/index";
                        }else{
                            window.location.href="/ZM/index.php/Index/index";
                        }

                    }else{
                        $("#tip").html(data['info']);
                    }
				}

			);
		}
	});
    //退出
    $("#logout").click(function(){
        window.location.href="/ZM/index.php/Login/doLogout";
    });

    $("#registerButton").click(function(){
        var cardId = $("#cardId").val();
        var name = $("#name").val();
        var password1 = $("#pa1").val();
        var password2 = $("#pa2").val();
        var school = $("#school").val();
        var email = $("#email").val();
        var search_str = /^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/;
        if(cardId == "" || name == "" ||password1 == "" || password2 == "" || school == "" ||email == ""){
            $("#registerTip").html("请填写完注册信息");
        }else if(password1 != password2){
            $("#registerTip").html("两次的密码输入不一样");
        }else if(!search_str.test(email)){
            $("#registerTip").html("请填写正确的邮箱");
        }else{
            $.post(
                "/ZM/index.php/Register/register",
                {
                    cardId: cardId,
                    password: password1,
                        name: name,
                      school: school,
                      email: email
                },
                function(data){
                    if(data['status'] == 1){
                        window.location.href="/ZM/index.php/Login/index";
                    }else{
                        $("#tip").html(data['info']);
                    }
                }
            );
        }
    });


   //发送评论
    $("#sendComment").click(function(){

        var input = $("textarea[name='commentBody']").val();
        var url = window.location.search;
        var id = url.substring(url.lastIndexOf('=')+1, url.length);
        if(input != "")
        {
            $.post(
                "/ZM/index.php/Index/addComment",
                {
                    blogId: id,
                    commentBody:input
                },
                function(data){
                    console.log(data);
                    if(data["status"] == 1){
                        window.location.href="/ZM/index.php/Index/blogDetail?blogId="+id;
                    }
                }
            );
        }
    });

    //help模块回答按钮
    $(".answerButton").click(function(){
        if($(".answerInput").css("display") == "none"){
            $(".answerInput").show();
        }
        $(".answerInput").find("textarea").focus();
    });


    $(".answerInput").find("textarea").blur(function(){
        if($(".answerInput").find("textarea").val()== ""){
            $(".answerInput").hide();
        }else{

        }
    });

    $("#helpHim").click(function(){
        var help = $(".answerInput").find("textarea").val();
        var url = window.location.href;
        var beHelpId = $(this).attr("beHelpId");
        var temp = url.substring(url.lastIndexOf('?'),url.lastIndexOf('&'));
        var id = temp.substring(temp.lastIndexOf('=')+1, temp.length);
        if(help != ""){
            $.post(
                "/ZM/index.php/Index/addComment",
                {
                    blogId: id,
                    commentBody: help
                },
                function(data){
                    console.log(data);
                    if(data["status"] == 1){
                        $(".answerInput").hide();
                        $(".answerInput").find("textarea").val("");
                        window.location.href="/ZM/index.php/Help/helpInfo?blogId="+id+"&BeHelpId="+beHelpId;
                    }
                }
            );
        }

    });


    //点赞
    $(".like").click(function(){
        var icon = $(this).find('img').attr('src');
        var node = $(this);
        var blogId = $(this).attr("cur-blog");
        var userId = $(this).attr("cur-user");
        var isLike = $(this).attr("isLike");
        var likeNum = node.find("span").html();
        var x = parseInt(likeNum);
        var isNum = isNaN(x);
            $.post(
                "/ZM/index.php/Index/isLike",
                {
                    blogId: blogId,
                    userId: userId,
                    isLike: isLike
                },
                function(data){
                    console.log(data);
                    if(data['status'] == 1 && data['info'] == "赞成功"){
                        if(!isNum){
                            node.find("span").html(x+1);
                        }
                        node.find('img').attr("src","/ZM/Public/image/veryLike.png");

                    }else if(data['status'] == 1 && data['info'] == "取消赞成功"){
                        if(!isNum){
                            node.find("span").html(x-1);
                        }
                        node.find('img').attr("src","/ZM/Public/image/disLike.png");
                    }else{
                    }
                }
            );
    });

    //评论点赞
    $(".likeHelp").click(function(){
        var node = $(this).find('img');
        var commentId = $(this).attr("cur-comment-id");
        var userId = $(this).attr("cur-user");
        var beHelpId = $(this).attr("cur-blog-user-id");
        var commentUserId = $(this).attr("cur-comment-user");
        if(userId == beHelpId && userId != commentUserId){
            $.post(
                "/ZM/index.php/Help/isUseful",
                {
                    commentUserId:commentUserId,
                    commentId: commentId,
                    beHelpId: beHelpId
                },
                function(data){
                    console.log(data);
                    if(data['status'] == 1 && data['info'] == "赞成功"){
                        node.attr("src","/ZM/Public/image/veryLike.png");
                    }else if(data['status'] == 1 && data['info'] == "取消赞成功"){
                        node.attr("src","/ZM/Public/image/disLike.png");
                    }else{
                    }
                }
            );
        }
    });
});

$(function(){
    $("#updateInfo").click(function(){
        $(".infoContent").attr("contenteditable","true");
        $(".infoContent").focus();
    });

    $(".save").click(function(){
        $.post(
            "/ZM/index.php/Personal/updateInfo",
            {
                userName:$("#userName").html(),
                grade: $("#grade").html(),
                major: $("#major").html(),
                qq: $("#qq").html(),
                phone: $("#phone").html(),
                place: $("#place").html()
            },
            function(data){
                console.log(data);
                if(data['status'] == 1){
                    $(".infoContent").attr("contenteditable","false");
                }else{
                }
            }
        );
    });
});
$(function(){

    //管理员删除博客和注销用户
    $(".deletePic").click(function(){
        var newsNode = $(this).parent().parent();
        var blogId = $(this).attr("blogId");
        if(confirm(' 确定删除吗'))
        $.get(
            "/ZM/index.php/Admin/delBlog",
            {
                blogId:blogId
            },
            function(data){
                console.log(data);
                if(data['status'] == 1){
                    newsNode.remove();
                }else{

                }
            }
        );
    });

    $(".deleteUser").click(function(){
        var newsNode = $(this).parent();
        var userId = $(this).attr("userId");
        if(confirm(' 确定删除吗'))
            $.get(
                "/ZM/index.php/Admin/delUser",
                {
                    userId:userId
                },
                function(data){
                    console.log(data);
                    if(data['status'] == 1){
                        newsNode.remove();
                    }else{
                    }
                }
            );
    });

//输入框有文字的时候发布变色
    $(".inputBlog").change(function(){
        $(".send").css("color","#FF8200");
        if($(".inputBlog").val() == ""){
            $(".send").css("color","grey");
        }
    });

    $("#inputcomment").change(function(){
        $("#send").css("color","#FF8200");
        if($("#inputcomment").val() == ""){
            $("#send").css("color","grey");
        }
    });
//赞和评论TAB
    $(".p1").click(function(){
        $(".comment").hide();
        $(".likeList").show();
        $(".p1").css("color","rgb(51,51,51)");
        $(".p2").css("color","rgb(146,146,146)");
    });

    $(".p2").click(function(){
        $(".comment").show();
        $(".likeList").css("display","none");
        $(".p2").css("color","rgb(51,51,51)");
        $(".p1").css("color","rgb(146,146,146)");
    });

//发布的时候三种的选择
	$("#mood").click(function(){
    	$(".pic").show();
  	});

  	$("#secret").click(function(){
    	$(".pic").show();
  	});

  	$("#help").click(function(){
    	$(".pic").hide();
    	$(".imgUpload").hide();
  	});

});
//有照片的时候发布变色
function send(){
    $(".send").css("color","#FF8200");
}

//预览照片
function preview(){
    var picUpload = document.getElementById("picFile");
    if(!picUpload || !picUpload.value) return;
    var patn = /\.png$|\.jpg$|\.jpeg$|\.gif$/i;
    if(patn.test(picUpload.value)){
        var allImg = $("#form img");
        var picSrc = getObjectURL(picUpload.files[0]);
        var img = $("<img />");
        var picId =  "uploadpic" + allImg.length;
        img.attr({src:picSrc,width:"85",height:"85",id:picId,class:"imgUpload"});
        $("#form").append(img);
        $(".picIcon").remove();
    }else{
        alert("您选择的似乎不是图像文件。");
    }
}

function preview1(){
	var picUpload = document.getElementById("picFile");
	if(!picUpload || !picUpload.value) return;
	var patn = /\.png$|\.jpg$|\.jpeg$|\.gif$/i;
	if(patn.test(picUpload.value)){
		var allImg = $("#form img");
		var picSrc = getObjectURL(picUpload.files[0]);
		var img = $("<img />");
			var picId =  "uploadpic" + allImg.length;
			img.attr({src:picSrc,width:"85",height:"85",id:picId,class:"imgUpload"});
			var pic = $(".pic").clone();
			$("#form").append(img);
			$(".pic").remove();
		if(allImg.length < 3){
			$("#form").append(pic);
		}else{
		}
	}else{
		alert("您选择的似乎不是图像文件。");
	}
}

//建立一個可存取到該file的url
function getObjectURL(file) {
	var url = null ; 
	if (window.createObjectURL!=undefined) { // basic
		url = window.createObjectURL(file) ;
	} else if (window.URL!=undefined) { // mozilla(firefox)
		url = window.URL.createObjectURL(file) ;
	} else if (window.webkitURL!=undefined) { // webkit or chrome
		url = window.webkitURL.createObjectURL(file) ;
	}
	return url ;
}
