<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helpful extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        // Your own constructor code
    }
	public function index()
	{
        $other=array("orderBy"=>"createdDate","order"=>"DESC");
        $where=array("status ="=>"'active'");
        $faqs=$this->CommonModel->GetMasterListDetails('*',"faqMaster",$where,'','',$join=array(),$other);
        $data=array();
        $data['faqList']=$faqs;
		$this->load->view('website/header');
        $this->load->view('website/helpful-resources',$data);
        $this->load->view('website/footer');
	}
    
}
