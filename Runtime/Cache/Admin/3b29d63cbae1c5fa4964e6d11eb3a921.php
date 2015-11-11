<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|OneThink管理平台</title>
    <link href="/barbarossa/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/barbarossa/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/barbarossa/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/barbarossa/Public/Admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="/barbarossa/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/barbarossa/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="/barbarossa/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/barbarossa/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/barbarossa/Public/Admin/js/jquery.mousewheel.js"></script>
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
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (u($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
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
                <?php if(!empty($_extra_menu)): ?>
                    <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
                <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
                    <?php if(!empty($sub_menu)): if(!empty($key)): ?><h3><i class="icon icon-unfold"></i><?php echo ($key); ?></h3><?php endif; ?>
                        <ul class="side-sub-menu">
                            <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                                    <a class="item" href="<?php echo (u($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul><?php endif; ?>
                    <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
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
            

            
<style>
	table.gritable{
		border: 1px;
		width: 90%;
		height: 188px;
		font-family: "Microsoft Yahei",arial,sans-serif;
		font-size: 16px;
	}
	table.gritable td{
		padding-left: 16px;
	
	}
	#c_title{
		float:left;
		font-family: "Microsoft Yahei",arial,sans-serif;
		font-size:20px;
		font-weight: 550;
	}
	.s_menu{
		width: 88px;
		height: 32px;
		float: left;
		text-align: center;	
	}
	.blk{
		width: 100%;
	}
</style>
	<?php if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div style="border:2px solid #dce0e1;">
    <div>
    	<div id="c_title">客户基本信息</div>
    	<div style="float:right;margin-top:4px;"><a class="btn" href="<?php echo U('Custom/customListUpdate?id='.$vo['id']);?>" class="">编辑</a></div>
    </div>
    <table class="gritable" >
    	<tr>
    		<td>客户编号：<?php echo ($vo["customer_number"]); ?></td>
    		<td>客户名称：<?php echo ($vo["customer_name"]); ?></td>
    		<td>客户类别：<?php echo ($vo["customer_type"]); ?></td>
    	</tr>
    	<tr>
    		<td>主联系人：<?php echo ($vo["contact_name"]); ?></td>
    		<td>联系电话：<?php echo ($vo["tel"]); ?></td>
    		<td>QQ/旺旺：<?php echo ($vo["QQ"]); ?></td>
    	</tr>
    	<tr>
    		<td>电子邮件：<?php echo ($vo["email"]); ?></td>
    		<td>建档客服：<?php echo ($vo["create_people"]); ?></td>
    		<td>客服专员： <?php echo ($vo["customer_service"]); ?></td>
    	</tr>
    	<tr>
    		<td>客户来源：<?php echo ($vo["customer_source"]); ?></td>
    		<td colspan="2">详细地址：<?php echo ($vo["province"]); echo ($vo["city"]); echo ($vo["country"]); echo ($vo["detail_address"]); ?></td>
    	</tr>
    	<tr>
    		<td colspan="3">客户备注：<?php echo ($vo["notes"]); ?></td>
    	</tr>
    </table>
    </div>
    <div class="blk" style="height: 50px;">
		<iframe frameborder="0" src="<?php echo U('Custom/nav?customer_number='.$vo['customer_number']);?>" width="100%" height="50px" scrolling="no"></iframe>
	</div>
    <div class="blk" style="height: 40px;">
    	<div style="float:right;margin-top:4px;">
    		<a class="btn" href="<?php echo U('Custom/feedbacklistadd?id='.$vo['id']);?>" class="">添加记录</a>
    	</div>
    </div>
    <div class="blk">
    	<iframe frameborder="0" src="<?php echo U('Custom/feedbacklistone?customer_number='.$vo['customer_number']);?>" width="100%" height="500" name="under" scrolling="no"></iframe>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

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
            "ROOT"   : "/barbarossa", //当前网站地址
            "APP"    : "/barbarossa/index.php", //当前项目地址
            "PUBLIC" : "/barbarossa/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/barbarossa/Public/static/think.js"></script>
    <script type="text/javascript" src="/barbarossa/Public/Admin/js/common.js"></script>
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
        //导航高亮
        highlight_subnav('<?php echo U('Custom/index');?>');
    </script>

</body>
</html>