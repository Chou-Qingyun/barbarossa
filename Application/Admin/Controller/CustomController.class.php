<?php

namespace Admin\Controller;

class CustomController extends AdminController {
	public function index(){
		
	}
	
	/*过滤ID*/
	public function filterId($id){
		($id==0) && $this->error('请选择要操作的数据');
		$id = array_unique((array)I('id'));
		$id = is_array($id) ? implode(',',$id) : $id;
		return $id;
	}
	
	/* 客户资料管理 */
	public function customList(){
		$categoryManage = M('MyCustomerType');
		$sourceManage = M('MyCustomerSource');
		$type = $categoryManage->where('status=0')->select();
		$source = $sourceManage->where('status=0')->select();
		$list = $this->lists('MyCustomerData','','id');
		$this->assign('_list',$list);
		$this->assign('type',$type);
		$this->assign('source',$source);
		$this->meta_title = "客户列表";
		$this->display();
		
		
	}
	
	public function customListAdd(){
		if(IS_POST){
			$customData = D('MyCustomerData');
			if (!$customData->create()) {
				$this->error($customData->getError());
			}else{
				if ($customData->add($data)) {
					$this->success('客户资料添加成功',U('Custom/customlist'));
				}
			}
		}else{
			$categoryManage = M('MyCustomerType');
			$sourceManage = M('MyCustomerSource');
			$type = $categoryManage->where('status=0')->select();
			$source = $sourceManage->where('status=0')->select();
			$this->assign('type',$type);
			$this->assign('source',$source);
			$this->meta_title = '新增客户资料';
			$this->display();
		}
		
		
	}
	
	public function customListUpdate($id=0){
		($id == 0) && $this->error('参数出错');
		if(IS_POST){
			$customData = D('MyCustomerData');
			$map['id'] = I('id');
			if (!$customData->create()) {
				$this->error($customData->getError());
			}else{
				if ($customData->where($map)->save()) {
					$this->success('客户资料更新成功',U('Custom/customList'));
				}else{
					$this->error('更新失败，请重新操作');
				}
			}
			
		}else{
			$where = array('id' => $id);
			$customData = M('MyCustomerData');
			$categoryManage = M('MyCustomerType');
			$sourceManage = M('MyCustomerSource');
			$list = $customData->where($where)->find();
			$type = $categoryManage->where('status=0')->select();
			$source = $sourceManage->where('status=0')->select();
			$this->assign('type',$type);
			$this->assign('source',$source);
			$this->assign('data',$list);
			$this->meta_title = "编辑客户详细";
			$this->display();
			
		}
		
	}
	
	//批量修改客户类型
	public function customListChangeCategory($id=0){
		
		if (IS_POST){
			 // dump(I('post.'));
			$id = I('id');
			$data['customer_type'] = I('customer_type');
			$map['id'] = array('in',$id);
			$customData = D('MyCustomerData');
			if($customData->where($map)->field('customer_type')->save($data)){
				$this->success('更新成功！',U('Custom/customList'));
			}else{	
				$this->error('更新失败，请重新操作！');
			}

			
		}else{
			/* ($id == 0) && $this->error('请选择要修改的数据');
			$id = array_unique((array)I('id',0));
			$id = is_array($id) ? implode(',', $id) : $id; */
			$id = $this->filterId($id);
			$map['id'] = array('in',$id);
			$customerData = M('MyCustomerData');
			$categoryManage = M('MyCustomerType');
			$list = $customerData->where($map)->select();
			$type = $categoryManage->where('status=0')->select();
			$this->meta_title = "批量修改客户类型";
			$this->assign('_type',$type);
			$this->assign('_list',$list);
			$this->assign('_id',$id);
			 // dump($list);die();
			$this->display('customlistchangecategory');
		}
		
		
	}
	
	//批量修改客户来源
	public function customListChangeSource($id=0){
		if (IS_POST){
			 // dump(I('post.'));
			$id = I('id');
			$data['customer_source'] = I('customer_source');
			$map['id'] = array('in',$id);
			$customData = D('MyCustomerData');
			if($customData->where($map)->field('customer_source')->save($data)){
				$this->success('更新成功！',U('Custom/customList'));
			}else{	
				$this->error('更新失败，请重新操作！');
			}

			
		}else{
			/* ($id == 0) && $this->error('请选择要修改的数据');
			$id = array_unique((array)I('id',0));
			$id = is_array($id) ? implode(',', $id) : $id; */
			$id = $this->filterId($id);
			$map['id'] = array('in',$id);
			$customerData = M('MyCustomerData');
			$sourceManage = M('MyCustomerSource');
			$list = $customerData->where($map)->select();
			$source = $sourceManage->where('status=0')->select();
			$this->meta_title = "批量修改客户来源";
			$this->assign('_source',$source);
			$this->assign('_list',$list);
			$this->assign('_id',$id);
			 // dump($list);die();
			$this->display('customlistchangesource');
		}
	}
	
