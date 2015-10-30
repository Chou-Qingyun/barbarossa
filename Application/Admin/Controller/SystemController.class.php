<?php

namespace Admin\Controller;

class SystemController extends AdminController {
	public function index(){
		$this->display();
	}
	
	/* 员工信息管理 */
	public function employeeManage(){
		echo 'employeeManage';
	}
	
	public function employeeManageAdd(){
		echo 'employeeManageAdd';
	}
	
	/* 企业部门管理 */
	public function departmentManage(){
		echo 'departmentManage';
	}
	
	/* 系统角色管理 */
	public function roleManage(){
		echo 'roleManage';
	}
	
	/* 客户池设置 */
	public function customPoolSetting(){
		echo 'customPoolSetting';
	}
}