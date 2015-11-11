<?php
/**
 * 客户类别
**/
namespace Admin\Model;
use Think\Model;
class MyCustomerSourceModel extends Model{

	protected $_validate = array(
			array('source_name','require','客户来源不能为空'),
			array('source_name', '', '该客户来源已存在', self::EXISTS_VALIDATE, 'unique'),
			array('operator','require','操作人不能为空'),
	);

	protected $_auto = array(
			array('add_time', NOW_TIME, self::MODEL_INSERT),
			array('is_default', '否', self::MODEL_INSERT),
	);


}