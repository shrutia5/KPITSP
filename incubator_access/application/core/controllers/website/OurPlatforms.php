<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OurPlatforms extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
	public function index()
	{
		$this->load->view('website/header');
        $this->load->view('website/our-platforms');
        $this->load->view('website/footer');
	}
}
