	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masters extends CI_Controller {

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
	public function getBranchDetails()
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
		

		$config = array();
		if(!isset($orderBy) || empty($orderBy)){
			$orderBy = "branchName";
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

		$config["base_url"] = base_url() . "branchDetails";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('branchID','branchMaster',$wherec);
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
		$isAll = $this->input->post('getAll');
		if($isAll=="Y"){
			$branchDetails = $this->CommonModel->GetMasterListDetails($selectC='','branchMaster',$wherec,'','',$join,$other);	
		}else{
			$branchDetails = $this->CommonModel->GetMasterListDetails($selectC='','branchMaster',$wherec,$config["per_page"],$page,$join,$other);	
		}
		
		$status['data'] = $branchDetails;
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
		if($branchDetails){
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

	public function branchMaster($id='')
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		
		switch ($method) {
			case "PUT":
			{
				$branchDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$branchDetails['branchName'] = $this->validatedata->validate('branchName','Branch Name',true,'',array());
				$branchDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$branchDetails['createdBy'] = $this->input->post('SadminID');
				$branchDetails['createdDate'] = $updateDate;
				$branchDetails['modifiedDate'] = '0';	

				$iscreated = $this->CommonModel->saveMasterDetails('branchMaster',$branchDetails);

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
				break;
			}

			case "POST":
			{
				$branchDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$where=array('branchID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				$branchDetails['branchName'] = $this->validatedata->validate('branchName','Branch Name',true,'',array());
				$branchDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$branchDetails['modifiedBy'] = $this->input->post('SadminID');
				$branchDetails['modifiedDate'] = $updateDate;

				$iscreated = $this->CommonModel->updateMasterDetails('branchMaster',$branchDetails,$where);
				print_r($iscreated);exit;
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
				break;
			}
			case "DELETE":
			{	
				$branchDetails = array();

				$where=array('branchID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}

				$iscreated = $this->CommonModel->deleteMasterDetails('branchMaster',$where);
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
				break;
			}	
			default:
			{
				$where = array("branchID"=>$id);
				$branchHistory = $this->CommonModel->getMasterDetails('branchMaster','',$where);
				if(isset($branchHistory) && !empty($branchHistory)){

				$status['data'] = $branchHistory;
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
				break;
			}
		}
		
	}
	public function branchChangeStatus()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest(); 
		$action = $this->input->post("action");
			if(trim($action) == "changeStatus"){
				$ids = $this->input->post("list");
				$statusCode = $this->input->post("status");	
				$changestatus = $this->CommonModel->changeMasterStatus('branchMaster',$statusCode,$ids,'branchID');
				
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

	public function getStateDetails()
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
		
		$config = array();
		if(!isset($orderBy) || empty($orderBy)){
			$orderBy = "stateName";
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


		$config["base_url"] = base_url() . "stateDetails";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('stateID','stateMaster',$wherec);
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
			$stateDetails = $this->CommonModel->GetMasterListDetails($selectC='','stateMaster',$wherec,'','',$join,$other);	
		}else{
			$stateDetails = $this->CommonModel->GetMasterListDetails($selectC='','stateMaster',$wherec,$config["per_page"],$page,$join,$other);	
		}

		$status['data'] = $stateDetails;
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
		if($stateDetails){
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
	public function stateMaster($id='')
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		
		switch ($method) {
			case "PUT":
			{
				$stateDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$stateDetails['stateName'] = $this->validatedata->validate('stateName','State Name',true,'',array());
				$stateDetails['stateCode'] = $this->validatedata->validate('stateCode','State Code',true,'',array());
				$stateDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$stateDetails['createdBy'] = $this->input->post('SadminID');
				$stateDetails['createdDate'] = $updateDate;
				$stateDetails['modifiedDate'] = '0';
				
				$iscreated = $this->CommonModel->saveMasterDetails('stateMaster',$stateDetails);
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
				break;
			}
				
			case "POST":
			{
				$stateDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$where=array('stateID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				$stateDetails['stateName'] = $this->validatedata->validate('stateName','State Name',true,'',array());
				$stateDetails['stateCode'] = $this->validatedata->validate('stateCode','State Code',true,'',array());
				$stateDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$stateDetails['modifiedBy'] = $this->input->post('SadminID');
				$stateDetails['modifiedDate'] = $updateDate;
				
				$iscreated = $this->CommonModel->updateMasterDetails('stateMaster',$stateDetails,$where);
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
				break;
			}
			case "DELETE":
			{	
				$stateDetails = array();

				$where=array('stateID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}

				$iscreated = $this->CommonModel->deleteMasterDetails('stateMaster',$where);
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
				break;
			}	
			default:
			{
				$where = array("stateID"=>$id);
				$stateHistory = $this->CommonModel->getMasterDetails('stateMaster','',$where);
				if(isset($stateHistory) && !empty($stateHistory)){

				$status['data'] = $stateHistory;
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
				break;
			}
				
		}
		
	}
	public function stateChangeStatus()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest(); 
		$action = $this->input->post("action");
			if(trim($action) == "changeStatus"){
				$ids = $this->input->post("list");
				$statusCode = $this->input->post("status");	
				$changestatus = $this->CommonModel->changeMasterStatus('stateMaster',$statusCode,$ids,'stateID');
				
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
	public function getCasteCategoryDetails()
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
		
		$config = array();
		if(!isset($orderBy) || empty($orderBy)){
			$orderBy = "casteName";
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


		$config["base_url"] = base_url() . "casteCategoryDetails";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('casteCategoryID','casteCategoryMaster',$wherec);
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
			$casteDetails = $this->CommonModel->GetMasterListDetails($selectC='','casteCategoryMaster',$wherec,'','',$join,$other);	
		}else{
			$casteDetails = $this->CommonModel->GetMasterListDetails($selectC='','casteCategoryMaster',$wherec,$config["per_page"],$page,$join,$other);	
		}
		
		$status['data'] = $casteDetails;
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
		if($casteDetails){
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
	public function casteCategoryMaster($id='')
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		
		switch ($method) {
			case "PUT":
			{
				$casteDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$casteDetails['casteName'] = $this->validatedata->validate('casteName','Caste Name',true,'',array());
				$casteDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$casteDetails['createdBy'] = $this->input->post('SadminID');
				$casteDetails['createdDate'] = $updateDate;
				$casteDetails['modifiedDate'] = '0';
				
				$iscreated = $this->CommonModel->saveMasterDetails('casteCategoryMaster',$casteDetails);
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
				break;
			}
				
			case "POST":
			{
				$casteDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$where=array('casteCategoryID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				$casteDetails['casteName'] = $this->validatedata->validate('casteName','Caste Name',true,'',array());
				$casteDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$casteDetails['modifiedBy'] = $this->input->post('SadminID');
				$casteDetails['modifiedDate'] = $updateDate;

				$iscreated = $this->CommonModel->updateMasterDetails('casteCategoryMaster',$casteDetails,$where);
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
				break;
			}
			case "DELETE":
			{	
				$casteDetails = array();

				$where=array('casteCategoryID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}

				$iscreated = $this->CommonModel->deleteMasterDetails('casteCategoryMaster',$where);
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
				break;
			}	
			default:
			{
				$where = array("casteCategoryID"=>$id);
				$casteHistory = $this->CommonModel->getMasterDetails('casteCategoryMaster','',$where);
				if(isset($casteHistory) && !empty($casteHistory)){

				$status['data'] = $casteHistory;
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
				break;
			}
				
		}
		
	}
	public function casteCategoryChangeStatus()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest(); 
		$action = $this->input->post("action");
			if(trim($action) == "changeStatus"){
				$ids = $this->input->post("list");
				$statusCode = $this->input->post("status");	
				$changestatus = $this->CommonModel->changeMasterStatus('casteCategoryMaster',$statusCode,$ids,'casteCategoryID');
				
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
	public function getTraineeSkillDetails()
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
		
		$config = array();
		if(!isset($orderBy) || empty($orderBy)){
			$orderBy = "skillDesc";
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

		$config["base_url"] = base_url() . "traineeSkillDetails";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('traineeSkillID','traineeSkillMaster',$wherec);
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
			$traineeSkillDetails = $this->CommonModel->GetMasterListDetails($selectC='','traineeSkillMaster',$wherec,'','',$join,$other);	
		}else{
			$traineeSkillDetails = $this->CommonModel->GetMasterListDetails($selectC='','traineeSkillMaster',$wherec,$config["per_page"],$page,$join,$other);	
		}
		
		$status['data'] = $traineeSkillDetails;
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
		if($traineeSkillDetails){
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
	public function traineeSkillMaster($id='')
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		
		switch ($method) {
			case "PUT":
			{
				$traineeSkillDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$traineeSkillDetails['skillDesc'] = $this->validatedata->validate('skillDesc','Skill Description',true,'',array());
				$traineeSkillDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$traineeSkillDetails['createdBy'] = $this->input->post('SadminID');
				$traineeSkillDetails['createdDate'] = $updateDate;
				$traineeSkillDetails['modifiedDate'] = '0';
				$iscreated = $this->CommonModel->saveMasterDetails('traineeSkillMaster',$traineeSkillDetails);
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
				break;
			}
				
			case "POST":
			{
				$traineeSkillDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$where=array('traineeSkillID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				$traineeSkillDetails['skillDesc'] = $this->validatedata->validate('skillDesc','Skill Description',true,'',array());
				$traineeSkillDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$traineeSkillDetails['modifiedBy'] = $this->input->post('SadminID');
				$traineeSkillDetails['modifiedDate'] = $updateDate;
				
				$iscreated = $this->CommonModel->updateMasterDetails('traineeSkillMaster',$traineeSkillDetails,$where);
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
				break;
			}
			case "DELETE":
			{	
				$traineeSkillDetails = array();

				$where=array('traineeSkillID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}

				$iscreated = $this->CommonModel->deleteMasterDetails('traineeSkillMaster',$where);
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
				break;
			}	
			default:
			{
				$where = array("traineeSkillID"=>$id);
				$traineeSkillHistory = $this->CommonModel->getMasterDetails('traineeSkillMaster','',$where);
				if(isset($traineeSkillHistory) && !empty($traineeSkillHistory)){

				$status['data'] = $traineeSkillHistory;
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
				break;
			}
				
		}
		
	}
	public function traineeSkillChangeStatus()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest(); 
		$action = $this->input->post("action");
			if(trim($action) == "changeStatus"){
				$ids = $this->input->post("list");
				$statusCode = $this->input->post("status");	
				$changestatus = $this->CommonModel->changeMasterStatus('traineeSkillMaster',$statusCode,$ids,'traineeSkillID');
				
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
	public function getBusinessSectorDetails()
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
		
		$config = array();
		if(!isset($orderBy) || empty($orderBy)){
			$orderBy = "businessDesc";
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


		$config["base_url"] = base_url() . "businessSectorDetails";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('businessSectorID','businessSectorMaster',$wherec);
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
			$businessDetails = $this->CommonModel->GetMasterListDetails($selectC='','businessSectorMaster',$wherec,'','',$join,$other);	
		}else{
			$businessDetails = $this->CommonModel->GetMasterListDetails($selectC='','businessSectorMaster',$wherec,$config["per_page"],$page,$join,$other);	
		}
		
		$status['data'] = $businessDetails;
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
		if($businessDetails){
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


	public function businessSectorMaster($id='')
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		
		switch ($method) {
			case "PUT":
			{
				$businessDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$businessDetails['businessDesc'] = $this->validatedata->validate('businessDesc','Business Description',true,'',array());
				$businessDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$businessDetails['createdBy'] = $this->input->post('SadminID');
				$businessDetails['createdDate'] = $updateDate;
				$businessDetails['modifiedDate'] = '0';
				
				$iscreated = $this->CommonModel->saveMasterDetails('businessSectorMaster',$businessDetails);
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
				break;
			}
				
			case "POST":
			{
				$businessDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$where=array('businessSectorID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
		}
				$businessDetails['businessDesc'] = $this->validatedata->validate('businessDesc','Business Description',true,'',array());
				$businessDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$businessDetails['modifiedBy'] = $this->input->post('SadminID');
				$businessDetails['modifiedDate'] = $updateDate;
				
				$iscreated = $this->CommonModel->updateMasterDetails('businessSectorMaster',$businessDetails,$where);
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
				break;
			}
			case "DELETE":
			{	
				$businessDetails = array();

				$where=array('businessSectorID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}

				$iscreated = $this->CommonModel->deleteMasterDetails('businessSectorMaster',$where);
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
				break;
			}	
			default:
			{
				$where = array("businessSectorID"=>$id);
				$businessHistory = $this->CommonModel->getMasterDetails('businessSectorMaster','',$where);
				if(isset($businessHistory) && !empty($businessHistory)){

				$status['data'] = $businessHistory;
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
				break;
			}
				
		}
		
	}
	public function businessSectorChangeStatus()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest(); 
		$action = $this->input->post("action");
			if(trim($action) == "changeStatus"){
				$ids = $this->input->post("list");
				$statusCode = $this->input->post("status");	
				$changestatus = $this->CommonModel->changeMasterStatus('businessSectorMaster',$statusCode,$ids,'businessSectorID');
				
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
	public function getCompanyDetails()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$isAll = $this->input->post('getAll');
		$textSearch = trim($this->input->post('textSearch'));
		$curPage = $this->input->post('curpage');
		$companyID = $this->input->post('companyID');
		$textval = $this->input->post('textval');
		$orderBy = $this->input->post('orderBy');
		$order = $this->input->post('order');
		$statuscode = $this->input->post('status');
		$filterBName = $this->input->post('filterBName');
		$filterSName = $this->input->post('filterSName');
		
		$config = array();
		if(!isset($orderBy) || empty($orderBy)){
			$orderBy = "companyName";
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
		$wherec["t.status"] = 'IN ("'.$statusStr.'")';
		}

		if(isset($filterBName) && !empty($filterBName)){
			$wherec["t.companyBranchid"] = ' = "'.$filterBName.'"';
		}

		if(isset($filterSName) && !empty($filterSName)){
			$wherec["t.companyStateid"] = ' = "'.$filterSName.'"';
		}

		// get comapny access list
		$adminID = $this->input->post('SadminID');
		$where = array("adminID ="=>"'".$adminID."'");
		$companyAccess = $this->CommonModel->GetMasterListDetails('*','companyAccess',$where,'','',array(),array());
		if(isset($companyAccess) && !empty($companyAccess)){
				//$wherec["cm.companyID IN "] = "(".$companyAccess[0]->companyList.")";
		}else{
			$status['msg'] = $this->systemmsg->getErrorCode(263);
			$status['statusCode'] = 263;
			$status['flag'] = 'F';
			$this->response->output($status,200);
		}

		// Check is data process already
		$other['whereIn'] = "companyID";

		$other["whereData"]=$companyAccess[0]->companyList;

		$config["base_url"] = base_url() . "companyDetails";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('companyID','companyMaster',$wherec,$other);
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
			$join = array();
			$companyDetails = $this->CommonModel->GetMasterListDetails($selectC='','companyMaster',$wherec,'','',$join,$other);	
		}else{
			$join = array();
			$join[0]['type'] ="LEFT JOIN";
			$join[0]['table']="branchMaster";
			$join[0]['alias'] ="b";
			$join[0]['key1'] ="companyBranchid";
			$join[0]['key2'] ="branchID";
			//$join = array();
			$join[1]['type'] ="LEFT JOIN";
			$join[1]['table']="stateMaster";
			$join[1]['alias'] ="s";
			$join[1]['key1'] ="companyStateid";
			$join[1]['key2'] ="stateID";
			
			$selectC = "t.*,b.branchName,s.stateName";
			$companyDetails = $this->CommonModel->GetMasterListDetails($selectC,'companyMaster',$wherec,$config["per_page"],$page,$join,$other);
		}
//print_r($companyDetails);exit;
		$status['data'] = $companyDetails;
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
		if($companyDetails){
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

	public function companyMaster($id='')
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		
		switch ($method) {
			case "PUT":
			{
				$companyDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$companyDetails['companyName'] = $this->validatedata->validate('companyName','Company Name',true,'',array());

				$companyDetails['companyBillingName'] = $this->validatedata->validate('companyBillingName','Company Billing Name',true,'',array());

				$companyDetails['companyCode'] = $this->validatedata->validate('companyCode','Company Code',true,'',array());

				$companyDetails['companyAddress'] = $this->validatedata->validate('companyAddress','Company Address',true,'',array());

				$companyDetails['companyGstNo'] = $this->validatedata->validate('companyGstNo','Company GstNo',true,array(true,'15'),array(true,'15'));

				$companyDetails['companyPanNo'] = $this->validatedata->validate('companyPanNo','Company PanNo',true,array(true,'10'),array(true,'10'));

				$companyDetails['companyPhone'] = $this->validatedata->validate('companyPhone','Phone Number',false,'',array());

				$companyDetails['companyPerson'] =$this->validatedata->validate('companyPerson','Person Name',false,'',array());

				$companyDetails['companyMobile'] =$this->validatedata->validate('companyMobile','Mobile Number',false,'',array());

				$companyDetails['companyEmail'] = $this->validatedata->validate('companyEmail','Email-ID',false,'',array());

				$companyDetails['companyBranchid'] = $this->validatedata->validate('companyBranchid','Company Branch Name',true,'',array());

				$companyDetails['companyStateid'] = $this->validatedata->validate('companyStateid','Company State Name',true,'',array());

				$companyDetails['businessSectorid'] = $this->validatedata->validate('businessSectorid','Business Sector Description',false,'',array());

				$companyDetails['status'] = $this->validatedata->validate('status','status',true,'',array());

				$companyDetails['comTypeNEEM'] = $this->validatedata->validate('comTypeNEEM','Company Type',false,'',array());
				$companyDetails['comTypeNAPS'] = $this->validatedata->validate('comTypeNAPS','Company Type',false,'',array());

				$companyDetails['createdBy'] = $this->input->post('SadminID');

				$companyDetails['createdDate'] = $updateDate;
				$companyDetails['modifiedDate'] = '0';
				//print_r($companyDetails);
				$iscreated = $this->CommonModel->saveMasterDetails('companyMaster',$companyDetails);
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
				break;
			}
				
			case "POST":
			{
				$companyDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$where=array('companyID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
		}
				$companyDetails['companyName'] = $this->validatedata->validate('companyName','Company Name',true,'',array());

				$companyDetails['companyBillingName'] = $this->validatedata->validate('companyBillingName','Company Billing Name',true,'',array());

				$companyDetails['companyCode'] = $this->validatedata->validate('companyCode','Company Code',true,'',array());

				$companyDetails['companyAddress'] = $this->validatedata->validate('companyAddress','Company Address',true,'',array());

				$companyDetails['companyGstNo'] = $this->validatedata->validate('companyGstNo','Company GstNo',true,array(true,'15'),array(true,'15'));

				$companyDetails['companyPanNo'] = $this->validatedata->validate('companyPanNo','Company PanNo',true,array(true,'10'),array(true,'10'));

				$companyDetails['companyPhone'] = $this->validatedata->validate('companyPhone','Phone Number',false,'',array());

				$companyDetails['companyPerson'] =$this->validatedata->validate('companyPerson','Person Name',false,'',array());

				$companyDetails['companyMobile'] =$this->validatedata->validate('companyMobile','Mobile Number',false,'',array());

				$companyDetails['companyEmail'] = $this->validatedata->validate('companyEmail','Email-ID',false,'',array());
				
				$companyDetails['companyBranchid'] = $this->validatedata->validate('companyBranchid','Company Branch Name',true,'',array());

				$companyDetails['companyStateid'] = $this->validatedata->validate('companyStateid','Company State Name',true,'',array());
				
				$companyDetails['businessSectorid'] = $this->validatedata->validate('businessSectorid','Business Sector Description',false,'',array());

				$companyDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				
				$companyDetails['comTypeNEEM'] = $this->validatedata->validate('comTypeNEEM','Company Type',false,'',array());
				$companyDetails['comTypeNAPS'] = $this->validatedata->validate('comTypeNAPS','Company Type',false,'',array());

				$companyDetails['modifiedBy'] = $this->input->post('SadminID');
				$companyDetails['modifiedDate'] = $updateDate;
				
				$iscreated = $this->CommonModel->updateMasterDetails('companyMaster',$companyDetails,$where);
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
				break;
			}
			case "DELETE":
			{	
				$companyDetails = array();

				$where=array('companyID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}

				$iscreated = $this->CommonModel->deleteMasterDetails('companyMaster',$where);
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
				break;
			}	
			default:
			{
				$where = array("companyID"=>$id);
				$companyHistory = $this->CommonModel->getMasterDetails('companyMaster','',$where);
				if(isset($companyHistory) && !empty($companyHistory)){

				$status['data'] = $companyHistory;
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
				break;
			}
		}
		
	}
	public function companyChangeStatus()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest(); 
		$action = $this->input->post("action");
			if(trim($action) == "changeStatus"){
				$ids = $this->input->post("list");
				$statusCode = $this->input->post("status");	
				$changestatus = $this->CommonModel->changeMasterStatus('companyMaster',$statusCode,$ids,'companyID');
				
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
	public function getUserRoleDetails()
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
		

		$config = array();
		if(!isset($orderBy) || empty($orderBy)){
			$orderBy = "roleName";
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

		$config["base_url"] = base_url() . "userRoleDetails";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('RoleID','userRoleMaster',$wherec);
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
			$userRoleDetails = $this->CommonModel->GetMasterListDetails($selectC='','userRoleMaster',$wherec,'','',$join,$other);	
		}else{
			$userRoleDetails = $this->CommonModel->GetMasterListDetails($selectC='','userRoleMaster',$wherec,$config["per_page"],$page,$join,$other);	
		}
		
		$status['data'] = $userRoleDetails;
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
		if($userRoleDetails){
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
	public function userRoleMaster($id='')
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		
		switch ($method) {
			case "PUT":
			{
				$userRoleDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$userRoleDetails['roleName'] = $this->validatedata->validate('roleName','User Role Name',true,'',array());
				$userRoleDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$userRoleDetails['createdBy'] = $this->input->post('SadminID');
				$userRoleDetails['createdDate'] = $updateDate;
				$userRoleDetails['modifiedDate'] = '0';
				
				$iscreated = $this->CommonModel->saveMasterDetails('userRoleMaster',$userRoleDetails);
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
				break;
			}
				
			case "POST":
			{
				$userRoleDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$where=array('roleID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				$userRoleDetails['roleName'] = $this->validatedata->validate('roleName','User Role Name',true,'',array());
				$userRoleDetails['status'] = $this->validatedata->validate('status','status',true,'',array());
				$userRoleDetails['modifiedBy'] = $this->input->post('SadminID');
				$userRoleDetails['modifiedDate'] = $updateDate;
				
				$iscreated = $this->CommonModel->updateMasterDetails('userRoleMaster',$userRoleDetails,$where);
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
				break;
			}
			case "DELETE":
			{	
				$userRoleDetails = array();

				$where=array('roleID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}

				$iscreated = $this->CommonModel->deleteMasterDetails('userRoleMaster',$where);
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
				break;
			}	
			default:
			{
				$where = array("roleID"=>$id);
				$userRoleHistory = $this->CommonModel->getMasterDetails('userRoleMaster','',$where);
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
				break;
			}
				
		}
		
	}
	public function userRoleChangeStatus()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest(); 
		$action = $this->input->post("action");
			if(trim($action) == "changeStatus"){
				$ids = $this->input->post("list");
				$statusCode = $this->input->post("status");	
				$changestatus = $this->CommonModel->changeMasterStatus('userRoleMaster',$statusCode,$ids,'roleID');
				
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
	public function getTraineeDetails()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$textSearch = trim($this->input->post('textSearch'));
		$isAll = $this->input->post('getAll');
		$curPage = $this->input->post('curpage');
		$textval = $this->input->post('textval');
		$orderBy = $this->input->post('orderBy');
		$order = $this->input->post('order');
		$companyID = $this->input->post('companyID');
		$statuscode = $this->input->post('status');

		$config = array();
		if(!isset($orderBy) || empty($orderBy)){
			$orderBy = "traineeName";
			$order ="ASC";
		}
		$other = array("orderBy"=>$orderBy,"order"=>$order);
		
		$config = $this->config->item('pagination');
		$wherec = $join = array();
		if(isset($textSearch) && !empty($textSearch) && isset($textval) && !empty($textval)){
			if($textSearch == "companyName"){
				$wherec["cm.{$textSearch} like  "] = "'".$textval."%'";
			}
		$wherec["$textSearch like  "] = "'".$textval."%'";
		}
		//andy
		if(isset($companyID) && !empty($companyID)){
			$wherec["t.companyID"] = ' = "'.$companyID.'"';
		}
		
		//andy

		if(isset($statuscode) && !empty($statuscode)){
		$statusStr = str_replace(",",'","',$statuscode);
		$wherec["t.status"] = 'IN ("'.$statusStr.'")';
		}

		$join = array();
			$join[0]['type'] ="LEFT JOIN";
			$join[0]['table']="companyMaster";
			$join[0]['alias'] ="cm";
			$join[0]['key1'] ="companyID";
			$join[0]['key2'] ="companyID";
			$selectC = "t.*,cm.companyName";
		$config["base_url"] = base_url() . "traineeDetails";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('traineeID','traineeMaster',$wherec,array(),$join);
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
			$join = array();
			$traineeDetails = $this->CommonModel->GetMasterListDetails($selectC='','traineeMaster',$wherec,'','',$join,$other);	
		}else
		{
			
			$traineeDetails = $this->CommonModel->GetMasterListDetails($selectC,'traineeMaster',$wherec,$config["per_page"],$page,$join,$other);
		
		}
		
		$status['data'] = $traineeDetails;
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
		if($traineeDetails){
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


	public function traineeMaster($id='')
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		
		switch ($method) {
			case "PUT":
			{
				$traineeDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$year = date("Y");
				$timeStamp = microtime();
				$traineeDetails['companyTokenNo'] = $this->validatedata->validate('companyTokenNo','Trainee YSF Code ',false,'',array());
				$traineeDetails['ysfCode'] = "PEN_".$year."-".$timeStamp;
				$traineeDetails['traineeSource'] = $this->validatedata->validate('traineeSource','Trainee Source ',true,'',array());
				$traineeDetails['neenRegtNo'] = $this->validatedata->validate('neenRegtNo','Neen Registration Number ',false,'',array());
				$traineeDetails['trainingStartDate'] = dateFormat($this->validatedata->validate('trainingStartDate','Training start date ',true,'',array()));
				$traineeDetails['trainingEndDate'] = dateFormat($this->validatedata->validate('trainingEndDate','Training end Date ',true,'',array()));
				//stipend Rate Per M/D/H starts
				$traineeDetails['stipendRateType'] = $this->validatedata->validate('stipendRateType','Stipend Rate Per.. ',true,'',array());
				$traineeDetails['stipendRate'] = $this->validatedata->validate('stipendRate','Stipend rate ',true,'',array());
				//stipend Rate Per M/D/H ends
				$traineeDetails['monthDayFactor'] = $this->validatedata->validate('monthDayFactor','Month day factor on Stipend',true,'',array());
				$traineeDetails['extraMonthDayFactor'] = $this->validatedata->validate('extraMonthDayFactor','Month day factor on Extra Stipend',true,'',array());
				//Extra Time type Starts
				$traineeDetails['extraTimeType'] = $this->validatedata->validate('extraTimeType','Extra time type',true,'',array());
				 $traineeDetails['extraRatio'] = $this->validatedata->validate('extraRatio');
				 $traineeDetails['extraFixRate'] = $this->validatedata->validate('extraFixRate');
				
				$traineeDetails['regType'] = $this->validatedata->validate('regType','Registration Type',false,'',array());

				$extraRatio =$traineeDetails['extraRatio'];
				$extraFixRate =$traineeDetails['extraFixRate'];

				if($traineeDetails['extraTimeType']=='R'){
					$extraRatio = $this->validatedata->validate('extraRatio','Extra Ratio Rate',true,'',array());
					$extraFixRate ='0';
				}
				elseif($traineeDetails['extraTimeType']=='F'){
					$extraFixRate = $this->validatedata->validate('extraFixRate','Extra Fix Rate',true,'',array());
					$extraRatio ='0';
				}
				//Extra Time type ends
				$traineeDetails['shiftHours'] = $this->validatedata->validate('shiftHours','Shift Hours',true,'',array());
				$traineeDetails['shoes'] = $this->validatedata->validate('shoes','Shoes',true,'',array());
				
				$traineeDetails['uniform'] = $this->validatedata->validate('uniform','Uniform',true,'',array());
				$traineeDetails['traineeName'] = $this->validatedata->validate('traineeName','Trainee  Name',true,'',array());
				$traineeDetails['companyID'] = $this->validatedata->validate('companyID','Company Name',true,array(),array());
				$traineeDetails['presentAddress'] = $this->validatedata->validate('presentAddress','Present Address',false,array(),array());
				$traineeDetails['stateID'] = $this->validatedata->validate('stateID','Present State Name',false,'',array());
				$traineeDetails['permanentAddress'] = $this->validatedata->validate('permanentAddress','Permanent Address',false,'',array());
				$traineeDetails['permanentStateID'] = $this->validatedata->validate('permanentStateID','Permanent State Name',false,'',array());
				$traineeDetails['email'] = $this->validatedata->validate('email','Email Id',false,'',array());
				//mobile and aadhar card starts
				$traineeDetails['mobile'] = $this->validatedata->validate('mobile');
				$traineeDetails['aadhaarNo'] = $this->validatedata->validate('aadhaarNo');

				if($traineeDetails['mobile'] !='' && $traineeDetails['aadhaarNo'] !=''){

					$mobileWhere = $traineeDetails['mobile'];
					$adhaarWhere = $traineeDetails['aadhaarNo'];
					$mobileDetails = $this->CommonModel->getMobileDetails($mobileWhere);
					$aadhaardetails = $this->CommonModel->getAadhaarDetails($adhaarWhere);

					if(isset($mobileDetails) && !empty($mobileDetails)){

						$status['msg'] ="Mobile Number duplicate";
						$status['statusCode'] = 998;
						$status['data'] = array();
						$status['flag'] = 'F';
						$this->response->output($status,200);
					}
					if(isset($aadhaardetails) && !empty($aadhaardetails)){

						$status['msg'] ="Aadhar Number duplicate";
						$status['statusCode'] = 998;
						$status['data'] = array();
						$status['flag'] = 'F';
						$this->response->output($status,200);
					}	
				}
				if($traineeDetails['mobile']==''){
					$traineeDetails['aadhaarNo'] =  $this->validatedata->validate('aadhaarNo','Aadhar Card Number',true,'',array());
					$adhaarWhere = $traineeDetails['aadhaarNo'];
					$tdetails = $this->CommonModel->getAadhaarDetails($adhaarWhere);
					if(isset($tdetails) && !empty($tdetails)){

						$status['msg'] ="Aadhar Number duplicate";
						$status['statusCode'] = 998;
						$status['data'] = array();
						$status['flag'] = 'F';
						$this->response->output($status,200);
					}	
				}elseif($traineeDetails['aadhaarNo']==''){
					$traineeDetails['mobile'] =  $this->validatedata->validate('mobile','Mobile Number',true,'',array());
					$mobileWhere = $traineeDetails['mobile'];
					$tdetails = $this->CommonModel->getMobileDetails($mobileWhere);
					if(isset($tdetails) && !empty($tdetails)){

						$status['msg'] ="Mobile Number duplicate";
						$status['statusCode'] = 998;
						$status['data'] = array();
						$status['flag'] = 'F';
						$this->response->output($status,200);
					}
				}

				//mobile and aadhar card ends
				$traineeDetails['panNo'] = $this->validatedata->validate('panNo','Pan No',false,'',array());
				$traineeDetails['lastExamPass'] = $this->validatedata->validate('lastExamPass','Last Exam Pass',false,'',array());
				$traineeDetails['courseCurrentlyEnrolled'] = $this->validatedata->validate('courseCurrentlyEnrolled','Course Currently Enrolled',false,'',array());
				$traineeDetails['dateOfBirth'] = dateFormat($this->validatedata->validate('dateOfBirth','Date Of Birth',false,'',array()));
				$traineeDetails['gender'] = $this->validatedata->validate('gender','Gender',false,'',array());
				$traineeDetails['marriageStatus'] = $this->validatedata->validate('marriageStatus','Marriage Status',false,'',array());
				$traineeDetails['casteCatID'] = $this->validatedata->validate('casteCatID','Caste Category Name',false,'',array());
				$traineeDetails['height'] = $this->validatedata->validate('height','Height',false,'',array());
				$traineeDetails['weight'] = $this->validatedata->validate('weight','Weight',false,'',array());
				$traineeDetails['bloodGroup'] = $this->validatedata->validate('bloodGroup','Blood Group',false,'',array());
				$traineeDetails['image'] = $this->validatedata->validate('image','Image',false,'',array());
				$traineeDetails['specialization'] = $this->validatedata->validate('specialization','Specialization',false,'',array());
				$traineeDetails['nsqfLevel'] = $this->validatedata->validate('nsqfLevel','NSQF Level',false,'',array());
				$traineeDetails['placeOfTraining'] = $this->validatedata->validate('placeOfTraining','Place Of Training',false,'',array());
				$traineeDetails['skillID'] = $this->validatedata->validate('skillID','Skill Description',false,'',array());
				$traineeDetails['jobRole'] = $this->validatedata->validate('jobRole','Job Role',false,'',array());
				//certificate validation start
				$traineeDetails['certificate'] = $this->validatedata->validate('certificate');
				$traineeDetails['certificateNo'] = $this->validatedata->validate('certificateNo');
				if($traineeDetails['certificate'] =='Y')
				{
					$traineeDetails['certificateNo'] = $this->validatedata->validate('certificateNo','Certificate Number',true,'',array());
				}else
				{
					$traineeDetails['certificateNo'] = '';
				}
				//certificate validation end
				$traineeDetails['wcPolicy'] = $this->validatedata->validate('wcPolicy');

				$traineeDetails['acidentPolicy'] = $this->validatedata->validate('acidentPolicy');

				$traineeDetails['bankAcNo'] = $this->validatedata->validate('bankAcNo','Bank Ac No',false,'',array());
				$traineeDetails['bankName'] = $this->validatedata->validate('bankName','Bank Name',false,'',array());
				$traineeDetails['bankBranch'] = $this->validatedata->validate('bankBranch','Bank Branch',false,'',array());
				$traineeDetails['bankIFSC'] = $this->validatedata->validate('bankIFSC','Bank IFSC',false,'',array());
				$traineeDetails['cancelCheqPhotoImage'] = $this->validatedata->validate('cancelCheqPhotoImage','Cancel Cheq Photo Image',false,'',array());	
				$traineeDetails['status'] = $this->validatedata->validate('status','status',false,'',array());	
				//left date validation
				$traineeDetails['leftDate'] = dateFormat($this->validatedata->validate('leftDate'));
				if($traineeDetails['status'] !=='active')
				{
					$traineeDetails['leftDate'] = dateFormat($this->validatedata->validate('leftDate','leftDate ',true,'',array()));
				}

				$traineeDetails['createdBy'] = $this->input->post('SadminID');
				$traineeDetails['createdDate'] = $updateDate;
				$traineeDetails['modifiedDate'] = '0';
				//left date ends
				$iscreated = $this->CommonModel->saveMasterDetails('traineeMaster',$traineeDetails);
				

				if(!$iscreated){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);

				}else{
					$traineeTmp = $this->TraineeModel->gettempTraineeCode();
					if(isset($traineeTmp) && !empty($traineeTmp)){
						
						foreach($traineeTmp as $key => $value){
							$year = date("Y");
							$num = sprintf("%05d",$value->traineeID);
							$code = "YF".$year.$num;
							$traineeDetails['ysfCode'] = $code;
							$where = array("traineeID"=>$value->traineeID);
							$isUpdate = $this->CommonModel->updateMasterDetails('traineeMaster',$traineeDetails,$where);
						}
					}
					$status['msg'] = $this->systemmsg->getSucessCode(400);
					$status['statusCode'] = 400;
					$status['data'] =array();
					$status['flag'] = 'S';
					$this->response->output($status,200);

		
				}
				break;
			}				
			case "POST":
			{	
				$traineeDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				$where=array('traineeID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				$traineeDetails = array();
				$updateDate = date("Y/m/d H:i:s");
				//$traineeDetails['ysfCode'] = $this->validatedata->validate('ysfCode','Trainee YSF Code ',true,'',array());
				$traineeDetails['companyTokenNo'] = $this->validatedata->validate('companyTokenNo','Trainee YSF Code ',false,'',array());
				$traineeDetails['traineeSource'] = $this->validatedata->validate('traineeSource','Trainee Source ',true,'',array());
				$traineeDetails['neenRegtNo'] = $this->validatedata->validate('neenRegtNo','Neen Registration Number ',false,'',array());
				$traineeDetails['trainingStartDate'] = dateFormat($this->validatedata->validate('trainingStartDate','Training start date ',true,'',array()));
				$traineeDetails['trainingEndDate'] = dateFormat($this->validatedata->validate('trainingEndDate','Training end Date ',true,'',array()));
				//stipend Rate Per M/D/H starts
				$traineeDetails['stipendRateType'] = $this->validatedata->validate('stipendRateType','Stipend Rate Per.. ',true,'',array());
				$traineeDetails['stipendRate'] = $this->validatedata->validate('stipendRate','Stipend rate ',true,'',array());
				//stipend Rate Per M/D/H ends
				$traineeDetails['monthDayFactor'] = $this->validatedata->validate('monthDayFactor','Month day factor on Stipend',true,'',array());
				$traineeDetails['extraMonthDayFactor'] = $this->validatedata->validate('extraMonthDayFactor','Month day factor on Extra Stipend',true,'',array());
				//Extra Time type Starts
				$traineeDetails['extraTimeType'] = $this->validatedata->validate('extraTimeType','Extra time type',true,'',array());
				 $traineeDetails['extraRatio'] = $this->validatedata->validate('extraRatio');
				 $traineeDetails['extraFixRate'] = $this->validatedata->validate('extraFixRate');
				 
				$extraRatio =$traineeDetails['extraRatio'];
				$extraFixRate =$traineeDetails['extraFixRate'];

				$traineeDetails['regType'] = $this->validatedata->validate('regType','Registration Type',false,'',array());
				
				if($traineeDetails['extraTimeType']=='R'){
					$extraRatio = $this->validatedata->validate('extraRatio','Extra Ratio Rate',true,'',array());
					$extraFixRate ='0';
				}
				elseif($traineeDetails['extraTimeType']=='F'){
					$extraFixRate = $this->validatedata->validate('extraFixRate','Extra Fix Rate',true,'',array());
					$extraRatio ='0';
				}
				//Extra Time type ends
				$traineeDetails['shiftHours'] = $this->validatedata->validate('shiftHours','Shift Hours',true,'',array());
				$traineeDetails['shoes'] = $this->validatedata->validate('shoes','Shoes',true,'',array());
				
				$traineeDetails['uniform'] = $this->validatedata->validate('uniform','Uniform',true,'',array());
				$traineeDetails['traineeName'] = $this->validatedata->validate('traineeName','Trainee  Name',true,'',array());
				$traineeDetails['companyID'] = $this->validatedata->validate('companyID','Company Name',true,array(),array());
				$traineeDetails['presentAddress'] = $this->validatedata->validate('presentAddress','Present Address',false,array(),array());
				$traineeDetails['stateID'] = $this->validatedata->validate('stateID','Present State Name',false,'',array());
				$traineeDetails['permanentAddress'] = $this->validatedata->validate('permanentAddress','Permanent Address',false,'',array());
				$traineeDetails['permanentStateID'] = $this->validatedata->validate('permanentStateID','Permanent State Name',false,'',array());
				$traineeDetails['email'] = $this->validatedata->validate('email','Email Id',false,'',array());
				//mobile and aadhar card starts
				$traineeDetails['mobile'] =  $this->validatedata->validate('mobile');
				$traineeDetails['aadhaarNo'] = $this->validatedata->validate('aadhaarNo');

				if($traineeDetails['mobile']==''){
					$traineeDetails['aadhaarNo'] =  $this->validatedata->validate('aadhaarNo','Aadhar Card Number',true,'',array());

					$adhaarWhere = $traineeDetails['aadhaarNo'];
					$aadhaarDetails = $this->CommonModel->getAadhaarDetails($adhaarWhere);
					if(isset($aadhaarDetails) && !empty($aadhaarDetails)){

						$status['msg'] ="Aadhar Number duplicate";
						$status['statusCode'] = 998;
						$status['data'] = array();
						$status['flag'] = 'F';
						$this->response->output($status,200);
					}
				}elseif($traineeDetails['aadhaarNo']==''){
					$traineeDetails['mobile'] =  $this->validatedata->validate('mobile','Mobile Number',true,'',array());
					
					$mobileWhere = $traineeDetails['mobile'];
					$mobileDetails = $this->CommonModel->getMobileDetails($mobileWhere);
						if(isset($mobileDetails) && !empty($mobileDetails)){

							$status['msg'] ="Mobile Number duplicate";
							$status['statusCode'] = 998;
							$status['data'] = array();
							$status['flag'] = 'F';
							$this->response->output($status,200);
						}
				}
				
				if($traineeDetails['mobile'] !='' && $traineeDetails['aadhaarNo'] !=''){
					
					$mobileWhere = $traineeDetails['mobile'];
					$adhaarWhere = $traineeDetails['aadhaarNo'];
					$mobileDetails = $this->CommonModel->getMobileDetails($mobileWhere);
					$aadhaarDetails = $this->CommonModel->getAadhaarDetails($adhaarWhere);
					
					if (isset($mobileDetails) && !empty($mobileDetails)) {
						if($mobileDetails[0]->traineeID != $id){
							
							$status['msg'] ="Mobile Number duplicate";
							$status['statusCode'] = 998;
							$status['data'] = array();
							$status['flag'] = 'F';
							$this->response->output($status,200);
						}
					}	
					if (isset($aadhaarDetails) && !empty($aadhaarDetails)) {
						if($aadhaarDetails[0]->traineeID != $id){

							$status['msg'] ="Aadhar Number duplicate";
							$status['statusCode'] = 998;
							$status['data'] = array();
							$status['flag'] = 'F';
							$this->response->output($status,200);
						}	
					}
				}

				//mobile and aadhar card ends
				$traineeDetails['panNo'] = $this->validatedata->validate('panNo','Pan No',false,'',array());
				$traineeDetails['lastExamPass'] = $this->validatedata->validate('lastExamPass','Last Exam Pass',false,'',array());
				$traineeDetails['courseCurrentlyEnrolled'] = $this->validatedata->validate('courseCurrentlyEnrolled','Course Currently Enrolled',false,'',array());
				$traineeDetails['dateOfBirth'] = dateFormat($this->validatedata->validate('dateOfBirth','Date Of Birth',false,'',array()));
				$traineeDetails['gender'] = $this->validatedata->validate('gender','Gender',false,'',array());
				$traineeDetails['marriageStatus'] = $this->validatedata->validate('marriageStatus','Marriage Status',false,'',array());
				$traineeDetails['casteCatID'] = $this->validatedata->validate('casteCatID','Caste Category Name',false,'',array());
				$traineeDetails['height'] = $this->validatedata->validate('height','Height',false,'',array());
				$traineeDetails['weight'] = $this->validatedata->validate('weight','Weight',false,'',array());
				$traineeDetails['bloodGroup'] = $this->validatedata->validate('bloodGroup','Blood Group',false,'',array());
				$traineeDetails['image'] = $this->validatedata->validate('image','Image',false,'',array());
				$traineeDetails['specialization'] = $this->validatedata->validate('specialization','Specialization',false,'',array());
				$traineeDetails['nsqfLevel'] = $this->validatedata->validate('nsqfLevel','NSQF Level',false,'',array());
				$traineeDetails['placeOfTraining'] = $this->validatedata->validate('placeOfTraining','Place Of Training',false,'',array());
				$traineeDetails['skillID'] = $this->validatedata->validate('skillID','Skill Description',false,'',array());
				$traineeDetails['jobRole'] = $this->validatedata->validate('jobRole','Job Role',false,'',array());
				//certificate validation start
				$traineeDetails['certificate'] = $this->input->post('certificate');
				$traineeDetails['certificateNo'] = $this->input->post('certificateNo');

				if($traineeDetails['certificate'] =='Y')
				{
					$traineeDetails['certificateNo'] = $this->validatedata->validate('certificateNo','Certificate Number',true,'',array());
				}else
				{
					$traineeDetails['certificateNo'] = '';
				}
				//certificate validation end
				$traineeDetails['wcPolicy'] = $this->input->post('wcPolicy');

				$traineeDetails['acidentPolicy'] = $this->input->post('acidentPolicy');

				$traineeDetails['bankAcNo'] = $this->validatedata->validate('bankAcNo','Bank Ac No',false,'',array());
				$traineeDetails['bankName'] = $this->validatedata->validate('bankName','Bank Name',false,'',array());
				$traineeDetails['bankBranch'] = $this->validatedata->validate('bankBranch','Bank Branch',false,'',array());
				$traineeDetails['bankIFSC'] = $this->validatedata->validate('bankIFSC','Bank IFSC',false,'',array());
				$traineeDetails['cancelCheqPhotoImage'] = $this->validatedata->validate('cancelCheqPhotoImage','Cancel Cheq Photo Image',false,'',array());	
				$traineeDetails['status'] = $this->validatedata->validate('status','status',false,'',array());	
				//left date validation
				if($traineeDetails['status'] !=='active')
				{
					$traineeDetails['leftDate'] = dateFormat($this->validatedata->validate('leftDate','leftDate ',true,'',array()));
				}

				$traineeDetails['modifiedBy'] = $this->input->post('SadminID');
				$traineeDetails['modifiedDate'] = $updateDate;
				//left date ends
				$iscreated = $this->CommonModel->updateMasterDetails('traineeMaster',$traineeDetails,$where);
				
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
				break;
			}
			case "DELETE":
			{	
				$traineeDetails = array();

				$where=array('traineeID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}

				$iscreated = $this->CommonModel->deleteMasterDetails('traineeMaster',$where);
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
				break;
			}	
			default:
			{
				$where = array("traineeID"=>$id);
				$select = "*,DATE_FORMAT(trainingStartDate,'%d-%m-%Y') as trainingStartDate,,DATE_FORMAT(trainingEndDate,'%d-%m-%Y') as trainingEndDate,DATE_FORMAT(dateOfBirth,'%d-%m-%Y') as dateOfBirth,DATE_FORMAT(leftDate,'%d-%m-%Y') as leftDate";
				$traineeHistory = $this->CommonModel->getMasterDetails('traineeMaster',$select,$where);
				if(isset($traineeHistory) && !empty($traineeHistory)){

				$status['data'] = $traineeHistory;
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
				break;
			}
		}
		
	}
	public function traineeChangeStatus()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest(); 
		$action = $this->input->post("action");
			if(trim($action) == "changeStatus"){
				$ids = $this->input->post("list");
				$statusCode = $this->input->post("status");	
				$changestatus = $this->CommonModel->changeMasterStatus('traineeMaster',$statusCode,$ids,'traineeID');
				
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
}