	//批量客户指派
	public function customListOfone(){
		echo "客户指派";	
	}
	
	//客户资料导出Excel
	public function customListOutexcel(){
		
	}
	
	public function customListDelete($id=0){
		$id = $this->filterId($id);
		$map['id'] = array('in',$id);
		$this->delete('MyCustomerData',$map);
	}
	
	/*客户资料搜索结果*/
	public function customListSearch(){
		$this->Search('','customlist');
	}
	
	/*搜索方法*/
	public function Search($condition=null,$url=null){
		$arr = I('get.','htmlspecialchars');
		/* dump($condition);
		dump($arr); */
		if(empty($arr)){
			$this->redirect('customList');
		}else{
			if (array_key_exists('search_content', $arr)) {
				$map['customer_name'] = array('like','%'.$arr['search_content'].'%');
				$map['contact_name'] = array('like','%'.$arr['search_content'].'%');
				$map['province'] = array('like','%'.$arr['search_content'].'%');
				$map['city'] = array('like','%'.$arr['search_content'].'%');
				$map['country'] = array('like','%'.$arr['search_content'].'%');
				$map['detail_address'] = array('like','%'.$arr['search_content'].'%');
				$map['customer_service'] = array('like','%'.$arr['search_content'].'%');
				$map['tel'] = array('like','%'.$arr['search_content'].'%');
				$map['_logic'] = 'OR';
				if(count($arr)>1){
					unset($arr['search_content']);
					foreach ($arr as $key => $value){
						if(empty($value)){
							unset($arr[$key]);
						}else{
							$where[$key] = $value;
						}
					}
					if(count($where)>1){
						$where['_logic'] = 'AND';
					}
					$where['_complex'] = $map;
				}else{
					$where['_logic'] = 'AND';
					$where['_complex'] = $map;
				}
				
			}else{
				foreach ($arr as $key => $value){
					if (empty($value)){
						unset($arr[$key]);
					}else{
						$where[$key] = $value;
					}
				}
				if(count($where)>1){
					$where['_logic'] = 'AND';
				}
			}
// 			dump($where);die();
			if(!empty($condition)){
				$key = key($condition);
				$value = current($condition);
				$where[$key] = $value;
			}
// 			$customData = M('MyCustomerData');
//  		dump($where);die();
			$list = $this->lists('MyCustomerData',$where,'id');
			$type = $this->lists('MyCustomerType');
			$source = $this->lists('MyCustomerSource');
// 			echo $customData->getLastSql();
			/*dump($list);die(); */
			$this->assign('_list',$list);
			$this->assign('type',$type);
			$this->assign('source',$source);
			$this->display($url);
		}
		
	}
	
	/*客户的资料的细节操作*/
	public function customListDetail($id=0){
		($id==0) && $this->error('参数错误');
		$map['id'] = $id;
		$list = $this->lists('MyCustomerData',$map);
		$this->assign('_list',$list);
		$this->meta_title = '客户信息详细';
		$this->display();
	}
	
	
	
	/* 我的客户列表 */
	public function myCustomList(){
		$map['customer_service'] = get_username();
		$list = $this->lists('MyCustomerData',$map,'id');
		$type = $this->lists('MyCustomerType');
		$source = $this->lists('MyCustomerSource');
// 		dump($list);die();
		$this->assign('user',get_username());
		$this->assign('type',$type);
		$this->assign('source',$source);
		$this->assign('_list',$list);
		$this->display(mycustomlist);
	}
	
	/* 我的领用 */
	public function myCustomListSelf(){
		$list = $this->lists('MyCustomerReceive','','receive_id');
		$this->assign('_list',$list);
		$this->display();
		
		
	}
	
	/*即将回收*/
	public function myCustomListRec(){
		$this->assign('user',get_username());
		$this->display();
		
	}
	
	/*我的客户放弃操作*/
	public function myCustomListGiveup($id=0){
		/* ($id == 0) && $this->error('请选择要操作的数据');
		$id = array_unique((array)I('id'));
		$id = is_array($id) ? implode(',',$id) : $id; */
		$id = $this->filterId($id);
		$map['id'] = array('in',$id);
		$data['customer_service'] = '公共客户';
		$this->editRow('MyCustomerData', $data, $map);
	}
	
	/*我的客户共享操作*/
	public function myCustomListShare(){
		
	}
	
	/*我的客户搜索操作*/
	public function myCustomListSearch(){
		$where = array('customer_service'=> get_username());
		$this->Search($where,'mycustomlist');
		
	}
	
	/* 联系记录管理 */
	public function feedbackList(){
		
	}
	
