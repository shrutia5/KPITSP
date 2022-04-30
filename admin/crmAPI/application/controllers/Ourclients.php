<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ourclients extends CI_Controller {

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
    public function index(){
        
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
			$orderBy = "createdDate";
			$order ="DESC";
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
        

		$config["base_url"] = base_url() . "ourclientsList";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('ClientsID','ourclients',$wherec);
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
			$branchDetails = $this->CommonModel->GetMasterListDetails($selectC='','ourclients',$wherec,'','',$join,$other);	
		}else{
			$branchDetails = $this->CommonModel->GetMasterListDetails($selectC='','ourclients',$wherec,$config["per_page"],$page,$join,$other);	
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
	public function save($id='')

	{
        
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		$ourclientskMasterDetails = array();
		$updateDate = date("Y/m/d H:i:s");
		if($method=="PUT"||$method=="POST")
		{
			
			$action = $this->input->post('status');
			
			if($action == "delete"){
				$list = $this->input->post('list');
				
				if(!isset($list) || empty($list)){
					$status['msg'] = "1".$this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				//getall record and delete the images from server
				$other = array();
				$other['whereIn'] = "clientsID";
				$other['whereData'] =$list; 
				
				$ourclientsDetails = $this->CommonModel->GetMasterListDetails("*",'ourclients',array(),'','',array(),$other);
				//($ourclientsDetails); exit;
				if(isset($ourclientsDetails) && !empty($ourclientsDetails)){
					foreach ($ourclientsDetails as $key => $value) {
						if(!empty($value->clientImage)){
							$imagetoup = $this->config->item("imagesPATH")."clients/".$value->clientImage;
							//print $imagetoup; exit;
							if(file_exists($imagetoup)){
								unlink($imagetoup);
							}
						}
					}

					$iscreated = $this->CommonModel->deleteMasterDetails('ourclients',array(),array("clientsID"=>$list));
					if(!$iscreated){
						$status['msg'] =$this->systemmsg->getErrorCode(996);
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
				}else{
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				exit();
			}

			$ourclientsMasterDetails['clientsname'] = $this->validatedata->validate('clientsname','Clients Name',true,'',array()); 
			$ourclientsMasterDetails['link'] = $this->validatedata->validate('link','Link',true,'',array()); 
			

			$ourclientsMasterDetails['categoryID'] = $this->validatedata->validate('categoryID','Category',true,'',array());

			
					
			$ourclientsMasterDetails['status'] = $this->validatedata->validate('status','status',true,'',array());

			$image64 = $this->validatedata->validate('clientImageUP','Client Logo',false,'',array());
			//print $image64; exit;
			if($image64!="")
			{
				$imageName = str_replace(" ","_",$ourclientsMasterDetails['clientsname']).".jpg";
				$ourclientsMasterDetails['clientImage'] = $imageName;
				$imagetoup = $this->config->item("imagesPATH")."clients/".$imageName;
				// $imagesPATH = $this->config->item('imagesPATH')."formQuestionImages/";
				$saveImage = $this->base64_to_jpeg($image64,$imagetoup);
				if(!$saveImage)
				{	
					$status['msg'] = $this->systemmsg->getErrorCode(996);
					$status['statusCode'] = 996;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
			}
			if($method=="PUT")
			{
				
				$ourclientsMasterDetails['createdBy'] = $this->input->post('SadminID');
				$ourclientsMasterDetails['createdDate'] = $updateDate;
				
				
				$iscreated = $this->CommonModel->saveMasterDetails('ourclients',$ourclientsMasterDetails);
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
				$where=array('clientsID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				
				
				$ourclientsMasterDetails['modifiedBy'] = $this->input->post('SadminID');
				$ourclientsMasterDetails['modifiedDate'] = $updateDate;
				
				$iscreated = $this->CommonModel->updateMasterDetails('ourclients',$ourclientsMasterDetails,$where);
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
			$ourclientsMasterDetails = array();

			$where=array('clientsID'=>$id);
			if(!isset($id) || empty($id)){
				$status['msg'] = $this->systemmsg->getErrorCode(996);
				$status['statusCode'] = 996;
				$status['data'] = array();
				$status['flag'] = 'F';
				$this->response->output($status,200);
			}

			$iscreated = $this->CommonModel->deleteMasterDetails('ourclients',$where);
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
			// echo "Sdfsdfsdfsdfs";exit;
			$where = array("clientsID"=>$id);
			$ourClientsDetails = $this->CommonModel->getMasterDetails('ourclients','',$where);
			if(isset($ourClientsDetails) && !empty($ourClientsDetails)){
			$status['data'] = $ourClientsDetails;
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
	function base64_to_jpeg($base64_string, $output_file) {
	    // open the output file for writing
	    $ifp = fopen( $output_file, 'wb' ); 

	    // split the string on commas
	    // $data[ 0 ] == "data:image/png;base64"
	    // $data[ 1 ] == <actual base64 string>
	    $data = explode( ',', $base64_string );

	    // we could add validation here with ensuring count( $data ) > 1
	    fwrite( $ifp, base64_decode( $data[ 1 ] ) );

	    // clean up the file resource
	    fclose( $ifp ); 

	    return $output_file; 
	}

	
}