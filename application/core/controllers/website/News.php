<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        // Your own constructor code
    }
	public function index()
	{
        $other=array("orderBy"=>"createdDate","order"=>"DESC");
        $where=array("category ="=>7,"status ="=>"'active'");
        $newsList=$this->CommonModel->GetMasterListDetails('*',"blogs",$where,'','',$join=array(),$other);
        $data=array();
        $data['newsList']=$newsList;
		$this->load->view('website/header');
        $this->load->view('website/news',$data);
        $this->load->view('website/footer');
	}
    public function single($newsLink="")
	{
        $where=array("status"=>"active");
         if($newsLink!="")   
         {
            $where['blogLink']=$newsLink;
         }
        $singleNews=$this->CommonModel->getMasterDetails('blogs',"*",$where);

        $other=array("orderBy"=>"createdDate","order"=>"DESC");
        $where=array("category ="=>6,"status ="=>"'active'");
        $blogs=$this->CommonModel->GetMasterListDetails('*',"blogs",$where,'','',$join=array(),$other);
        $data=array();
        $data['newsList']=$blogs;
        $data['news']=$singleNews[0];
		$this->load->view('website/header');
        $this->load->view('website/news-single',$data);
        $this->load->view('website/footer');
	}
}
