<?php

namespace Admin\Controller;

use Think\Upload;
class CustomController extends AdminController {
	public function index(){
		
	}
	
	/*过滤ID*/
	public function filterId($id){
		($id==0) && $this->error('请选择要操作的数据');
		$id = array_unique((array)$id);
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
			// dump($id);die();
			$map['id'] = $id;
			// dump('post.');
			if (!$customData->create()) {
				$this->error($customData->getError());
			}else{
				if ($customData->where($map)->save()) {
					// echo $customData->getLastSql();
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
			if(empty($data['customer_type'])){
				$this->error('更新失败，请选择客户类型~！');
			}
			elseif($customData->where($map)->field('customer_type')->save($data)){
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
			if(empty($data['customer_source'])){
				$this->error('更新失败，请选择客户来源~！');
			}
			elseif($customData->where($map)->field('customer_source')->save($data)){
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
	public function customListOfone($id=0){
// 		dump(I('get.'));
		$id = $this->filterId($id);
		if(IS_POST){
// 			print_r(I('post.'));
// 			dump($id);
			$map['id'] = array('in',$id);
			$data['customer_service'] = I('employee');
			$customerData = M('MyCustomerData');
			if(empty($data['customer_service'])){
				$this->error('指派失败，请选择指派的对象~！');
			}elseif($customerData->where($map)->save($data)){
// 				echo 'aba';
				$this->success('更新成功！',U('Custom/customList'));
			}else{
					$this->error('指派失败，请重新操作~');
				}
			
		}else{
			$userArr = array();
			$map['id'] = array('in',$id);
			$list = $this->lists('MyCustomerData',$map);
			$department = $this->lists('MyDepartment','','id');
			$user = $this->lists('Member','','uid');
// 			dump($user);
			foreach ($department as $dValue){
				foreach ($user as $uValue){
					if($dValue['id'] == $uValue['department_id']){
						$userArr[$dValue['id']][] = $uValue['realname'];
					}
				}
			}
			$this->assign('_list',$list);
			$this->assign('_depart',$department);
			$user = json_encode($userArr);
			$this->assign('_user',$user);
			$this->assign('_id',$id);
			$this->display();
			
		}
	}
	
	//客户资料导出Excel
	public function customListOutexcel($id=0){
		date_default_timezone_set('Europe/London');
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
			/** Include PHPExcel */
			vendor('PHPExcel.PHPExcel');
			// Create new PHPExcel object
			$objPHPExcel = new \PHPExcel();
			
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '客户序列')
			->setCellValue('B1', '客户编码')
			->setCellValue('C1', '客户名称')
			->setCellValue('D1', '联系人')
			->setCellValue('E1', '性别')
			->setCellValue('F1', '职位')
			->setCellValue('G1', '出生日期')
			->setCellValue('H1', '固定电话')
			->setCellValue('I1', '联系方式')
			->setCellValue('J1', '办公电话')
			->setCellValue('K1', '传真')
			->setCellValue('L1', '邮箱')
			->setCellValue('M1', 'QQ/旺旺')
			->setCellValue('N1', '地址')
			->setCellValue('O1', '客户来源')
			->setCellValue('P1', '客户类别')
			->setCellValue('Q1', '所属行业')
			->setCellValue('R1', '网站地址')
			->setCellValue('S1', '合同始日')
			->setCellValue('T1', '合同止日')
			->setCellValue('U1', '备注')
			->setCellValue('V1', '建档人')
			->setCellValue('W1', '建档时间')
			->setCellValue('X1', '客服专员')
			->setCellValue('Y1', '最近一次联系时间')
			->setCellValue('Z1', '预约时间');
			// add mysql data, UTF-8
			//var_dump($_POST);die();
			if($id==0){
				$customerData = $this->lists('MyCustomerData','','id');
// 				dump($customerData);
			}else{
				$map['id'] = array('in', $id);
				$customerData = $this->lists('MyCustomerData',$map,'id');
// 				dump($customerData);
			}
// 			die();
			$i = 2;
			foreach($customerData as $v) {
				date_default_timezone_set("Asia/Shanghai");
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $v["id"])
				->setCellValue('B'.$i, $v["customer_number"])
				->setCellValue('C'.$i, $v["customer_name"])
				->setCellValue('D'.$i, $v["contact_name"])
				->setCellValue('E'.$i, $v["gender"])
				->setCellValue('F'.$i, $v["position"])
				->setCellValue('G'.$i, date('Y-m-d H:i:s',$v["birthday"]))
				->setCellValue('H'.$i, $v["phone"])
				->setCellValue('I'.$i, $v["tel"])
				->setCellValue('J'.$i, $v["office_number"])
				->setCellValue('K'.$i, $v["fax_number"])
				->setCellValue('L'.$i, $v["email"])
				->setCellValue('M'.$i, $v["QQ"])
				->setCellValue('N'.$i, $v["province"].$v["city"].$v["country"].$v["detail_address"])
				->setCellValue('O'.$i, $v["customer_source"])
				->setCellValue('P'.$i, $v["customer_type"])
				->setCellValue('Q'.$i, $v["trade"])
				->setCellValue('R'.$i, $v["website"])
				->setCellValue('S'.$i, date('Y-m-d H:i:s',$v["contract_start"]))
				->setCellValue('T'.$i, date('Y-m-d H:i:s',$v["contract_end"]))
				->setCellValue('U'.$i, $v["notes"])
				->setCellValue('V'.$i, $v["create_people"])
				->setCellValue('W'.$i, date('Y-m-d H:i:s',$v["create_time"]))
				->setCellValue('X'.$i, $v["customer_service"])
				->setCellValue('Y'.$i, date('Y-m-d H:i:s',$v["last_time"]))
				->setCellValue('Z'.$i, date('Y-m-d H:i:s',$v["appoint_time"]));
				$i++;
			}
		
			//设置单元格宽度   例：
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(50);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('客户资料列表');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel5)
			$fileName = get_username().date('_ymdHis').'_data';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename='.$fileName.'.xls');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');
			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0
			$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;
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
		$search_arr = $arr;
		/* dump($condition);
		dump($arr); */
		if(empty($arr)){
			$this->redirect($url);
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
						$where[$key] = $value;
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
						$where[$key] = $value;
				}
				if(count($where)>1){
					$where['_logic'] = 'AND';
				}
			}
// 			dump($where);
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
// 			dump($arr);
			$this->assign('sarr',$search_arr);
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
		$this->assign('type',$type);
		$this->assign('source',$source);
		$this->assign('_list',$list);
		$this->display();
	}
	
