<?php

namespace Admin\Model;
use Think\Model;

/**
 * 部门模型
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */

class MyDepartmentModel extends Model {
	
	protected $_validate = array(
		array('department','require','职称不能为空'),
	);
	
	protected $_auto = array(
		array('description','getDepartmentDescription',1,'callback'),
		array('who_add',UID),
		array('create_time','time',1,'function'),
		array('update_time','time',2,'function'),
		array('status',1)
	);
	
	protected function getDepartmentDescription(){
		$description = I('post.description') ? I('post.description') : '';
		return $description;
	}
}