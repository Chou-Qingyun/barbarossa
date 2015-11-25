<?php
/**
 * 客户类别
**/
namespace Admin\Model;
use Think\Model;
class MyCustomerTypeModel extends Model{

	protected $_validate = array(
			array('type_name','require','客户类型不能为空'),
			array('type_name', '', '类型名称被占用', self::EXISTS_VALIDATE, 'unique'),
			array('operator','require','操作人不能为空'),
	);

	protected $_auto = array(
			array('create_time', NOW_TIME, self::MODEL_INSERT),
			array('is_default', '否', self::MODEL_INSERT),
	);


}