	/* 我的领用 */
	public function myCustomListSelf(){
		$list = $this->lists('MyCustomerReceive','','receive_id');
		$this->assign('user',get_username());
		$this->assign('_list',$list);
		$this->display();
		
		
	}
	
	/*即将回收*/
	public function myCustomListRec(){
		$sql = "select id,(". time() ."-last_time) as subtime,(". time() ."-create_time) as subcreate,last_time as ltime from " .C('DB_PREFIX'). "my_customer_data group by id having (subtime>3600*7*30 and subtime<".time().") or (subcreate>3600*7*30 and ltime=0)";
		$customerData = M('MyCustomerData');
		$item = $customerData->query($sql);
		// 		dump($item);
		foreach ($item as $vo){
			$arr[] = $vo['id'];
		}
		$where['id'] = array('in',implode(',', $arr));
		$where['customer_service'] = get_username();
		$list = $this->lists('MyCustomerData',$where,'id');
// 		dump($list);
		$this->assign('_list',$list);
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
	
	
	/*我的客户搜索操作*/
	public function myCustomListSearch(){
		$where = array('customer_service'=> get_username());
		$this->Search($where,'mycustomlist');
		
	}
	
	/* 联系记录管理 */
	public function feedbackList(){
		$list = $this->lists('MyCustomerRecord');
		$start_time = date('Y-m-d H:i:s',time());
		$end = time() + 3600*24*30;
		$end_time = date('Y-m-d H:i:s', $end );
// 		$list = null;
		$this->assign('start_time',$start_time);
		$this->assign('end_time',$end_time);
		$this->assign('_list',$list);
// 		dump($list);
		$this->display();
	}
	
	/*联系记录搜索*/
	public function feedbackListSearch(){
		$searchArr = I('get.');
		$arr = $searchArr;
// 		dump($searchArr);
		if(empty($searchArr)){
			$this->redirect('feedbacklist');
		}else{
			if(array_key_exists('search_content', $searchArr)){
				$map['customer_name'] = array('like','%'.$searchArr['search_content'].'%');
				$map['txttel'] = array('like','%'.$searchArr['search_content'].'%');
				$map['contact_name'] = array('like','%'.$searchArr['search_content'].'%');
				$map['contact_content'] = array('like','%'.$searchArr['search_content'].'%');
				$map['_logic'] = 'OR';
				unset($searchArr['search_content']);
			}
				
			if(array_key_exists('time_start', $searchArr)){
				$where['last_time'] = array('between',strtotime(trim($searchArr['time_start'])).",".strtotime(trim($searchArr['time_end'])));
				unset($searchArr['time_start'],$searchArr['time_end']);
			}
			foreach ($searchArr as $key => $value){
				$where[$key] = $value;
			}
			if(isset($map)){
				$where['_complex'] = $map;
			}
			$where['_logic'] = 'AND';	
		}
// 		$feedbacklist = M('MyCustomerRecord');
		$list = $this->lists('MyCustomerRecord',$where,'id');
// 		echo $feedbacklist->getLastSql();
// 		dump($arr);
		$this->assign('searched',$arr);
		$this->assign('_list',$list);
		$this->display('feedbacklistsearch');
		
	}
	
	
	/*查看联系记录*/
	public function feedbackListCat($id){
		$id = $this->filterId($id);
		$map['id'] = array('in',$id);
		$onelist = $this->lists('MyCustomerRecord',$map);
		$customerRecord = M('MyCustomerRecord');
		$where['customer_number'] = $customerRecord->where($map)->getField('customer_number');
// 		dump($onelist);
//  	dump($where);
		$customerData = M('MyCustomerData');
		$customer_type = $customerData->where($where)->getField('customer_type');
// 		dump($customer_type);
		$this->assign('customer_type',$customer_type);
		$this->assign('_onelist',$onelist);
		$this->display();
	}
	
	/*添加联系记录*/
	public function feedbackListAdd(){
		if (IS_POST) {
			$customerRecord = D('MyCustomerRecord');
			if(!$customerRecord->create()){
				$this->error($customerRecord->getError());
			}else{
				if($customerRecord->add()){
					$map['customer_number'] = I('customer_number');
					$data['last_time'] = strtotime(trim(I('last_time')));
					$data['appoint_time'] = strtotime(trim(I('appoint_time')));
					if(!empty($data)){
						$customerData = M('MyCustomerData');
						$customerData->where($map)->save($data);
						$customer_id = $customerData->where($map)->getField('id');
					}
					$this->success('联系记录添加成功',U('customListDetail?id='. $customer_id));
				}else{
					$this->error('添加失败，请重新操作');
				}
			}
			
			
		}else{
			$map['customer_number'] = I('customer_number');
			$list = $this->lists('MyCustomerData',$map);
			$type = $this->lists('MyCustomerType');
			$this->meta_title = '添加联系记录';
			$this->assign('type',$type);
			$this->assign('_list',$list);
			$this->display();
		}
	}
	
	/*联系记录编辑*/
	public function feedbackListEdit($id=0){
		if (IS_POST) {
			$customerRecord = D('MyCustomerRecord');
			if(!$customerRecord->create()){
				$this->error($customerRecord->getError());
			}else{
				if($customerRecord->save()){
					$customerData = M('MyCustomerData');
					$data['last_time'] = time();
					$data['last_time'] = strtotime(trim(I('last_time')));
					$data['appoint_time'] = strtotime(trim(I('appoint_time')));
					$condition['customer_number'] = I('customer_number');
					$id = $customerData->where($condition)->getField('id');
					if(!empty($data)){
						$customerData->where($condition)->save($data);
						
					}
					$this->success('联系记录编辑成功',U('customListDetail?id='.$id));
				}else{
					$this->error('编辑失败，请重新操作');
				}
			}
				
				
		}else{
			$id = I('id',0);
			$map['id'] = $id;
			$list = $this->lists('MyCustomerRecord',$map);
			$where['customer_number'] = $list[0]['customer_number'];
			$customer = $this->lists('MyCustomerData',$where);
			$type = $customer[0]['customer_type'];
			$this->meta_title = '编辑联系记录';
			$this->assign('id',$id);
			$this->assign('type',$type);
// 			dump($list);
			$this->assign('_list',$list);
			$this->display();
		}
	}
	
	/*联系记录删除*/
	public function feedbackListDelete($id=0){
		$id = $this->filterId($id);
		$map['id'] = array('in',$id);
		$this->delete('MyCustomerRecord',$map);
	}
	
	/*联系记录导出*/
	public function feedbackListOutexcel(){
// 		dump(I('get.'));
		$searchArr = I('get.');
		if(array_key_exists('search_content', $searchArr)){
			$map['customer_name'] = array('like','%'.$searchArr['search_content'].'%');
			$map['txttel'] = array('like','%'.$searchArr['search_content'].'%');
			$map['contact_name'] = array('like','%'.$searchArr['search_content'].'%');
			$map['contact_content'] = array('like','%'.$searchArr['search_content'].'%');
			$map['_logic'] = 'OR';
			unset($searchArr['search_content']);
		}
		
		if(array_key_exists('time_start', $searchArr)){
			$where['last_time'] = array('between',strtotime(trim($searchArr['time_start'])).",".strtotime(trim($searchArr['time_end'])));
			unset($searchArr['time_start'],$searchArr['time_end']);
		}
		foreach ($searchArr as $key => $value){
			$where[$key] = $value;
		}
		if(isset($map)){
			$where['_complex'] = $map;
		}
		$where['_logic'] = 'AND';
// 		dump($where);
		$feedbackListData = $this->lists('MyCustomerRecord',$where,'id');
		/* dump($feedbackListData);
		die(); */
		if(empty($feedbackListData)){
			$this->error('没有可导出的数据');
		}
		
		date_default_timezone_set('Europe/London');
		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
			/** Include PHPExcel */
			vendor('PHPExcel.PHPExcel');
			// Create new PHPExcel object
			$objPHPExcel = new \PHPExcel();
				
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '记录序列')
			->setCellValue('B1', '客户编码')
			->setCellValue('C1', '客户名称')
			->setCellValue('D1', '联系人')
			->setCellValue('E1', '联系方法')
			->setCellValue('F1', '联系方式')
			->setCellValue('G1', '联系内容')
			->setCellValue('H1', '联系时间')
			->setCellValue('I1', '联系类型')
			->setCellValue('J1', '预约时间')
			->setCellValue('K1', '下次目标')
			->setCellValue('L1', '联系客服');
			// add mysql data, UTF-8
			//var_dump($_POST);die();
			$i = 2;
			foreach($feedbackListData as $v) {
				date_default_timezone_set("Asia/Shanghai");
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $v["id"])
				->setCellValue('B'.$i, $v["customer_number"])
				->setCellValue('C'.$i, $v["customer_name"])
				->setCellValue('D'.$i, $v["contact_name"])
				->setCellValue('E'.$i, $v["contact_way"])
				->setCellValue('F'.$i, $v["txttel"])
				->setCellValue('G'.$i, $v["contact_content"])
				->setCellValue('H'.$i, date('Y-m-d H:i:s',$v["last_time"]))
				->setCellValue('I'.$i, $v["contact_type"])
				->setCellValue('J'.$i, date('Y-m-d H:i:s',$v["appoint_time"]))
				->setCellValue('K'.$i, $v["next_content"])
				->setCellValue('L'.$i, $v["customer_service"]);
				$i++;
			}
		