	/*添加联系记录*/
	public function feedbackListAdd(){
		if (IS_POST) {
			$customerRecord = D('MyCustomerRecord');
			if(!$customerRecord->create()){
				$this->error($customerRecord->getError());
			}else{
				if($customerRecord->add()){
					$map['id'] = I('customer_id');
					$data['last_time'] = strtotime(trim(I('last_time')));
					$data['appoint_time'] = strtotime(trim(I('appoint_time')));
					if(!empty($data)){
						$customerData = M('MyCustomerData');
						$customerData->where($map)->save($data);
					}
					$this->success('联系记录添加成功',U('customListDetail?id='.I('customer_id')));
				}else{
					$this->error('添加失败，请重新操作');
				}
			}
			
			
		}else{
			$id = I('id',0);
			$map['id'] = $id;
			$list = $this->lists('MyCustomerData',$map);
			$type = $this->lists('MyCustomerType');
			$this->meta_title = '添加联系记录';
			$this->assign('customer_id',$id);
			$this->assign('type',$type);
			$this->assign('_list',$list);
			$this->display();
		}
	}
	
	/*在客户信息详细显示导航模块*/
	public function nav($customer_number=null){
		empty($customer_number) && $this->error('客户编码错误');
// 		dump($customer_number);
		$this->assign('customer_number',$customer_number);
		$this->display();
	}
	
	
	
	/*某个客户的联系记录*/
	public function feedbackListOne($customer_number=null){
		empty($customer_number) && $this->error('客户编码错误');
// 		dump($customer_number);
		$map['customer_number'] = $customer_number;
// 		dump($map);
		
		$feed = $this->lists('MyCustomerRecord',$map);
// 		dump($feed);
		$this->assign('_feed',$feed);
		$this->display();
		
	}
	
	/* 等待回访客户列表 */
	public function waitLinkList(){
		
	}
	
	/* 客户资料导入 */
	public function excelUpload(){
		
	}
	
	/* 共享客户列表 */
	public function shareCustomList(){
		
	}
	
	/* 公共客户管理 */
	public function customPoolManage(){
		$map['customer_service'] = '公共客户';
		$list = $this->lists('MyCustomerData',$map,'id');
		$type= $this->lists('MyCustomerType');
		$source = $this->lists('MyCustomerSource');
		$this->assign('type',$type);
		$this->assign('source',$source);
		$this->assign('_list',$list);
		$this->display();
	}
	
	/* 公共客户领用*/
	public function customPoolManageUse($id=0){
		$id = $this->filterId($id);
		$where['id'] = array('in',$id);
		
		$customerData = M('MyCustomerData');
		$customerReceive = M('MyCustomerReceive');
		$list = $customerData->where($where)->getField('id,customer_name,contact_name,tel,customer_type,create_people,create_time');
// 		dump($list);
		foreach ($list as $value){
			$customerReceive->add($value);
		}
		
		$data['customer_service'] = get_username();
		$this->editRow('MyCustomerData', $data, $where);
		
	}
	
	/* 公共客户搜索*/
	public function customPoolManageSearch(){
		$where = array('customer_service'=>'公共客户');
		$this->Search($where,'custompoolmanage');
	}
	
	/* 客户类别管理 */
	public function categoryManage(){
		$list = $this->lists('MyCustomerType','','id');
		$this->assign('_list',$list);
// 		print_r(get_defined_constants(true));die();
		$this->meta_title = '客户类型管理';
		$this->display();	
	}
	
	/* 客户类别添加*/
	public function categoryManageAdd(){
		
		if(IS_POST){
			/* $this->success('添加成功'); */
			$categoryManage = D('MyCustomerType');
			if (!$categoryManage->create()) {
				$this->error($categoryManage->getError());
			}else{
				if ($categoryManage->add()) {
					$this->success('客户类别添加成功',U('Custom/categoryManage'));
				}
			} 
			
		}else{
			$this->meta_title = '新增客户类别';
 			$this->display();
			
		}
		
	}	
	
