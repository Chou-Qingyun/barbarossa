<?php
/**
 * 客户池
**/
namespace Admin\Model;
use Think\Model;
class MyCustomerPoolModel extends Model{

	protected $_validate = array(
			array('recycle_period', 'require', '回收周期不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
	);

	protected $_auto = array(
			array('is_open','getIsOpen',self::MODEL_BOTH,'callback'),
			array('recycle_scope','getRecycleScope',self::MODEL_UPDATE,'callback'),
	);
	
	protected function getRecycleScope(){
		$arr = I('post.ids');
		if(is_array($arr)){
			$res = implode(',',$arr);
		}else{
			$res = '';
		}
		return $res;
	}
	
	protected function getIsOpen(){
		$is_open = isset($_POST['is_open']) ? I('post.is_open') : 0;
		return $is_open;
	}

}