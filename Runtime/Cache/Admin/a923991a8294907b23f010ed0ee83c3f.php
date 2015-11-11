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
            

            
	<script type="text/javascript" src="/barbarossa/Public/static/select.js"></script>
	<!-- <script type="text/javascript" src="/barbarossa/Public/static/area.js"></script> -->
	<script type="text/javascript" src="/barbarossa/Public/static/js/laydate.js"></script>
    <div class="main-title">
        <h2>新增客户资料</h2>
    </div>
    <form action="<?php echo U('Custom/customListUpdate');?>" method="post" class="form-horizontal">
        <div class="form-item">
        	<div style="width:350px;float:left;">
	            <label class="item-label">客户名称</label>
	            <div class="controls">
	                <input type="text" class="text" name="customer_name" value="<?php echo ($data["customer_name"]); ?>">
	            </div>
        	</div>
            <label class="item-label">主联系人</label>
            <div class="controls">
                <input type="text" class="text" style="width:180px" name="contact_name" value="<?php echo ($data["contact_name"]); ?>">&nbsp;&nbsp;
                <input type="radio" name="gender" value="男" <?php echo ($data['gender'] == '男'? 'checked' : ''); ?>>先生&nbsp;
                <input type="radio" name="gender" value="女" <?php echo ($data['gender'] == '女'? 'checked' : ''); ?>>女士
               
            </div>
        </div>
        <div class="form-item">
	        <div style="width:350px;float:left;">
	            <label class="item-label">当前职位</label>
	            <div class="controls">
	                <input type="text" class="text" name="position" value="<?php echo ($data["position"]); ?>">
	            </div>
	        </div>
            <label class="item-label">出生日期</label>
            <div class="controls">
                <input type="text" class="text" name="birthday" value="<?php echo (date('Y-m-s',$data["birthday"])); ?>"
                style="background-image:url(/barbarossa/Public/static/js/skins/yalan/icon.png);background-repeat:no-repeat;background-position:right center;" id="demo" >
            </div>
        </div>
        <div class="form-item">
	        <div style="width:350px;float:left;">
	            <label class="item-label">电子邮箱</label>
	            <div class="controls">
	                <input type="text" class="text" name="email" value="<?php echo ($data["email"]); ?>">
	            </div>
	        </div>
            <label class="item-label">QQ/旺旺</label>
            <div class="controls">
                <input type="text" class="text" name="QQ" value="<?php echo ($data["QQ"]); ?>" >
            </div>
        </div>
        <div class="form-item">
	        <div style="width:350px;float:left;">
	            <label class="item-label">固定电话</label>
	            <div class="controls">
	                <input type="text" class="text" name="phone" value="<?php echo ($data["phone"]); ?>" >
	            </div>
	        </div>
            <label class="item-label">联系手机</label>
            <div class="controls">
                <input type="text" class="text" name="tel" value="<?php echo ($data["tel"]); ?>">
            </div>
        </div>
        <div class="form-item">
	        <div style="width:350px;float:left;">
	            <label class="item-label">办公电话</label>
	            <div class="controls">
	                <input type="text" class="text" name="office_phone" value="<?php echo ($data["office_phone"]); ?>" >
	            </div>
	        </div>
            <label class="item-label">传真</label>
            <div class="controls">
                <input type="text" class="text" name="fax_number" value="<?php echo ($data["fax_number"]); ?>" >
            </div>
        </div>
        <div class="form-item">
        	<label class="item-label">所在地区</label>
        	<div class="controls">
        		<input type="hidden" id="pv" value="<?php echo ($data["province"]); ?>">
                <select id="province" name="province" style="width:185px">
                    <option value="">
                        --请选择省份--
                    </option>
                    <option value="北京市" selected>
                        	北京市
                    </option>
                    <option value="天津市">
                        	天津市
                    </option>
                    <option value="河北省">
                        	河北省
                    </option>
                    <option value="山西省">
                        	山西省
                    </option>
                    <option value="内蒙古自治区">
                       	 内蒙古自治区
                    </option>
                    <option value="辽宁省">
                        	辽宁省
                    </option>
                    <option value="吉林省">
                        	吉林省
                    </option>
                    <option value="黑龙江省">
                        	黑龙江省
                    </option>
                    <option value="上海市">
                        	上海市
                    </option>
                    <option value="江苏省">
                        	江苏省
                    </option>
                    <option value="浙江省">
                        	浙江省
                    </option>
                    <option value="安徽省">
                        	安徽省
                    </option>
                    <option value="福建省">
                        	福建省
                    </option>
                    <option value="江西省">
                       	 江西省
                    </option>
                    <option value="山东省">
                        	山东省
                    </option>
                    <option value="河南省">
                        	河南省
                    </option>
                    <option value="湖北省">
                        	湖北省
                    </option>
                    <option value="湖南省">
                       	 湖南省
                    </option>
                    <option value="广东省">
                        	广东省
                    </option>
                    <option value="广西壮族自治区">
                        	广西壮族自治区
                    </option>
                    <option value="海南省">
                        	海南省
                    </option>
                    <option value="重庆市">
                        	重庆市
                    </option>
                    <option value="四川省">
                        	四川省
                    </option>
                    <option value="贵州省">
                        	贵州省
                    </option>
                    <option value="云南省">
                        	云南省
                    </option>
                    <option value="西藏自治区">
                        	西藏自治区
                    </option>
                    <option value="陕西省">
                        	陕西省
                    </option>
                    <option value="甘肃省">
                        	甘肃省
                    </option>
                    <option value="青海省">
                        	青海省
                    </option>
                    <option value="宁夏回族自治区">
                        	宁夏回族自治区
                    </option>
                    <option value="新疆维吾尔自治区">
                        	新疆维吾尔自治区
                    </option>
                    <option value="香港特别行政区">
                        	香港特别行政区
                    </option>
                    <option value="澳门特别行政区">
                        	澳门特别行政区
                    </option>
                    <option value="台湾省">
                       	 	台湾省
                    </option>
                    <option value="其它">
                        	其它
                    </option>
                </select>
                    &nbsp;&nbsp;
                    <input type="hidden" id="ct" value="<?php echo ($data["city"]); ?>">
                    <select id="city" name="city" style="width:185px">
                        <option value="">
                            --请选择城市--
                        </option>
                    </select>
                    <input type="hidden" id="cn" value="<?php echo ($data["country"]); ?>">
                    <select id="town" name="country" style="width:185px">
                        <option value="">
                            --请选择地区--
                        </option>
                    </select>
                </div>
        </div>
        <div class="form-item">
	            <label class="item-label">详细地址</label>
	            <div class="controls">
	                <input type="text" class="text input-large" name="detail_address" value="<?php echo ($data["detail_address"]); ?>">
	            </div>
        </div>
        <div class="form-item">
	        <div style="width:350px;float:left;">
	            <label class="item-label">客户类别</label>
	            <div class="controls">
	                <input type="hidden" id="ctype" value="<?php echo ($data["customer_type"]); ?>"/>
	                <select name="customer_type" id="customer_type" style="width:230px;height:29px;" class="text">
		                <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tpname): $mod = ($i % 2 );++$i;?><option value="<?php echo ($tpname["type_name"]); ?>" ><?php echo ($tpname["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	                </select>
	            </div>
	        </div>
            <label class="item-label">客户来源</label>
            <div class="controls">
            <input type="hidden" id="csource" value="<?php echo ($data["customer_source"]); ?>">
            <select name="customer_source" id="customer_source" style="width:230px;height:29px;" class="text">
                <?php if(is_array($source)): $i = 0; $__LIST__ = $source;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sourcename): $mod = ($i % 2 );++$i;?><option value="<?php echo ($sourcename["source_name"]); ?>" ><?php echo ($sourcename["source_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            </div>
        </div>
        <div class="form-item">
	        <div style="width:350px;float:left;">
	            <label class="item-label">所属行业</label>
	            <div class="controls">
	                <input type="text" class="text" name="trade" value="<?php echo ($data["trade"]); ?>">
	            </div>
	        </div>
            <label class="item-label">网站地址</label>
            <div class="controls">
                <input type="text" class="text" name="website" value="<?php echo ($data["website"]); ?>" >
            </div>   
        </div>
        <div class="form-item">
	        <div style="width:350px;float:left;">
	            <label class="item-label">合同始日</label>
	            <div class="controls">
	                <input type="text" class="text" placeholder="请输入日期" name="contract_start" 
	                onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" 
	                value="<?php echo (date('Y-m-d H:i:s',$data["contract_start"])); ?>">
	            </div>
	        </div>
            <label class="item-label">合同止日</label>
            <div class="controls">
	                <input type="text" class="text" placeholder="请输入日期" name="contract_end" 
	                onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"
	                value="<?php echo (date('Y-m-d H:i:s',$data["contract_end"])); ?>">
	            </div>
        </div>
        <div class="form-item">
	            <label class="item-label">备注</label>
	            <div class="controls">
	                <textarea name="notes" class="textarea" rows="4" cols="80"><?php echo ($data["notes"]); ?></textarea>
	            </div>
        </div>
        <div class="form-item">
	        <div style="width:350px;float:left;">
	            <label class="item-label">建档客服</label>
	            <div class="controls">
	                <input type="text" class="text" name="create_people" value="<?php echo ($data["create_people"]); ?>" >
	            </div>
	        </div>
            <label class="item-label">建档时间</label>
            <div class="controls">
                <input type="text" class="text" name="create_time" 
                value="<?php echo (date('Y-m-d H:i:s',$data["create_time"])); ?>"
                onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
            </div>
        </div>
        
        <div class="form-item">
        <!-- 有ajax     -->
        	<button class="btn submit-btn ajax-post" id="submit" type="submit" target-form="form-horizontal">确 定</button>
            <button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
        </div>
        <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>" > 
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
    new PCAS("province", "city", "country",document.getElementById('pv').value,document.getElementById('ct').value,document.getElementById('cn').value);
	!function(){
		laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
		laydate({elem: '#demo'});//绑定元素
	}();
	function fun(m,n){
		var obj = document.getElementById(m);
		var ctype = document.getElementById(n).value;
		for(var i=0; i<obj.length; i++){
			if(obj[i].value == ctype){
				obj[i].selected = true;
			}
		}
	}
	fun('customer_type','ctype');
	fun('customer_source','csource');
</script>

</body>
</html>