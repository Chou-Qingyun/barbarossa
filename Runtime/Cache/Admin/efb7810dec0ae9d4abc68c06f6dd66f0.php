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
            

            
	<!-- 标题栏 -->
	<div class="main-title">
		<h2>客户资料管理</h2>
	</div>
	<div class="cf">
		<div class="fl">
            <a class="btn" href="<?php echo U('Custom/customListAdd');?>">新 增</a>
           <!--  <button class="btn ajax-post" url="<?php echo U('User/changeStatus',array('method'=>'resumeUser'));?>" target-form="ids">启 用</button>
            <button class="btn ajax-post" url="<?php echo U('User/changeStatus',array('method'=>'forbidUser'));?>" target-form="ids">禁 用</button> -->
            <button class="btn ajax-post confirm" url="<?php echo U('Custom/customListDelete');?>" target-form="ids">删 除</button>
            <a class="btn" href="javascript:;" id="changeC" url="<?php echo U('Custom/customListChangeCategory');?>" >批量修改客户类别</a>
            <a class="btn" href="javascript:;" id="changeS" url="<?php echo U('Custom/customListChangeSource');?>" >批量修改客户来源</a>
            <!-- <a class="btn"  href="javascript:;" id="change" url="<?php echo U('Custom/customListChangeSource');?>">批量修改客户来源</a> -->
            <button class="btn ajax-post confirm" url="<?php echo U('Custom/custom');?>" target-form="ids">客户指派</button>
            <a class="btn" href="javascript:;" id="expE" url="<?php echo U('Custom/customListOutexcel');?>">导出Excel</a>
        </div>



        <!-- 高级搜索 -->
		<div class="search-form fr cf">
			<div class="sleft">
				<input type="text" name="search_content" value="<?php echo ($sarr['search_content']); ?>" style="width:300px;" class="search-input"  placeholder="请输入客户名称/手机/联系人/地址/客服专员">
				<select class="search-input"  name="customer_type">
					<option value="">请选择客户类别</option>
					<?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ty): $mod = ($i % 2 );++$i;?><option value="<?php echo ($ty["type_name"]); ?>" <?php echo ($ty['type_name'] == $sarr['customer_type'] ? 'selected':''); ?>><?php echo ($ty["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<select class="search-input" name="customer_source">
					<option value="">请选择客户来源</option>
					<?php if(is_array($source)): $i = 0; $__LIST__ = $source;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sc): $mod = ($i % 2 );++$i;?><option value="<?php echo ($sc["source_name"]); ?>" <?php echo ($sc['source_name'] == $sarr['customer_source'] ? 'selected':''); ?>><?php echo ($sc["source_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<a class="sch-btn" href="javascript:;" id="search" url="<?php echo U('Custom/customListSearch');?>"><i class="btn-search"></i></a>
			</div>
		</div>
    </div>
    <!-- 数据列表 -->
    <div class="data-table table-striped">
	<table class="">
    <thead>
        <tr>
		<th class="row-selected row-selected"><input class="check-all" type="checkbox"/></th>
		<!-- <th class="">类别ID</th> -->
		<th class="">客户名称</th>
		<th class="">联系人</th>
		<th class="">客户类型</th>
		<th class="">客户来源</th>
		<th class="">建档人&时间</th>
		<th class="">客服专员</th>
		<th class="">最后一次联系</th>
		<th class="">预约联系时间</th>
		<th class="">操作</th>
		</tr>
    </thead>
    <tbody>
		<?php if(!empty($_list)): if(is_array($_list)): $i = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><input class="ids" type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>"/></td>
			<!-- <td><?php echo ($vo["id"]); ?> </td> -->
			<td><a href="<?php echo U('Custom/customListDetail?id='.$vo['id']);?>"><?php echo ($vo["customer_name"]); ?></a></td>
			<td><?php echo ($vo["contact_name"]); ?></td>
			<td><span><?php echo ($vo["customer_type"]); ?></span></td>
			<td><?php echo ($vo["customer_source"]); ?></td>
			<td><?php echo ($vo["create_people"]); ?>/<?php echo (date("Y-m-d",$vo["create_time"])); ?></td>
			<td><?php echo ($vo["customer_service"]); ?></td>
			<?php if($vo["last_time"] == 0): ?><td>未联系</td>
			<?php else: ?>
				<td><?php echo (date("Y-m-d H:i:s",$vo["last_time"])); ?></td><?php endif; ?>
			<?php if($vo["appoint_time"] == 0): ?><td>未预约</td>
			<?php else: ?>
				<td><?php echo (date("Y-m-d H:i:s",$vo['appoint_time'])); ?></td><?php endif; ?>
			<td>
				<a href="<?php echo U('Custom/customListUpdate?id='.$vo['id']);?>" class="">编辑</a>
			&nbsp;	
				<a href="<?php echo U('Custom/customListDelete?id='.$vo['id']);?>" class="ajax-get">删除</a>
			&nbsp;
				<!-- <a href="<?php echo U('Custom/customListUpdate?id='.$vo['id']);?>" class="ajax-get">设为默认</a>
			&nbsp;
				<a href="<?php echo U('Custom/sourceManageAction?method=cancelDefault&id='.$vo['id']);?>" class="ajax-get">取消默认</a>	 -->
			</td>
            
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php else: ?>
		<td colspan="10" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
	</tbody>
    </table>
	</div>
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
	
	//批量处理客户类别功能
	$("#changeC").click(function(){
		var url = $(this).attr('url');
		piliang(url);
		/* console.log(url); */
	});
	//批量处理客户来源功能
	$("#changeS").click(function(){
		var url = $(this).attr('url');
		piliang(url);
	});
	//批量导出客户资料的EXCEL
	$("#expE").click(function(){
		var url = $(this).attr('url');
		piliang(url);
	})
	

	function piliang(url) {
		var quer = document.getElementsByClassName('ids');
		
		for(i=0; i<quer.length; i++){
			if(quer[i].checked){
				if(url.indexOf('?')>0){
					url += ',' + quer[i].value ;
				}else{
					url += '?id=' + quer[i].value ;
				}
			}
        		}
		window.location.href = url;
		
	}
	
	
	
    //导航高亮
    highlight_subnav('<?php echo U('User/sourceManage');?>');
    var target_form = $(this).attr('target-form');
    console.log(target_form);
    
	</script>

</body>
</html>