			//设置单元格宽度   例：
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(50);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('联系记录列表');
			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel5)
			$fileName = get_username().date('_YmdHis').'_record';
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename='.$fileName.'.xls');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');
			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0
			$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;
	}
	
	/*在客户信息详细显示导航模块*/
	public function nav($customer_number=null){
		empty($customer_number) && $this->error('客户编码错误');
// 		dump($customer_number);
		$this->assign('customer_number',$customer_number);
		$this->display();
	}
	
	/*合作文档*/
	public function myCustomDocument(){
		$customer_number = I('customer_number');
		$map['customer_number'] = $customer_number;
		$list = $this->lists('MyContractDocument',$map);
		foreach ($list as &$value){
			$value['document_path'] = analysisPath($value['document_path']);
		}
// 		dump($list);
		$this->assign('customer_number',$customer_number);
		$this->assign('_list',$list);
		$this->display();
	}
	

	/*添加文档*/
	public function myCustomDocumentAdd(){
		if(IS_POST){
// 			dump(I('post.'));
		$map['customer_number'] = I('customer_number');
		$customer = $this->lists('MyCustomerData',$map);
		$id = $customer[0]['id'];
		$customDocumentContract = D('MyContractDocument');
			if(!$customDocumentContract->create()){
				$this->error($customDocumentContract->getError());
			}else{
				if($customDocumentContract->add()){
					$this->success('合同添加成功',U('customListDetail?id='.$id));
				}else{
					$this->error('合同添加失败');
				}
			}						
			
		}else{
			$customer_number = I('customer_number');
			$map['customer_number'] = $customer_number;
// 			dump($map);
			$customer = $this->lists('MyCustomerData',$map);
// 			dump($customer);
			$customer_name = $customer[0]['customer_name'];
// 			dump($customer_name);
			$this->assign('customer_number',$customer_number);
			$this->assign('customer_name',$customer_name);
			$this->display();
		}
		
	}
	
	/*删除文档*/
	public function myCustomDocumentDelete($id=0){
		$id = $this->filterId($id);
		$map['id'] = array('in',$id);
		$this->delete('MyContractDocument',$map);
	}
	
	/*编辑文档*/
	public function myCustomDocumentEdit(){
		
	}
	
	/*文档上传*/
	public function myCustomDocumentUpload(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$savepath='./Attachment/';
		$upload->saveName = array('myFilename','__FILE__');
		if (!file_exists($savepath)){
			mkdir($savepath);
		}
		$upload->savePath =  $savepath;// 设置附件上传目录
		$info = $upload->upload();
		if(!$info) {// 上传错误提示错误信息		
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			//$info =  $upload->upload();
			foreach ($info as &$file){
				$spath = $file['savepath'].'/'.$file['savename'];
			}
		}
		print_r(J(__ROOT__.'/Uploads/'. $spath));
	}

	/*页面上删除展示文档*/
	public function myCustomDocumentUploadDelete(){
		$src=str_replace(__ROOT__.'/', '', str_replace('//', '/', $_GET['src']));
		if (file_exists($src)){
			unlink($src);
		}
		print_r($_GET['src']);
		exit();
	}
	
	/*联系人*/
	public function myCustomContactPerson(){
		$this->display();
	}
	
	
	
	/*某个客户的联系记录*/
	public function feedbackListOne($customer_number=null){
		empty($customer_number) && $this->error('客户编码错误');
// 		dump($customer_number);
		$map['customer_number'] = $customer_number;
// 		dump($map);
		
		$feed = $this->lists('MyCustomerRecord',$map);
		$this->assign('customer_number',$customer_number);
// 		dump($feed);
		$this->assign('_feed',$feed);
		$this->display();
		
	}
	
	/* 等待回访客户列表 */
	public function waitLinkList(){
		$map['customer_service'] = get_username();
// 		dump($user);
		$list_record = array();
		$list = $this->lists('MyCustomerData',$map);
		foreach ($list as $key => $value){
// 			echo date('Y-m-d H:i:s',$value['appoint_time']).'  ';
			$appoint_time = $value['appoint_time'] + 0;
			if($appoint_time - time() > 7*24*3600 || $appoint_time == 0){
				unset($list[$key]);
			}
		}
		foreach ($list as $key => $value){
// 			dump($value);
			$arr[$key]['customer_name'] = $value['customer_name'];
			$arr[$key]['appoint_time'] = $value['appoint_time'];
		}
// 		dump($arr);
		foreach ($arr as $value){
			$listre = $this->lists('MyCustomerRecord',$value);
			array_unshift($list_record, $listre[0]);
		}
// 		dump($list_record);
		$this->assign('_list',$list_record);
		$this->display(); 
		
	}
	
	/*客户资料EXCEL导入*/
	public function customListImport(){
		if(IS_POST){
			if (!empty($_FILES)) {
				$config=array(
						'allowExts'=>array('xlsx','xls'),
						'savePath'=>'Public/upload/',
						'saveRule'=>'time',
				);
				
				$upload = new Upload($config);
				$info = $upload->upload();
				if (!$info) {
					$this->error($upload->getError());
				} else {
					//$this->success('上传成功！');
				
				
				Vendor("PHPExcel.PHPExcel");
				Vendor("PHPExcel.PHPExcel.IOFactory");
				$file_name=$upload->rootPath . $info['import']['savepath'].$info['import']['savename'];
				$path = $upload->rootPath .$info['import']['savepath'];
				$objReader = \PHPExcel_IOFactory::createReader('Excel5');
				$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow(); // 取得总行数
				$highestColumn = $sheet->getHighestColumn(); // 取得总列数
					for($i=2;$i<=$highestRow;$i++)
						{
							$data['customer_name']    = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
							$data['contact_name'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
							$data['gender'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
							$data['tel'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
							$data['phone'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
							$data['email'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
							$data['QQ'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
							$data['province'] = $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
							$data['city'] = $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
							$data['country'] = $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();
							$data['detail_address'] = $objPHPExcel->getActiveSheet()->getCell("K".$i)->getValue();
							$data['customer_source'] = $objPHPExcel->getActiveSheet()->getCell("L".$i)->getValue();
							$data['customer_type'] = $objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue();
							$data['contract_start'] = \PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("N".$i)->getValue());
							$data['contract_end'] = \PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("O".$i)->getValue());
							$data['notes'] = $objPHPExcel->getActiveSheet()->getCell("P".$i)->getValue();
							$data['customer_number'] = 'LS' . date('ymdHis',time()) . mt_rand(10,99);
							$data['create_time'] = time();
							$data['create_people'] = get_username();
							$data['customer_service'] = get_username();
// 							dump($data);die();
							$customerData = D('MyCustomerData');
							$customerData->create();
							$customerData->add($data);
// 							echo $customerData->getLastSql();	
							/* }else{
								exit($customerData->getError());
							}
							 */
						}
						$this->success('导入成功！');
				}
			}else{
				$this->error("请选择上传的文件",U('Custom/customListImport'));
			}
		}
		$this->display();
	}
	
	/* 共享客户列表 */
	public function shareCustomList(){
		$map['share_to'] = get_username();
		$list = $this->lists('MyCustomerShare',$map,'sid');
		$customer_type = $this->lists('MyCustomerType','','id');
		$this->assign('type',$customer_type);
		$this->assign('_list',$list);
		$this->display();
		
	}
	
	/*我的共享页面*/
	public function shareCustomListSelf(){
		$map['share_name'] = get_username();
		$list = $this->lists('MyCustomerShare',$map,'sid');
		$customer_type = $this->lists('MyCustomerType','','id');
		$this->assign('type',$customer_type);
		$this->assign('_list',$list);
		$this->display();
	}
	
	/*共享给我的搜索*/
	public function shareCustomListSearchTo(){
		$this->shareCustomListSearch('share_to', 'shareCustomList');
	}
	
	/*我的共享搜索*/
	public function shareCustomListSearchMe(){
		$this->shareCustomListSearch('share_name','shareCustomList');
	}
	
	/*共享客户列表搜索操作*/
	public function shareCustomListSearch($user,$url){
		$searchArr = I('get.');
		$arr = $searchArr;
		// 		dump($searchArr);
		if(empty($searchArr)){
			$this->redirect('sharecustomlist');
		}else{
			if(array_key_exists('search_content', $searchArr)){
				$map['customer_name'] = array('like','%'.$searchArr['search_content'].'%');
				$map['tel'] = array('like','%'.$searchArr['search_content'].'%');
				$map['contact_name'] = array('like','%'.$searchArr['search_content'].'%');
				$map['customer_service'] = array('like','%'.$searchArr['search_content'].'%');
				$map['_logic'] = 'OR';
				unset($searchArr['search_content']);
			}
			foreach ($searchArr as $key => $value){
				$where[$key] = $value;
			}
			if(isset($map)){
				$where['_complex'] = $map;
			}
			$where[$user] = get_username();
			$where['_logic'] = 'AND';
		}
// 		dump($where);
		$mycustomerShare = M('MyCustomerShare');
		$list = $this->lists('MyCustomerShare',$where,'sid');
		$this->assign('_list',$list);
// 		echo $mycustomerShare->getLastSql();
		$this->assign('sarr',$searchArr);
		$this->display($url);	
	}

	/*取消共享客户*/
	public function shareCustomListCancel($sid=0){
		// dump(I('get.'));
		$id = $this->filterId($sid);
		$map['sid'] = array('in',$id);
		$this->delete('MyCustomerShare',$map,$msg = array( 'success'=>'取消成功！', 'error'=>'取消失败！'));
	}
	
	/* 共享客户操作*/
	public function shareCustomListAction($id=0){
		$id = $this->filterId($id);
		if(IS_POST){
// 			print_r(I('post.'));die();
			$share_arr = I('uid');
			$map['id'] = array('in',$id);
			$customer = $this->lists('MyCustomerData',$map);
			foreach ($share_arr as $svalue){
				$shareData = M('MyCustomerShare');
				foreach ($customer as $cvalue){
					$data = $cvalue;
					$data['share_to'] = $svalue;
					$data['share_time'] = time();
					$data['share_name'] = get_username();
// 					print_r($data);
					if(!$shareData->add($data)){
						$result = false;
					}
				}
				
			}
			if(isset($result)){
				$this->error('共享失败，请重新操作~');
			}else{
				$this->success('共享成功！',U('Custom/myCustomList'));
			}
			
		}else{
			$userArr = array();
			$map['id'] = array('in',$id);
			$list = $this->lists('MyCustomerData',$map);
			$department = $this->lists('MyDepartment','','id');
			$user = $this->lists('Member','','uid');
			// 			dump($user);
			foreach ($department as $dValue){
				foreach ($user as $uValue){
					if($dValue['id'] == $uValue['department_id']){
						$userArr[$dValue['department']][$uValue['uid']] = $uValue['realname'];
					}
				}
			}
			$this->assign('_list',$list);
			$this->assign('_depart',$department);
// 			dump($userArr);
			$this->assign('_user',$userArr);
			$this->assign('_id',$id);
			$this->display();
		}
		
		
	}
	
	/* 公共客户管理 */
	public function customPoolManage(){
		//将联系时间超过30天或者建档后还未联系且建档时间超过30天的客户都设置为公共客户
		/*$list = $this->lists('MyCustomerData');
		 $no = array();
		foreach ($list as $key => $value){
			$subtime = time() - $value['last_time'];
			$subcreate =  time() - $value['create_time'];
			$day = time();
			if((30*24*3600 < $subtime && $subtime <$day )||($value['last_time'] == 0 && $subcreate > 30*24*3600)){
				$no[] = $value['id'];
				dump($value['last_time'] == 0);
				dump($subtime > 30*24*3600);
				dump($subcreate > 30*24*3600);
				echo '<br>';
			}
		}
		dump($no); 
		$where['id'] = array('in',implode(',',$no));
		dump($where);*/
		$customerData = M('MyCustomerData');
		$customerPoolSet = M('MyCustomerPool');
		$isOpen = $customerPoolSet->getField('is_open');
		if($isOpen == '1'){
			$period = $customerPoolSet->getField('recycle_period');
			$days = (int)$period;
			// 		dump($period);die();
			$sql = "select id,(". time() ."-last_time) as subtime,(". time() ."-create_time) as subcreate,last_time as ltime from " .C('DB_PREFIX'). "my_customer_data group by id having (subtime>3600*24*".$days." and subtime<".time().") or (subcreate>3600*24*".$days." and ltime=0)";
// 					echo $sql;
			$item = $customerData->query($sql);
			// 		dump($item);
			foreach ($item as $vo){
				$arr[] = $vo['id'];
			}
			$where['id'] = array('in',implode(',', $arr));
			// 		dump($where);
			
			$customerData->where($where)->setField('customer_service','公共客户');;
		}
		$map['customer_service'] = '公共客户';
		$list = $this->lists('MyCustomerData',$map,'id');
		$type= $this->lists('MyCustomerType');
		$source = $this->lists('MyCustomerSource');
		$this->assign('type',$type);
		$this->assign('source',$source);
// 		dump($list);
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
		$data['last_time'] = time();
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