<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {

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

	public function getBlogsList()
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
			$orderBy = "blogTitle";
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

		$join = array();
		$join[0]['type'] ="LEFT JOIN";
		$join[0]['table']="categoryMaster";
		$join[0]['alias'] ="c";
		$join[0]['key1'] ="category";
		$join[0]['key2'] ="categoryID";

		$config["base_url"] = base_url() . "pagesDetails";
	    $config["total_rows"] = $this->CommonModel->getCountByParameter('blogID',"blogs",$wherec);
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
			$selectC="blogID,blogTitle,category,createdDate,c.categoryName";
		if($isAll=="Y"){
			$pagesDetails = $this->CommonModel->GetMasterListDetails($selectC='','blogs',$wherec,'','',$join,$other);	
		}else{
			$pagesDetails = $this->CommonModel->GetMasterListDetails($selectC='','blogs',$wherec,$config["per_page"],$page,$join,$other);	
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
	public function blogs($id='')
	{ 
		$this->access->checkTokenKey();
		$this->response->decodeRequest();
		$method = $this->input->method(TRUE);
		$blogsDetails = array();
		$updateDate = date("Y/m/d H:i:s");
		if($method=="PUT"||$method=="POST")
		{
			$blogsDetails['blogTitle'] = $this->validatedata->validate('blogTitle','Blog Title',false,'',array());


			$blogsDetails['description'] = $this->validatedata->validate('description','description',false,'',array());
 			if(!empty($this->input->post('category')))
 			{
 				// echo  $this->input->post('category');exit();
 				if(is_array($this->input->post('category')))
 				{
 					$category=implode(",",$this->input->post('category'));
					$blogsDetails['category'] = $category;
				}else
				{
					$blogsDetails['category']=$this->input->post('category');
				}
 				
 			}else
 			{
 				$blogsDetails['category'] = "";
 			}
			

			$blogsDetails['blogLink'] = $this->validatedata->validate('blogLink','Blog Link',false,'',array());

			$blogsDetails['blogSubTitle'] = $this->validatedata->validate('blogSubTitle','Blog Sub Title',false,'',array());

			$blogsDetails['metaKeywords'] = $this->validatedata->validate('metaKeywords','metaKeywords',false,'',array());

			$blogsDetails['metaDesc'] = $this->validatedata->validate('metaDesc','metaDesc',false,'',array());

			$blogsDetails['pageCode'] = htmlspecialchars($this->validatedata->validate('pageCode','Page Code',false,'',array()));

			$blogsDetails['pageCss'] = $this->validatedata->validate('pageCss','Page Css',false,'',array());

			$blogsDetails['pageContent'] = htmlspecialchars($this->validatedata->validate('pageContent','Page Content',false,'',array()));

			// $blogsDetails['blogTemplate'] = htmlspecialchars($this->validatedata->validate('blogTemplate','Blog Template',false,'',array()));
			
			
			$blogImage = $this->validatedata->validate('blogImage','Blog Image',false,'',array()); 
		
			$blogsDetails['status'] = $this->validatedata->validate('status','status',true,'',array());

			if($method=="PUT")
			{
				$image64 = $this->validatedata->validate('addblogImage','Blog Image',true,'',array()); 
				if($image64!="")
				{
					$imageName = "blogImage".rand(10,1000).".jpg";
					$blogsDetails['blogImage'] = $imageName;

					$imagetoup = $this->config->item("imagesPATH")."blogImages/".$imageName;
					$saveImage = $this->base64_to_jpeg($image64,$imagetoup);

				}
				
				$blogsDetails['createdBy'] = $this->input->post('SadminID');
				$blogsDetails['createdDate'] = $updateDate;
				$blogsDetails['modifiedDate'] = '0';
				
				$iscreated = $this->CommonModel->saveMasterDetails('blogs',$blogsDetails);
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
				$where=array('blogID'=>$id);
				if(!isset($id) || empty($id)){
					$status['msg'] = $this->systemmsg->getErrorCode(998);
					$status['statusCode'] = 998;
					$status['data'] = array();
					$status['flag'] = 'F';
					$this->response->output($status,200);
				}
				$image64="";
				if($blogImage=="")
				{
					$image64 = $this->validatedata->validate('addblogImage','Blog Image',true,'',array());
				}else
				{
					$image64 = $this->validatedata->validate('addblogImage','Blog Image',false,'',array());	
				}
				if($image64!="")
				{
					$blogImageArr = $this->CommonModel->getMasterDetails('blogs','blogImage',$where);
					if($blogImageArr=="")
					{
						$imageName = "blogImage".rand(10,1000).".jpg";
					}else
					{
						$imageName=$blogImageArr[0]->blogImage;
					}
					$blogsDetails['blogImage'] = $imageName;

					$imagetoup = $this->config->item("imagesPATH")."blogImages/".$imageName;
					$saveImage = $this->base64_to_jpeg($image64,$imagetoup);
				}
					
				
				$blogsDetails['modifiedBy'] = $this->input->post('SadminID');
				$blogsDetails['modifiedDate'] = $updateDate;
				
				$iscreated = $this->CommonModel->updateMasterDetails('blogs',$blogsDetails,$where);
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
			$blogsDetails = array();

			$where=array('blogID'=>$id);
			if(!isset($id) || empty($id)){
				$status['msg'] = $this->systemmsg->getErrorCode(996);
				$status['statusCode'] = 996;
				$status['data'] = array();
				$status['flag'] = 'F';
				$this->response->output($status,200);
			}

			$iscreated = $this->CommonModel->deleteMasterDetails('blogs',$where);
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
			$where = array("blogID"=>$id);
			$userRoleHistory = $this->CommonModel->getMasterDetails('blogs','',$where);
			if(isset($userRoleHistory) && !empty($userRoleHistory)){
				if(isset($userRoleHistory[0]->pageCode) && !empty($userRoleHistory[0]->pageCode)){
				$userRoleHistory[0]->pageCode = htmlspecialchars_decode($userRoleHistory[0]->pageCode);
			}	
			if(isset($userRoleHistory[0]->pageContent) && !empty($userRoleHistory[0]->pageContent)){
				$userRoleHistory[0]->pageContent = htmlspecialchars_decode($userRoleHistory[0]->pageContent);
			}

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
	public function blogsChangeStatus()
	{
		$this->access->checkTokenKey();
		$this->response->decodeRequest(); 
		$action = $this->input->post("action");
			if(trim($action) == "changeStatus"){
				$ids = $this->input->post("list");
				$statusCode = $this->input->post("status");	
				$changestatus = $this->CommonModel->changeMasterStatus('blogs',$statusCode,$ids,'blogID');
				
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
