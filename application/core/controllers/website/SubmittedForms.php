<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class submittedForms extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); 
        $this->load->model('CommonModel');
        // Your own constructor code
    }
	public function index()
	{
	}
    public function contactUsForm()
	{
        $this->form_validation->set_rules('enquryType', 'enquryType', 'required'); 
        $this->form_validation->set_rules('name', 'name', 'required'); 
        $this->form_validation->set_rules('email', 'email', 'required'); 
        $this->form_validation->set_rules('contactNumber','contactNumber','required');
        if($this->form_validation->run() == false)
        {
            $status['msg'] = 'Please fill all the mandatory fields.'; 
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        } 
        $this->form_validation->set_rules('contactNumber','Contact Number','trim|integer|min_length[10]|max_length[10]');
        if($this->form_validation->run() == false){

            $status['msg'] = 'Please enter valid mobile number.'; 
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }
        $userDetails=array();
        $userDetails['enquryType']=$this->input->post('enquryType');
        $userDetails['fullName']=$this->input->post('name');
        $userDetails['email']=$this->input->post('email');
        $userDetails['contactNo']=$this->input->post('contactNumber');
        $userDetails['message']=$this->input->post('message');
        $userDetails['createdDate']=Date("Y-m-d");
        $isupdated = $this->CommonModel->saveMasterDetails("ab_contactus",$userDetails);
        if($isupdated)
        {
            $status['msg'] = 'Thank you for connecting with us. We will conatct you soon.'; 
            $status['flag'] = 'S';
            // $status['redirect'] = base_url()."/login";
            echo json_encode($status); exit;
        }else
        {
            $status['msg'] = 'Somthing Went Wrong. Try Again.'; 
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }
	}
}