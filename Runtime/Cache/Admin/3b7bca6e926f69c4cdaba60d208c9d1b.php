<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|天天养生管理平台</title>
    <link href="/yangsheng/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/yangsheng/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/yangsheng/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/yangsheng/Public/Admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="/yangsheng/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/yangsheng/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="/yangsheng/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/yangsheng/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/yangsheng/Public/Admin/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth.username');?>"><?php echo session('user_auth.username');?></em></li>
                <li><a href="<?php echo U('User/updatePassword');?>">修改密码</a></li>
                <li><a href="<?php echo U('User/updateNickname');?>">修改昵称</a></li>
                <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
    <div id="subnav" class="subnav">

        <?php if(is_array($cate_data)): $i = 0; $__LIST__ = $cate_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["pid"] == 0): ?><h3>
                    <i class="icon" value="mydocument,draftbox,examine"> </i>
                    <?php echo ($vo["title"]); ?>
                </h3><?php endif; endforeach; endif; else: echo "" ;endif; ?>

        <ul class="side-sub-menu">
            <?php if(is_array($cate_data)): $i = 0; $__LIST__ = $cate_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["pid"] != 0): ?><li><a class="item" href='<?php echo U("Fit/fit",array(id=>$vo[id]));?>'><?php echo ($vo["title"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>

    </div>

    <script>
        $(function () {
            $(".side-sub-menu li").hover(function () {
                $(this).addClass("hover");
            }, function () {
                $(this).removeClass("hover");
            });
        })
    </script>

        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!empty($_show_nav)): ?><div class="breadcrumb">
                <span>您的位置:</span>
                <?php $i = '1'; ?>
                <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
                    <?php else: ?>
                    <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
                    <?php $i = $i+1; endforeach; endif; ?>
            </div><?php endif; ?>
            <!-- nav -->
            

            
    <style>
        img {
            height: 150px;
            width: 150px;
        }

        .good_img {
            border: 1px solid #fff;
            max-width: 180px;
            max-height: 190px;
            float: left;
            margin: 5px;
        }

        .good_img span {
            padding-left: 12px;
        }
    </style>
    <!-- 子导航 -->
    <div class="main-title">
        <h2>
            編輯分类
        </h2>
    </div>
    <script type="text/javascript" src="/yangsheng/Public/static/uploadify/jquery.uploadify.min.js"></script>

    <!-- 标签页导航 -->
    <div class="tab-wrap">
        <div class="tab-content">
            <!-- 表单 -->
            <form id="form" action="<?php echo U('cate_edit?id='.$data['id']);?>" method="post" class="form-horizontal">
                <!-- 基础文档模型 -->

                <div class="form-item cf">
                    <label class="item-label">标题<span class="check-tips">（2-60字之间）</span></label>

                    <div class="controls">
                        <input type="text" name="title" value="<?php echo ($data['title']); ?>" class="text input-mid"></div>
                </div>





                    <div class="form-item cf">
                        <label class="item-label">图片<span class="check-tips">点击选择</span></label>

                        <div class="controls">
                            <input type="file" id="upload_picture_post">

                            <input type="hidden" class="fit_img"/>

                            <div class="upload-pre-item" style="padding-top: 5px">
                            </div>
                            <img src="http://120.25.226.231<?php echo ($data['img']['path']); ?>"/><br>
                            <button type=button class='btn img_del' data-id="<?php echo ($data['img']['path']); ?>" onclick="label_click(this);">删除</button>
                        </div>

                    <script type="text/javascript">
                        //上传图片
                        /* 初始化上传插件 */
                        $("#upload_picture_post").uploadify({
                            "height": 30,
                            "swf": "/yangsheng/Public/static/uploadify/uploadify.swf",
                            "fileObjName": "download",
                            "buttonText": "上传图片",
                            "uploader": "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
                            "width": 120,
                            'removeTimeout': 1,
                            'fileTypeExts': '*.jpg; *.png; *.gif;',
                            "onUploadSuccess": uploadPicturegood,
                            'onFallback': function () {
                                alert('未检测到兼容版本的Flash.');
                            }
                        });
                        function uploadPicturegood(file, data) {
                            var data = $.parseJSON(data);
                            var src = '';
                            var img = '';
                            if (data.status) {
                                var img_html = '\<input type="hidden" name="pro_img" class="fit_img" value="' + data.id + '"/>';
                                src = data.url || '/yangsheng' + data.path;
                                img = '<div class="good_img"\>' + img_html + '<img src="' + src + '"/>\<br>' +
                                        '<span><button type=button class=\'btn img_del\' onclick=del_img(' + data.id + ',this)>删除<\/button></span></div>';
                                $(".fit_img").parent().find('.upload-pre-item').append(img).show();
                            } else {
                                layer.msg(data.info, {icon: 5})
                            }
                        }

                    </script>
                </div>

                <div class="form-item cf">
                    <button class="btn submit-btn ajax-post hidden" id="submit" type="submit"
                            target-form="form-horizontal">确定
                    </button>
                    <a class="btn btn-return" href="javascript:history.back();">返 回</a> <b style="color: #f00; display: none"
                                                                             class="tishi"> </b>
                </div>

            </form>
        </div>
    </div>


        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用<a href="http://www.onethink.cn" target="_blank">OneThink</a>管理平台</div>
                <div class="fr">V<?php echo (ONETHINK_VERSION); ?></div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "/yangsheng", //当前网站地址
            "APP"    : "/yangsheng/admin.php?s=", //当前项目地址
            "PUBLIC" : "/yangsheng/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/yangsheng/Public/static/think.js"></script>
    <script type="text/javascript" src="/yangsheng/Public/Admin/js/common.js"></script>
    <script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
    </script>
    
    <script type="text/javascript">
        $('#submit').click(function(){
            console.log($(this));
            $('#form').submit();
        });

        function del_img(id, index) {
            $.get("<?php echo U('Picture/del');?>", {'id': id}, function (data) {
                if (data.status) {
                    layer.msg("删除成功", {icon: 6});
                    $(index).parent().parent(".good_img").remove();
                }
            })
        }

    </script>

</body>
</html>