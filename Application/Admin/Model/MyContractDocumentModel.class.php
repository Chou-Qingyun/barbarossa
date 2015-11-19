<?php
namespace Admin\Model;
use Think\Model;
/*
 * 合同文档资料
 * */
class MyContractDocumentModel extends Model{
	
	protected $_validate = array(
			array('document_name','require','文档名称不能为空'),
			array('document_path','require','相关附件不能为空'),
	);
	
	protected $_auto = array(
			array('add_person','addPerson',3,'callback'),
			array('add_time','addTime',1,'callback'),
	);
	
	public function addPerson(){
		return get_username();
	}
	
	public function addTime(){
		return time();
	}
}