<?php
/**
 * 客户资料
**/
namespace Admin\Model;
use Think\Model;
class MyCustomerDataModel extends Model{

	protected $_validate = array(
			array('customer_name', '2,16', '客户名称长度为2-16个字符', self::EXISTS_VALIDATE, 'length'),
			array('contact_name','2,10','联系人名称长度为2-10个字符',self::EXISTS_VALIDATE,'length'),
			array('email','email','邮箱格式不合法'),
			array('tel','/^[1][358][0-9]{9}$/','请输入正确的手机号码'),
	);

	protected $_auto = array(
			array('birthday','unixTime',3,'callback'),
			array('contract_start','unixTime',3,'callback'),
			array('contract_end','unixTime',3,'callback'),
			array('create_time','unixTime',3,'callback'),
			array('customer_service','setCustomerservice',self::MODEL_BOTH,'callback'),
			array('last_time', 0, self::MODEL_INSERT),
			array('appoint_time', 0, self::MODEL_INSERT),
			array('status', 0, self::MODEL_INSERT),
	);
	
	/*
	 *将表中英文文本的日期时间解析为Unix时间戳
	 */
	
	public function unixTime($birthday){
		return strtotime($birthday);
	}
	
	public function setCustomerservice(){
		return I('create_people');
	}
	
	

}
