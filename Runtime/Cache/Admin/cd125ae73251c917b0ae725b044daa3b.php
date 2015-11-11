<?php if (!defined('THINK_PATH')) exit();?>
<style>
	.navi{
		width: 8%;
		height: 40px;
		float: left;
		text-align: center;
		font-family: "Microsoft Yahei",arial,sans-serif;
		font-size: 18px;
		line-height: 35px;
		
	}
	
	a{
		display:block;
	}
	
	:link{
		text-decoration: none;
		color: #000;
	}
	:visited{
	}
	:hover{
		color: #FFF;
		background-color: #86dc01;
	}
	:active{
		color: #84d902;
	}
</style>
<body>
<div style="width:100%;height:100%;border-bottom:2px solid #86dc01;">
	<li class="navi"><a href="<?php echo U('Custom/feedbackListOne?customer_number='.$customer_number);?>" target="under">联系记录</a></li>
	<li class="navi"><a href="<?php echo U('Custom/123');?>" target="under">合同文档</a></li>
	<li class="navi"><a href="<?php echo U('Custom/');?>" target="under">联系人</a></li>
</div>

</body>