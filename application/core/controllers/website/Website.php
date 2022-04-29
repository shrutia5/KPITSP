<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->library('form_validation'); 
        $this->load->model('CommonModel');
    }
	public function index()
	{
		$this->load->view('website/header');
        $this->load->view('website/home');
        $this->load->view('website/footer');
	}
    public function aboutUs()
	{
		$this->load->view('website/header');
        $this->load->view('website/about-us');
        $this->load->view('website/footer');
	}
    public function contactUs()
	{
		$this->load->view('website/header');
        $this->load->view('website/contact-us');
        $this->load->view('website/footer');
	}
	public function contactUsForm()
	{

        $this->form_validation->set_rules('enquryType', 'enquryType', 'required'); 
        $this->form_validation->set_rules('name', 'Name', 'required'); 
        $this->form_validation->set_rules('email', 'Email', 'required'); 
        if($this->form_validation->run() == false)
        {
            $status['msg'] = 'Please fill all the mandatory fields.'; 
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        } 
        $enquryType=$this->input->post('enquryType');
        if($enquryType=="Student")
        {
            $this->form_validation->set_rules('contactNumber','contactNumber','required');
            $this->form_validation->set_rules('contactNumber','Contact Number','trim|integer|min_length[10]|max_length[10]');
            if($this->form_validation->run() == false){

                $status['msg'] = 'Please enter valid mobile number.'; 
                $status['statusCode'] = validation_errors();
                $status['flag'] = 'F';
                echo json_encode($status); exit;
            }

        }else
        {
            $this->form_validation->set_rules('conReason', 'conReason', 'required'); 
            if($this->form_validation->run() == false){
                $status['msg'] = 'Please fill all the mandatory fields'; 
                $status['statusCode'] = validation_errors();
                $status['flag'] = 'F';
                echo json_encode($status); exit;
            }
        }

        if(!$this->input->post('g-recaptcha-response'))
        {
           $status['msg'] = "Catpcha Not Verified"; 
           $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }else
        {
            $secKey="6LeK_UocAAAAAPLz7igmepUEDqt7QsnTzK9Owpof";
            $ip=$_SERVER['REMOTE_ADDR'];
            $response=$this->input->post('g-recaptcha-response');
            $url="https://www.google.com/recaptcha/api/siteverify?secret=$secKey&response=$response&remoteip=$ip";
            $fire=file_get_contents($url);
            $data=json_decode($fire);
            // print_r($data->success);exit;
            if(!$data->success)
            {
                $status['msg'] = "Captcha Not Verified!"; 
                $status['statusCode'] = validation_errors();
                $status['flag'] = 'F';
                echo json_encode($status); exit;
            }
        }


        $userDetails=array();
        $userDetails['enquryType']=$this->input->post('enquryType');
        $userDetails['fullName']=$this->input->post('name');
        $userDetails['email']=$this->input->post('email');
        $userDetails['contactNo']=$this->input->post('contactNumber');
        $userDetails['reasonOfCon']=$this->input->post('conReason');
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
