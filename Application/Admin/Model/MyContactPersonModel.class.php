<?php

namespace Admin\Model;
use Think\Model;

/**
 * 部门模型
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */

class MyContactPersonModel extends Model {
	
	protected $_validate = array(
		array('contact_name','require','联系人不能为空'),
		array('tel','require','联系方式不能为空'),
		array('email','require','邮箱不能为空')
	);
	
	protected $_auto = array(
		array('birthday','unixTime',3,'callback')
	);
	
	protected function unixTime($birthday){
		return strtotime($birthday);
	}
}