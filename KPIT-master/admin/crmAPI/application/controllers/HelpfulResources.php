<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HelpfulResources extends CI_Controller {

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
		$this->load->library("Emails");
		$where = array("infoID"=>1);
		$infoData = $this->CommonModel->getMasterDetails('infoSettings','',$where);
		$this->fromEmail=$infoData[0]->fromEmail;
		$this->fromName=$infoData[0]->fromName;
		// print_r($infoData);
	}

	public function getResourceDetailsList()
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
			$orderBy = "resourceID";
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
		 //print_r($wherec);exit();
		$config["base_url"] = base_url() . "pagesDetails";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('resourceID',"helpfulResources",$wherec);
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
		$selectC="title,section,createdDate,status,resourceID";
		if($isAll=="Y"){
			$pagesDetails = $this->CommonModel->GetMasterListDetails($selectC,'helpfulResources',$wherec,'','',$join,$other);	
		}else{
			$pagesDetails = $this->CommonModel->GetMasterListDetails($selectC,'helpfulResources',$wherec,$config["per_page"],$page,$join,$other);	
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
	public function helpfulResourcesData($id='')
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		$faqMasterDetails = array();
		$updateDate = date("Y/m/d H:i:s");
		if($method=="PUT"||$method=="POST")
		{
			$faqMasterDetails['title'] = $this->validatedata->validate('title','Title',false,'',array());

			$faqMasterDetails['description'] = $this->validatedata->validate('description','Description',true,'',array()); 
			$faqMasterDetails['section'] = $this->validatedata->validate('section','Section',true,'',array()); 
			$faqMasterDetails['cover'] = $this->validatedata->validate('cover','Cover image',false,'',array()); 
			$faqMasterDetails['link'] = $this->validatedata->validate('link','Link',false,'',array()); 
			$faqMasterDetails['status'] = $this->validatedata->validate('status','status',true,'',array());

			if($method=="PUT")
			{
				
				$faqMasterDetails['createdBy'] = $this->input->post('SadminID');
				$faqMasterDetails['createdDate'] = $updateDate;
				
				$iscreated = $this->CommonModel->saveMasterDetails('helpfulResources',$faqMasterDetails);
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
				$where=array('resourceID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				
				
				$faqMasterDetails['modifiedBy'] = $this->input->post('SadminID');
				$faqMasterDetails['modifiedDate'] = $updateDate;
				
				$iscreated = $this->CommonModel->updateMasterDetails('helpfulResources',$faqMasterDetails,$where);
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
			$faqMasterDetails = array();

			$where=array('resourceID'=>$id);
			if(!isset($id) || empty($id)){
				$status['msg'] = $this->systemmsg->getErrorCode(996);
				$status['statusCode'] = 996;
				$status['data'] = array();
				$status['flag'] = 'F';
				$this->response->output($status,200);
			}

			$iscreated = $this->CommonModel->deleteMasterDetails('helpfulResources',$where);
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
			$where = array("resourceID"=>$id);
			$userRoleHistory = $this->CommonModel->getMasterDetails('helpfulResources','',$where);
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
	public function faqMasterDataChangeStatus()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest(); 
		$action = $this->input->post("action");
			if(trim($action) == "changeStatus"){
				$ids = $this->input->post("list");
				$statusCode = $this->input->post("status");	
				$changestatus = $this->CommonModel->changeMasterStatus('helpfulResources',$statusCode,$ids,'resourceID');
				
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
	public function sendEmailWithAnswer($question,$answer,$askedByName,$email)
	{
		
		
		$where = array("tempName"=>"FAQAnswerTemp");
		$emailContent = $this->CommonModel->getMasterDetails('emailMaster','',$where);
		if(!isset($emailContent)&&empty($emailContent))
		{
			$status['data'] = "Email Template Not Found Named As 'FAQAnswerTemp'";
			$status['msg'] = $this->systemmsg->getErrorCode(996);
			$status['statusCode'] = 996;
			$status['flag'] = 'F';
			$this->response->output($status,200);
		}
		$mailContent = str_replace("{{question}}",$question,$emailContent[0]->emailContent);
		$mailContent = str_replace("{{answer}}",$answer,$mailContent);
		$mailContent = str_replace("{{askedByName}}",$askedByName,$mailContent);

		$from=$this->fromEmail;
		$to=$email;
		$subject=$emailContent[0]->subject;
		$fromName=$this->fromName;;
		$msg=$mailContent;
		
		return $isEmailSend=$this->emails->sendMailDetails($from,$fromName,$to,$cc='',$bcc='',$subject,$msg);
		

	}
	public function uploadImage(){
		$this->load->library('realtimeupload');
        $name= $this->input->post('name');

        $fullPath = $this->config->item("HELPFUL_RESOURCE_PATH");
        
        if (!is_dir($fullPath)) {
            mkdir($fullPath,0777);
            chmod($fullPath,0777);         
        }
        else{
            if (!is_writable($fullPath)) {
                chmod($fullPath,0777);
            }
        }

        $config=array();
        $config['upload_path']= $fullPath;
        $config['max_size']= 50000;
        $this->load->library('upload', $config);
        $settings = array(
            'uploadFolder' => $fullPath,
            'extension' => array('gif', 'jpeg', 'jpg', 'png'),
            'maxFolderFiles' =>0,
            'maxFolderSize' => 0,
            'returnLocation' => true,
            'uniqueFilename'=> false,
            'isSaveToDB'=>"N",
            'maxFileSize'=>100000,
        );
        $this->realtimeupload->init($settings);
        exit;
	}

}