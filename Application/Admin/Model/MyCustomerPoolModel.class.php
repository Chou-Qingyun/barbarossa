<?php
/**
 * 客户池
**/
namespace Admin\Model;
use Think\Model;
class MyCustomerPoolModel extends Model{

	protected $_validate = array(
			//array('recycle_period', 'require', '回收周期不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
	);

	protected $_auto = array(
			array('recycle_scope','getRecycleScope',self::MODEL_UPDATE,'callback'),
	);
	
	protected function getRecycleScope(){
		$arr = I('post.id');
		return implode(',',$arr);
	}

}