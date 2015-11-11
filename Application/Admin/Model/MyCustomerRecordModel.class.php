<?php
/*联系记录*/
namespace Admin\Model;
use Think\Model;

class MyCustomerRecordModel extends Model{
	protected $_validate = array(
			array('contact_name','require','联系人不为空',self::EXISTS_VALIDATE),
			array('contact_content','require','联系内容不能为空',self::EXISTS_VALIDATE),
	);
	
	protected  $_auto = array(
			array('last_time','unixTime',3,'callback'),
			array('appoint_time','unixTime',3,'callback'),
	);
	
	public function unixTime($sometime){
		return strtotime($sometime);
	}
}