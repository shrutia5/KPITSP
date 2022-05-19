<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        // Your own constructor code
    }
	public function index()
	{
        $other=array("orderBy"=>"createdDate","order"=>"DESC");
        $where=array("category ="=>6,"status ="=>"'active'");
        $blogs=$this->CommonModel->GetMasterListDetails('*',"blogs",$where,'','',$join=array(),$other);
        $data=array();
        $data['blogList']=$blogs;
        $data['pageTitle']="blogs";
        $data['metaDescription']="metaDescription";
        $data['metakeywords']="metakeywords";
		$this->load->view('website/header',$data);
        $this->load->view('website/blogs',$data);
        $this->load->view('website/footer');
	}
    public function single($blogLink)
	{
        $where=array("status"=>"active","blogLink"=>$blogLink);
        $singleBlog=$this->CommonModel->getMasterDetails('blogs',"*",$where);

        $other=array("orderBy"=>"createdDate","order"=>"DESC");
        $where=array("category ="=>6,"status ="=>"'active'");
        $blogs=$this->CommonModel->GetMasterListDetails('*',"blogs",$where,'','',$join=array(),$other);
        $data=array();
        $data['blogList']=$blogs;
        $data['pageTitle']="single-blog";
        $data['metaDescription']="metaDescription";
        $data['metakeywords']="metakeywords";
        $data['blog']=$singleBlog[0];
		$this->load->view('website/header',$data);
        $this->load->view('website/blog-single',$data);
        $this->load->view('website/footer');
	}
}
