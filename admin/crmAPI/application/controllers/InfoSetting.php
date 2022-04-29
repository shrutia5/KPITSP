<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InfoSetting extends CI_Controller {

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
		$this->load->library("pagination");
		$this->load->library("response");
		$this->load->library("ValidateData");


	}

	public function index($id='')
	{

		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		
		if($method === "PUT" || $method === "POST"){
			$infoDetails = array();
			
			$updateDate = date("Y/m/d H:i:s");
			$id = $this->input->post('infoID');
			
			$infoDetails['companyName'] = $this->validatedata->validate('companyName');
			$infoDetails['email'] = $this->validatedata->validate('email');
			$infoDetails['fromEmail'] = $this->validatedata->validate('fromEmail');
			$infoDetails['fromName'] = $this->validatedata->validate('fromName');
			$infoDetails['createdBy'] = $this->validatedata->validate('SadminID');
			$infoDetails['createdDate'] = $updateDate;	
			
			$wherec  = array('infoID' =>$id);

			$infoData = $this->CommonModel->getMasterDetails('infoSettings','',$wherec);

			if(isset($infoData) && !empty($infoData)){
				$infoDetails['modifiedDate'] = $updateDate;
				$infoDetails['modifiedBy'] = $this->input->post('SadminID');

				$isinsert = $this->CommonModel->updateMasterDetails('infoSettings',$infoDetails,$wherec);
				if(!$isinsert){
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
			else{
				$count = $this->CommonModel->countFiltered('infoSettings');
				if($count == 0){
					$isinsert = $this->CommonModel->saveMasterDetails('infoSettings',$infoDetails);

						if(!$isinsert){

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
				}
			}	
		
			
		else
		{
			$id = $this->input->post('infoID');
			$where = $id;
			$infoHistory = $this->CommonModel->getMasterDetails('infoSettings','',$where);
			if(isset($infoHistory) && !empty($infoHistory)){

			$status['data'] = $infoHistory;
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
}
?>