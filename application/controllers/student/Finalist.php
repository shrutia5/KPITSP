<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Finalist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('CommonModel');
        $this->load->model('user');
        $this->load->library("Emails");
        $this->load->library("ValidateData");
        // Your own constructor code
    }

    public function index() {
        
    }

    public function mentorDetails() {
        $data['pageTitle']="Mentor Details";
		$this->load->view('student/header-register',$data);
        $this->load->view('student/mentor-details',$data);
        $this->load->view('student/footer');
    }
    
    public function personalDetails() {
        $data['pageTitle']="Personal Details";
		$this->load->view('student/header-register',$data);
        $this->load->view('student/personal-details',$data);
        $this->load->view('student/footer');
    }
    
    public function travelDetails() {
        $data['pageTitle']="Travel Details";
		$this->load->view('student/header-register',$data);
        $this->load->view('student/travel-details',$data);
        $this->load->view('student/footer');
    }
    
    public function mentorBankDetails() {
        $data['pageTitle']="Mentor Bank Details";
		$this->load->view('student/header-register',$data);
        $this->load->view('student/mentor-bank-details',$data);
        $this->load->view('student/footer');
    }
    
    public function personalBankDetails() {
        $data['pageTitle']="Personal Bank Details";
		$this->load->view('student/header-register',$data);
        $this->load->view('student/personal-bank-details',$data);
        $this->load->view('student/footer');
    }

}