<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TrlMaster extends CI_Controller {

	/** 
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('CommonModel');
		$this->load->model('TraineeModel');
		$this->load->library("pagination");
		$this->load->library("response");
		$this->load->library("ValidateData");
	}

	public function trlLevelMasterList()
	{	

		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$textSearch = trim($this->input->post('textSearch'));
		$isAll = $this->input->post('getAll');
		$curPage = $this->input->post('curpage');
		$textval = $this->input->post('textval');
		$orderBy = $this->input->post('orderBy');
		$order = $this->input->post('order');

		$statuscode = $this->input->post('status');
		
		// echo $statuscode;exit();
		$config = array();
		if(!isset($orderBy) || empty($orderBy)){
			$orderBy = "id";
			$order ="ASC";
		}
		$other = array("orderBy"=>$orderBy,"order"=>$order);
		
		$config = $this->config->item('pagination');
		$wherec = $join = array();
		if(isset($textSearch) && !empty($textSearch) && isset($textval) && !empty($textval)){
		$wherec["$textSearch like  "] = "'".$textval."%'";
		}

		if(isset($statuscode) && !empty($statuscode)){
		$statusStr = str_replace(",",'","',$statuscode);
		$wherec["status"] = 'IN ("'.$statusStr.'")';
		}
		// print_r($wherec);exit();
		$config["base_url"] = base_url() . "pagesDetails";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('id',"master_trl",$wherec);
	    $config["uri_segment"] = 2;
	    $this->pagination->initialize($config);
	    if(isset($curPage) && !empty($curPage)){
		$curPage = $curPage;
		$page = $curPage * $config["per_page"];
		}
		else{
		$curPage = 0;
		$page = 0;
		}
		if($isAll=="Y"){
			$pagesDetails = $this->CommonModel->GetMasterListDetails($select="",'master_trl',$wherec,'','',$join,$other);	
		}else{
			$pagesDetails = $this->CommonModel->GetMasterListDetails($selectC="",'master_trl',$wherec,$config["per_page"],$page,$join,$other);	
		}
		
		$status['data'] = $pagesDetails;
		$status['paginginfo']["curPage"] = $curPage;
		if($curPage <=1)
		$status['paginginfo']["prevPage"] = 0;
		else
		$status['paginginfo']["prevPage"] = $curPage - 1 ;

		$status['paginginfo']["pageLimit"] = $config["per_page"] ;
		$status['paginginfo']["nextpage"] =  $curPage+1 ;
		$status['paginginfo']["totalRecords"] =  $config["total_rows"];
		$status['paginginfo']["start"] =  $page;
		$status['paginginfo']["end"] =  $page+ $config["per_page"] ;
		$status['loadstate'] = true;
		if($config["total_rows"] <= $status['paginginfo']["end"])
		{
			$status['msg'] = $this->systemmsg->getErrorCode(232);
			$status['statusCode'] = 400;
			$status['flag'] = 'S';
			$status['loadstate'] = false;
			$this->response->output($status,200);
		}
		if($pagesDetails){
			$status['msg'] = "sucess";
			$status['statusCode'] = 400;
			$status['flag'] = 'S';
			$this->response->output($status,200);
		}else{
			$status['msg'] = $this->systemmsg->getErrorCode(227);
			$status['statusCode'] = 227;
			$status['flag'] = 'F';
			$this->response->output($status,200);
		}				
	}
	public function trlLevelMaster($id='')
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		$master_trl_details = array();
		$updateDate = date("Y/m/d H:i:s");
		if($method=="PUT"||$method=="POST")
		{
			$master_trl_details['trl_name'] = $this->validatedata->validate('trl_name','TRL Name',true,'',array());
			$master_trl_details['trl_description'] = $this->validatedata->validate('trl_description','TRL Description',true,'',array()); 
			$master_trl_details['is_del'] = $this->validatedata->validate('is_del','is_del',false,'',array());
			if($method=="PUT")
			{
				$iscreated = $this->CommonModel->saveMasterDetails('master_trl',$master_trl_details);
				if(!$iscreated){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}else{
					$status['msg'] = $this->systemmsg->getSucessCode(400);
					$status['statusCode'] = 400;
					$status['data'] =array();
					$status['flag'] = 'S';
					$this->response->output($status,200);
				}
				
			}
			if($method=="POST")
			{
				$where=array('id'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				$iscreated = $this->CommonModel->updateMasterDetails('master_trl',$master_trl_details,$where);
				if(!$iscreated){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);

				}else{
					$status['msg'] = $this->systemmsg->getSucessCode(400);
					$status['statusCode'] = 400;
					$status['data'] =array();
					$status['flag'] = 'S';
					$this->response->output($status,200);
				}
			}
		}else if($method=="DELETE")
		{	
			$master_trl_details = array();
			$where=array('id'=>$id);
			if(!isset($id) || empty($id)){
				$status['msg'] = $this->systemmsg->getErrorCode(996);
				$status['statusCode'] = 996;
				$status['data'] = array();
				$status['flag'] = 'F';
				$this->response->output($status,200);
			}
			$iscreated = $this->CommonModel->deleteMasterDetails('master_trl',$where);
			if(!$iscreated){
				$status['msg'] = $this->systemmsg->getErrorCode(996);
				$status['statusCode'] = 996;
				$status['data'] = array();
				$status['flag'] = 'F';
				$this->response->output($status,200);
			}else{
				$status['msg'] = $this->systemmsg->getSucessCode(400);
				$status['statusCode'] = 400;
				$status['data'] =array();
				$status['flag'] = 'S';
				$this->response->output($status,200);
			}
		}	
		else
		{
			$where = array("id"=>$id);
			$userRoleHistory = $this->CommonModel->getMasterDetails('master_trl','',$where);
			if(isset($userRoleHistory) && !empty($userRoleHistory)){
			$status['data'] = $userRoleHistory;
			$status['statusCode'] = 200;
			$status['flag'] = 'S';
			$this->response->output($status,200);
			}else{
			$status['msg'] = $this->systemmsg->getErrorCode(227);
			$status['statusCode'] = 227;
			$status['data'] =array();
			$status['flag'] = 'F';
			$this->response->output($status,200);
			}
		}
	}
	public function trlLevelMasterChangeStatus()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest(); 
		$action = $this->input->post("action");
			if(trim($action) == "changeStatus"){
				$ids = $this->input->post("list");
				$statusCode = $this->input->post("status");	
				$changestatus = $this->CommonModel->changeMasterStatus('master_trl',$statusCode,$ids,'id');
				
			if($changestatus){

				$status['data'] = array();
				$status['statusCode'] = 200;
				$status['flag'] = 'S';
				$this->response->output($status,200);
			}else{
				$status['data'] = array();
				$status['msg'] = $this->systemmsg->getErrorCode(996);
				$status['statusCode'] = 996;
				$status['flag'] = 'F';
				$this->response->output($status,200);
			}
		}
	}

	public function addTrlQuestions($id="")
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		$trlQuestion = array();
		
		if($method=="PUT"||$method=="POST")
		{
			$trlQuestion['trlLevelID'] = $this->validatedata->validate('trlLevelID','TRL Name',true,'',array());
			$trlQuestion['qName'] = $this->validatedata->validate('qName','TRL Questions ',true,'',array());
			$trlQuestion['qGuide'] = $this->validatedata->validate('qGuide','Question Guide',false,'',array());
			$trlQuestion['isRequired'] = $this->validatedata->validate('isRequired','isRequired',false,'',array());
			$trlQuestion['ansType'] = $this->validatedata->validate('ansType','Answer Type',false,'',array()); 
			$trlQuestion['ansGuide'] = $this->validatedata->validate('ansGuide','Answer Guide',false,'',array());
			if($trlQuestion['ansType'] == "file"){

				$trlQuestion['fileSize'] = $this->validatedata->validate('fileSize','File Size',true,'',array());
				$trlQuestion['minLength'] = $this->validatedata->validate('minLength','Minimum Length',true,'',array());
				$trlQuestion['maxLength'] = $this->validatedata->validate('maxLength','Maximum Length',true,'',array());
				$trlQuestion['uploadType'] = $this->validatedata->validate('uploadType','Upload File Type',true,'',array());
			}
			$trlQuestion['status'] = 'active';
			$trlQuestion['qoptions'] = json_encode($this->input->post("qoptions"));	;
			if($method=="POST")
			{
				$iscreated = $this->CommonModel->saveMasterDetails('trl_questions',$trlQuestion);
				if(!$iscreated){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}else{
					$status['msg'] = $this->systemmsg->getSucessCode(400);
					$status['statusCode'] = 400;
					$status['data'] =array();
					$status['flag'] = 'S';
					$this->response->output($status,200);
				}
				
			}
			if($method=="PUT")
			{
				$where=array('trlQuestionID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				$iscreated = $this->CommonModel->updateMasterDetails('trl_questions',$trlQuestion,$where);
				if(!$iscreated){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);

				}else{
					$status['msg'] = $this->systemmsg->getSucessCode(400);
					$status['statusCode'] = 400;
					$status['data'] =array();
					$status['flag'] = 'S';
					$this->response->output($status,200);
				}
			}
			}else if($method=="DELETE")
			{	
				$master_trl_details = array();
				$where=array('trlQuestionID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				$iscreated = $this->CommonModel->deleteMasterDetails('trl_questions',$where);
				if(!$iscreated){
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}else{
					$status['msg'] = $this->systemmsg->getSucessCode(400);
					$status['statusCode'] = 400;
					$status['data'] =array();
					$status['flag'] = 'S';
					$this->response->output($status,200);
				}
			}	
			else
			{
				$where = array("trlQuestionID"=>$id,"status"=>"active");
				$questionList = $this->CommonModel->getMasterDetails('trl_questions','',$where);
				
				if(isset($questionList) && !empty($questionList)){
				$status['data'] = $questionList;
				$status['statusCode'] = 200;
				$status['flag'] = 'S';
				$this->response->output($status,200);
				}else{
				$status['msg'] = $this->systemmsg->getErrorCode(227);
				$status['statusCode'] = 227;
				$status['data'] =array();
				$status['flag'] = 'F';
				$this->response->output($status,200);
			}
		}
	}
	public function deleteTRLQuestion(){

		$del = $this->validatedata->validate('del','TRL Question ID',false,'',array());
		$master_trl_details = array();
		$where=array('trlQuestionID'=>$del);
		if(!isset($del) || empty($del)){
			$status['msg'] = $this->systemmsg->getErrorCode(996);
			$status['statusCode'] = 996;
			$status['data'] = array();
			$status['flag'] = 'F';
			$this->response->output($status,200);
		}
		$trlQuestion = array("status"=>"delete");
		$iscreated = $this->CommonModel->updateMasterDetails('trl_questions',$trlQuestion,$where);
		if(!$iscreated){
			$status['msg'] = $this->systemmsg->getErrorCode(996);
			$status['statusCode'] = 996;
			$status['data'] = array();
			$status['flag'] = 'F';
			$this->response->output($status,200);
		}else{
			$status['msg'] = $this->systemmsg->getSucessCode(400);
			$status['statusCode'] = 400;
			$status['data'] =array();
			$status['flag'] = 'S';
			$this->response->output($status,200);
		}

	}
	public function trlQuestionsList()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$trlID = $this->input->post('trlID');		
		$where = array("trlLevelID"=>$trlID,"status"=>"active");
		$select="ansType,qGuide,qName,qoptions,status,trlLevelID,trlQuestionID";
		$trl_questions = $this->CommonModel->getMasterDetails('trl_questions',$select,$where);
		if(isset($trl_questions) && !empty($trl_questions)){
		$status['data'] = $trl_questions;
		$status['statusCode'] = 200;
		$status['flag'] = 'S';
		$this->response->output($status,200);
		}else{
		$status['msg'] = $this->systemmsg->getErrorCode(227);
		$status['statusCode'] = 227;
		$status['data'] =array();
		$status['flag'] = 'F';
		$this->response->output($status,200);
		}
	}
}