	/* 客户类别操作* */
	public function categoryManageAction($method=null){
		$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',',$id) : $id;
		if (empty($id)){
			$this->error('请选择要操作的数据');
		}
		$map['id'] = array('in',$id);
		switch(strtolower($method)){
			case 'edit':
				$categoryManage = M('MyCustomerType');
				$data = $categoryManage->field(TRUE)->find($id);
				$this->assign('_data',$data);
				$this->meta_title = '编辑客户类型';
				$this->display('Custom/categorymanageedit');
				break;
			case 'delete':
				$this->delete('MyCustomerType',$map);
				break;
			case 'setdefault':				
				$condit['id'] = array('neq',$id);
				$categoryManage = M('MyCustomerType');
				if($categoryManage->where($map)->setField('is_default','是')){
					$categoryManage->where($condit)->setField('is_default','否');
					$this->success('设置成功');
				}else{
					$this->error('设置失败!请重新操作');
				}
				break;
			case 'canceldefault':
				$condit['is_default'] = '否';
				$msg = array('success'=> '设置成功','error' => '设置失败');
				$this->editRow('MyCustomerType', $condit, $map, $msg);
				break;
			default:
				$this->error('参数错误');
				break;
		
		}
	}
		/*
		 * 客户类型编辑提交 
		*/
		public function categoryManageUpdate($id = 0){
			if($id == 0)
			$this->error('参数错误！');
			if(IS_POST){
				$categoryManage = D('MyCustomerType'); 
				$map['id'] = $id;
				if(!$categoryManage->create()){
					$this->error($categoryManage->getError());
				}else{
					if ($categoryManage->where($map)->save()){
						$this->success('客户类型更新成功',U('Custom/categoryManage'));
					}else{
						$this->error($categoryManage->getError());
					}
				}
				$data = I('post.','htmlspecialchars');
				$msg = array( 'success'=>'类型更新成功！', 'error'=>'类型更新失败！','url'=> U('Custom/categoryManage'));
				$this->editRow('MyCustomerType', $data, $map, $msg);
			}
			
		}
		
		/*
		 * 客户类型搜索
		 * */
		public function categoryManageSearch($type_name=null){
			if (empty($type_name)){
				$this->redirect('categoryManage');	
			}else{
				$where['type_name'] = array('like','%'.trim($type_name).'%');
				$list = $this->lists('MyCustomerType',$where,'id');
				$this->assign('_list',$list);
				$this->meta_title = '搜索结果';
				$this->display('categorymanage');
			}
		}
	
	/* 客户来源管理 */
	public function sourceManage(){
		$list = $this->lists('MyCustomerSource','','id');
		int_to_string($list);
		$this->assign('_list',$list);
		$this->meta_title = '客户来源管理';
		$this->display();		
	}
	

	/* 客户来源添加*/
	public function sourceManageAdd(){

		if(IS_POST){
			$sourceManage = D('MyCustomerSource');
			if (!$sourceManage->create()) {
				$this->error($sourceManage->getError());
			}else{
				if ($sourceManage->add()) {
					$this->success('客户来源添加成功',U('Custom/sourceManage'));
				}
			}
				
		}else{
			$this->meta_title = '新增客户来源';
			$this->display();
				
		}
	
	}
	
	/* 客户来源操作* */
	public function sourceManageAction($method=null){
		//动作行为		
		$id = array_unique((array)I('id',0));
		$id = is_array($id) ? implode(',', $id) : $id;
		empty($id) && $this->error('参数不能为空！');
		$map['id'] = array('in',$id);
		
		switch (strtolower($method)){
			case 'delete':
				$this->delete('MyCustomerSource',$map);
				break;
			case 'setdefault':
				$condit['id'] = array('neq',$id);
				$sourceManage = M('MyCustomerSource');
				if($sourceManage->where($map)->setField('is_default','是')){
					$sourceManage->where($condit)->setField('is_default','否');
					$this->success('设置成功');
				}else{
					$this->error('设置失败!请重新操作');
				}
				break;
			case 'canceldefault':
				$condit['is_default'] = '否';
				$msg = array('success'=> '设置成功','error' => '设置失败');
				$this->editRow('MyCustomerSource', $condit, $map, $msg);
				break;
			default:
				$this->error('参数错误');
				break;
		}
	}
	
 	/* 客户来源编辑*/
	public function sourceManageEdit($id=0){
		if ($id == 0) {
			$this->error('参数错误，请重新操作');
		}
		
		$map['id'] = $id;
		if (IS_POST){
			$map['id'] = I('id');
			$sourceManage = D('MyCustomerSource');
			if (!$sourceManage->create()){
				$this->error($sourceManage->getError());
			}else{
				if ($sourceManage->where($map)->save()){
					$this->success('客户来源更新成功',U('Custom/sourceManage'));
				}else{
					$this->error('操作失败，请重新操作');
				}
			}
		}else{
			$sourceManage = M('MyCustomerSource');
			$data = $sourceManage->field(TRUE)->find($id);
			$this->assign('_data',$data);
			$this->meta_title = '编辑客户来源';
			$this->display('Custom/sourcemanageedit');
			
		}		
	} 
	/*
	 * 客户来源搜索
	 * */
	public function sourceManageSearch($source_name=null){
		if (empty($source_name)){
			$this->redirect('sourceManage');
		}else{
			$where['source_name'] = array('like','%'.trim($source_name).'%');
			$list = $this->lists('MyCustomerSource',$where,'id');
			$this->assign('_list',$list);
			$this->meta_title = '搜索结果';
			$this->display('sourcemanage');
		}
	}
	
	
}