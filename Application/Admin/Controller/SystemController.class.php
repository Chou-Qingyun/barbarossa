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
		$map['status']  =   array('egt',0);
		$list   = $this->lists('MyDepartment', $map);
		$this->assign('_list', $list);
		$this->meta_title = '部门列表';
		$this->display();
	}
	public function departmentManageAdd(){
		if(IS_POST){
			$D = D('MyDepartment');
			if($D->create()){
				if($D->add()){
					$this->success('添加成功',U('System/departmentManage'));
				}else{
					$this->error('添加失败');
				}
			}else{
				if(APP_DEBUG){
					$this->error($D->getError());
				}else{
					$this->error('数据初始化失败');
				}
			}
		}
		$this->meta_title = '新增部门';
		$this->display();
	}
	public function departmentManageEdit(){
		if(IS_POST){
			$D = D('MyDepartment');
			if($D->create()){
				if($D->save()){
					$this->success('添加成功',U('System/departmentManage'));
				}else{
					$this->error('添加失败');
				}
			}else{
				if(APP_DEBUG){
					$this->error($D->getError());
				}else{
					$this->error('数据初始化失败');
				}
			}
		}
		$this->department = M('MyDepartment')->where(array('id'=>I('get.id')))->find();
		$this->meta_title = '编辑部门';
		$this->display('departmentManageAdd');
	}
	
	public function departmentManageDelete(){
		$id = I('get.id');
		if($id){
			// 检查该部门下是否有员工,有则拒绝删除
			$total = M('Member')->where(array('department_id'=>$id))->count();
			if($total){
				$this->error('不能删除,该部门下还有'.$total.'名员工');
			}else{
				$res = M('MyDepartment')->where(array('id'=>$id))->delete();
				if($res){
					$this->success('删除成功');
				}else{
					$this->error('删除失败');
				}
			}
		}
	}
	
	/* 系统角色管理 */
	public function roleManage(){
		echo 'roleManage';
	}
	
	/* 客户池设置 */
	public function customPoolSetting(){
		if(IS_POST){
			$pool = D('MyCustomerPool');
			if($pool->create()){
				if($pool->count()){
					if($pool->save()){
						$this->success('更新成功');
					}else{
						$this->error('更新失败');
					}
				}else{
					if($pool->add()){
						$this->success('添加成功');
					}else{
						$this->error('添加失败');
					}
				}
			}else{
				$this->error($pool->getError());
			}
		}else{
			$map['status'] = array('eq',0);
			$customer_types = M('MyCustomerType')->where($map)->select();
			$customer_pool = M('MyCustomerPool')->where(array('id'=>1))->find();
			$scope_arr = explode(',', $customer_pool['recycle_scope']);
			$types = array();
			foreach($customer_types as $v){
				if(in_array($v['id'],$scope_arr)){
					$v['on'] = 1;
				}
				$types[] = $v;
			}
			$this->is_open = $customer_pool['is_open'];
			$this->assign('recycle_period',$customer_pool['recycle_period']);
			$this->assign('types',$types);
			$this->meta_title = '客户池设置';
			$this->display();
		}
	}
	
	public function test(){
		$this->display();
	}
	public function add(){
		dump($_POST);
	}
}