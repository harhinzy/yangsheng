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
        <h3>
            <i class="icon" value="mydocument,draftbox,examine"> </i>
            <a class="item" href='<?php echo U("Articlezt/index",array(id=>$vo[id]));?>'>文章专题</a>
        </h3>
    </div>

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
            

            

    <!-- 标题 -->
    <div class="main-title">
        <h2>
            文章专题 > <?php echo I('get.head');?>	(<?php echo ($_total); ?>)
        </h2>
    </div>

    <!-- 按钮工具栏 -->
    <div class="cf">
        <div class="fl">
            <a class="btn" href="<?php echo U('Articlezt/add?id='.I('get.id'));?>">增加</a>
            <button class="btn ajax-post confirm" target-form="ids" href="<?php echo U('Articlezt/del');?>">删除</button>
        </div>

        <!-- 高级搜索 -->
        <div class="search-form fr cf">
            <div class="sleft">
                <input type="text" name="title" class="search-input" value="<?php echo I('title');?>" placeholder="请输入标题">
                <a class="sch-btn" href="javascript:;" id="search"
                   url="<?php echo U('Articlezt/indexzt',array(id=>I('get.id')));?>"><i
                        class="btn-search"></i></a>
            </div>

        </div>
    </div>


    <!-- 数据表格 -->
    <div class="data-table">
        <table class="">
            <thead>
            <tr>
                <th class="row-selected row-selected"><input class="check-all" type="checkbox"/></th>
                <th class="">编号</th>
                <th class="">标题</th>
                <th class="">发帖时间</th>
                <th class="">图片</th>
                <th class="">喜欢数</th>
                <th class="">浏览数</th>
                <th class="">状态</th>
                <th class="">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($cate_content_data)): $i = 0; $__LIST__ = $cate_content_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><input class="ids" type="checkbox" name="ids[]" value="<?php echo ($vo["id"]); ?>"/></td>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><span><?php echo ($vo["title"]); ?></span></td>
                    <td><span><?php echo (date('Y-m-d H:i:s',$vo["create_time"])); ?></span></td>
                    <td><span>
                        <?php if($vo['pro_img']): ?><button class="btn fit_img" url="http://120.25.226.231<?php echo ($vo['img']['path']); ?>">有图</button>
                            <?php else: ?>
                            <button class="btn">无图</button><?php endif; ?>
                    </span></td>
                    <td><span><?php echo ($vo["view"]); ?></span></td>
                    <td><span><?php echo ($vo["like_num"]); ?></span></td>
                    <td>
                        <?php if($vo['status'] == 0): ?>不显示
                            <?php elseif($vo['status'] == -1): ?>
                            已删除
                            <?php elseif($vo['status'] == 1): ?>
                            正常<?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo U('Articlezt/edit?status=1&ids='.$vo['id']);?>" class="">编辑</a>

                        <a href="<?php echo U('Articlezt/setStatus?status=1&ids='.$vo['id']);?>" class="confirm ajax-get">启用</a>
                        <a href="<?php echo U('Articlezt/setStatus?status=0&ids='.$vo['id']);?>" class="confirm ajax-get">禁用</a>

                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>


    </div>

    <!-- 分页 -->
    <div class="page">
        <?php echo ($_page); ?>
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
    
    <script>
        var $window = $(window), $subnav = $("#subnav"), url;
        /*       $window.resize(function(){
         $("#main").css("min-height", $window.height() - 130);
         }).resize();*/

        /* 左边菜单高亮 */
        url = window.location.pathname + window.location.search;
        // url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
        url = url.replace(/(&title=\d+)/, "");
        console.log(url);
        $subnav.find("a[href='" + url + "']").parent().addClass("current");
    </script>
    <script>
        $(function () {
            //搜索功能
            $("#search").click(function () {
                var url = $(this).attr('url');
                var query = $('.search-form').find('input').serialize();
                //serialize序列化
                query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g, '');
                query = query.replace(/^&/g, '');
                //indexof分割
                if (url.indexOf('?') > 0) {
                    url += '&' + query;
                } else {
                    url += '?' + query;
                }
                window.location.href = url; //动态跳转到url指向的网址
            });
            //回车自动提交
            //keyup  就是对按键的监听
            $('.search-form').find('input').keyup(function (event) {
                if (event.keyCode === 13) {
                    $("#search").click();
                }
            });

            $(".ajax-add").on("click",function(){
                console.log($(this));
            })

            /* $('#time-start').datetimepicker({
             format: 'yyyy-mm-dd',
             language: "zh-CN",
             minView: 2,
             autoclose: true
             });

             $('#datetimepicker').datetimepicker({
             format: 'yyyy-mm-dd',
             language: "zh-CN",
             minView: 2,
             autoclose: true,
             pickerPosition: 'bottom-left'
             })*/

        })


    </script>


</body>
</html>