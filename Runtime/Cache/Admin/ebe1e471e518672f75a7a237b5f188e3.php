<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|OneThink管理平台</title>
    <link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.mousewheel.js"></script>
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
            

            
<script type="text/javascript" src="/Public/static/js/laydate.js"></script>
<style>
	table._char{
		border: 1px solid #84d902;
	}
	
	._char_td{
		border: none;
	}
</style>
	<!-- 标题栏 -->
	<div class="main-title">
		<h2>联系记录管理</h2>
	</div>
	<div class="cf">
		<div class="fl">
            <a class="sch-btn btn" href="javascript:;" id="expE" url="<?php echo U('Custom/feedbackListOutexcel');?>">导出Excel</a>
        </div>
        <!-- 高级搜索 -->
		<div class="search-form fr cf">
			<div class="sleft">
				<input type="text" name="search_content"  style="width:300px;" class="search-input"  placeholder="请输入客户名称/手机/联系人/联系内容">
				<div class="search-input" style="width:460px;height:100%" >
					联系时间：<input type="text" class="text" name="time_start"  value="<?php echo ($start_time); ?>"
							style="width:170px;border:none;background-image:url(/Public/static/js/skins/yahui/icon.png);background-repeat:no-repeat;background-position:right center;" 
							onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"
							>
					至：<input type="text" class="text" name="time_end" value="<?php echo ($end_time); ?>"
							style="width:170px;border:none;background-image:url(/Public/static/js/skins/yahui/icon.png);background-repeat:no-repeat;background-position:right center;"
							 onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
				</div>
				<select class="search-input"  name="customer_type">
					<option value="">请选择员工</option>
					<?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ty): $mod = ($i % 2 );++$i;?><option value="<?php echo ($ty["type_name"]); ?>"><?php echo ($ty["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<select class="search-input" name="contact_way">
					<option value="">请选择联系方式</option>
					<option value="手机">手机</option>
					<option value="固定电话">固定电话</option>
					<option value="QQ">QQ</option>
					<option value="微信">微信</option>
				</select>
				<a class="sch-btn" href="javascript:;" id="search" url="<?php echo U('Custom/feedbackListSearch');?>"><i class="btn-search"></i></a>
			</div>
		</div>
    </div>
    <!-- 数据列表 -->
    <?php if(!empty($_list)): if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="data-table table-striped">
		<table class="_char">
			<tr>
				<td class="_char_td" width="80">客户名称：</td>
				<td class="_char_td" width="260"><?php echo ($vo["customer_name"]); ?></td>
				<td class="_char_td" width="70">联系人：</td>
				<td class="_char_td" width="168"><?php echo ($vo["contact_name"]); ?></td>
				<td class="_char_td" width="90"><?php echo ($vo["contact_way"]); ?>：</td>
				<td class="_char_td" width="200"><?php echo ($vo["txttel"]); ?></td>
				<td class="_char_td" width="88">联系类型：</td>
				<td class="_char_td" width="480"><?php echo ($vo["contact_type"]); ?></td>
				<td class="_char_td" width="200">
					<a href="<?php echo U('Custom/feedbackListEdit?id='.$vo['id']);?>">编辑</a>&nbsp;&nbsp;
					<a href="<?php echo U('Custom/feedbackListDelete?id='.$vo['id']);?>" class="ajax-get">删除</a>&nbsp;&nbsp;
					<a href="<?php echo U('Custom/feedbackListCat?id='.$vo['id']);?>">查看</a>
				</td>
			</tr>
			<tr rowspan="2">
				<td class="_char_td" colspan="9"><?php echo ($vo["contact_content"]); ?></td>
			</tr>
			<tr>
				<td class="_char_td" colspan="9">
				<span>跟进人：<?php echo ($vo["customer_service"]); ?>&nbsp;&nbsp;跟进时间：<?php echo (date("Y-m-d H:i:s",$vo["last_time"])); ?></span></td>
			</tr>
		</table>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
	<?php else: ?>
		<div style="height:32px;line-height:32px;text-align:center;background:#FFF;">
			<td colspan="9" class="text-center">aOh! 暂时还没有内容! </td>
		</div><?php endif; ?>
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
            "ROOT"   : "", //当前网站地址
            "APP"    : "/index.php", //当前项目地址
            "PUBLIC" : "/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/Public/static/think.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
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
    
	<script src="/Public/static/thinkbox/jquery.thinkbox.js"></script>

	<script type="text/javascript">
	//搜索功能
	$("#search").click(function(){
		var url = $(this).attr('url');
        var query  = $('.search-form').find('input').serialize();
        var squery = $('.search-form').find('select').serialize();
        query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
        squery = squery.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
        query = query.replace(/^&/g,'');
        squery = squery.replace(/^&/g,'');
        if( url.indexOf('?')>0 ){
            url += '&' + query + '&' + squery;
        }else{
            url += '?' + query + '&' + squery;
        }
		window.location.href = url;
	});
	//回车搜索
	$(".search-input").keyup(function(e){
		if(e.keyCode === 13){
			$("#search").click();
			return false;
		}
	});
	
	//导出EXCEL
	$("#expE").click(function(){
		var url = $(this).attr('url');
        var query  = $('.search-form').find('input').serialize();
        var squery = $('.search-form').find('select').serialize();
        query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
        squery = squery.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');
        query = query.replace(/^&/g,'');
        squery = squery.replace(/^&/g,'');
        if( url.indexOf('?')>0 ){
            url += '&' + query + '&' + squery;
        }else{
            url += '?' + query + '&' + squery;
        }
		window.location.href = url;
	});
	
	
	//导航高亮
    highlight_subnav('<?php echo U('User/sourceManage');?>');
    var target_form = $(this).attr('target-form');
    console.log(target_form);
    
	</script>

</body>
</html>