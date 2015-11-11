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
		width: 60%;
		height: 188px;
		font-family: "Microsoft Yahei",arial,sans-serif;
		font-size: 16px;
	}
	table.gritable td{
		width: 335px;
		padding: 10px;
	
	}
</style>
	<script type="text/javascript" src="/barbarossa/Public/static/js/laydate.js"></script>
    <div class="main-title">
        <h2>新增联系记录</h2>
    </div>
    <form action="<?php echo U('Custom/feedbackListAdd');?>" method="post" class="form-horizontal">
    <table class="gritable" >
    <input type="hidden" name="customer_id" value="<?php echo ($customer_id); ?>">
    <?php if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
    		<input type="hidden" name="customer_number" value="<?php echo ($vo["customer_number"]); ?>">
    		<td>客户名称：<input type="text" class="text" name="customer_name" value="<?php echo ($vo["customer_name"]); ?>"></td>
    		<td>联系人：<input type="text" class="text" name="contact_name" value="<?php echo ($vo["contact_name"]); ?>" ></td>
    	</tr>
    	<tr>
    		<td>客户类别：
    		<select name="customer_type" style="width:230px;height:29px;" class="text">
                <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tpname): $mod = ($i % 2 );++$i;?><option value="<?php echo ($tpname["type_name"]); ?>" <?php echo ($tpname['type_name'] == $vo["customer_type ? 'selected' : ''"]); ?>><?php echo ($tpname["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	        </select>
    		</td>
    		
    	</tr>
    	<tr>
    		<td>
    		联系方式：
    			<select name="contact_way" id="contact_way" onchange="change();" style="width:185px">
    				<option value="手机">手机</option>
    				<option value="固定电话">固定电话</option>
    				<option value="QQ">QQ</option>
    				<option value="微信">微信</option>
    			</select>
			</td>
    		<td><span id="way_name">手机</span>：<input type="text" class="text" name="txttel" value="<?php echo ($vo["tel"]); ?>" ></td>
    		
    		
    	</tr>
    	<tr>
    		<td colspan="2">
    		<div style="float:left;">联系内容：</div>
    		<div><textarea name="contact_content" rows="3" cols="60"></textarea></div>
    		</td>
    	</tr>
    	<tr>
    		<td>联系客服：<input type="text" class="text" name="customer_service" value="<?php echo ($vo["customer_service"]); ?>" ></td>
    		<td>联系时间：<input type="text" class="text" name="last_time" 
                onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"
                value="<?php echo date('Y-m-d H:i:s',time());?>"></td>
    	</tr>
    	<tr>
    		<td>联系类型：
    		<select style="width:185px" name="contact_type">
    			<option value="客户回访">客户回访</option>
    			<option value="客户来电">客户来电</option>
    		</select>
    		</td>
    		<td>下次联系：<input type="text" class="text" placeholder="请输入日期" name="appoint_time" 
	                onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"></td>
    	</tr>
    	<tr>
    		<td colspan="2">
    		<div style="float:left;">下次目标：</div>
    		<div><textarea rows="3" cols="60" name="next_content" ></textarea></div>
    		</td>
    	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
        <div class="form-item">
        <!-- 有ajax     -->
        	<button class="btn submit-btn ajax-post" id="submit" type="submit" target-form="form-horizontal">确 定</button>
            <button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
        </div>
    </form>

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
    
<script src="/barbarossa/Public/static/select.js"></script>
<script type="text/javascript" defer>
    
    
    
    function change(){
    	var sel = document.getElementById('contact_way');
    	var way = ['手机','固定电话','QQ','微信'];
    	var way_name = '手机';
    	for(var i=0,len=way.length; i<len; i++){
    		if(way[i] == sel.value){
    			way_name = way[i];
    		}
    	}
    	document.getElementById('way_name').innerHTML = way_name;
    }
    
	!function(){
		laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
		laydate({elem: '#demo'});//绑定元素
	}();

</script>

</body>
</html>