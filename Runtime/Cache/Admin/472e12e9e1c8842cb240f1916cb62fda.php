<?php if (!defined('THINK_PATH')) exit();?>
<style>
	table.record_t{
		width: 100%;
		font-family: "Microsoft Yahei",arial,sans-serif;
		font-size: 16px;
		text-align: center;
	}
	
	 .tr_bk{
	 	font-weight: bold;
	 	background: #DFDFDF;
	 }
</style>

    <table class="record_t">
	    <tr class="tr_bk">
	    	<td width="200px">联系时间&客服</td>
	    	<td>联系内容</td>
	    	<td width="200px">类型&联系人</td>
	    	<td width="200px">联系方式&号码</td>
	    	<td width="120px">预约时间</td>
	    	<td width="100px">操作</td>
	    </tr>
    <?php if(!empty($_feed)): if(is_array($_feed)): $i = 0; $__LIST__ = $_feed;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tr_style">
	    		<td><?php echo (date("Y-m-d H:i:s",$vo["last_time"])); ?><br>
	    			<?php echo ($vo["customer_service"]); ?>
	    		</td>
	    		<td><?php echo ($vo["contact_content"]); ?></td>
	    		<td><?php echo ($vo["contact_type"]); ?><br>
	    			<?php echo ($vo["contact_name"]); ?>
	    		</td>
	    		<td><?php echo ($vo["contact_way"]); ?><br>
	    			<?php echo ($vo["txttel"]); ?>
	    		</td>
	    		<td><?php echo (date("Y-m-d",$vo["appoint_time"])); ?><br><?php echo (date("H:i:s",$vo["appoint_time"])); ?></td>
	    		<td>
	    			<a href="">编辑</a>&nbsp;&nbsp;
	    			<a href="">删除</a>
	    		</td>
	    	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php else: ?>
			<td colspan="6" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
    	
    </table>
    
    <div class="page">
        <?php echo ($_page); ?>
    </div>



	<script>
		var obj = document.getElementsByClassName('tr_style');
		for(var i=0; i<obj.length; i++){
			if(i % 2 == 0){
				obj[i].style.background="#FFF";
			}	
		}
	</script>