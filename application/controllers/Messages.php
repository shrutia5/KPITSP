<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CommonModel');
        $this->load->model('user');
        $this->load->library("emails");
    }
	public function index($sender,$reciever='')
	{
        $where = array("userID"=>$this->session->userdata('userId'));
        $user = $this->CommonModel->getMasterDetails('userregistration','',$where);
        if(isset($user) && !empty($user)){
            $data = array();
            
            if($user[0]->isAdmin == "yes"){
                $data['admin_id'] = $this->session->userdata('userId');
                $data['receiver_id'] = $reciever;
                $data['is_admin'] = 'y';
            
            }else{
                // student sent message to admin
                $data['sender_id'] = $this->session->userdata('userId');
                $data['receiver_id'] = 0;
                $data['is_admin'] = 'n';
            }
            //if($this->session->userdata('isAdmin') =="yes") {}
            //$data['sender_id'] = $this->session->userdata('userId');
            // $data['receiver_read'] = 0;
           $data['receiver_read'] = 'n';
           $data['sender_read'] = 'n';
            $data['message'] = $this->input->post('message');
                $data['created_date'] = date("Y-m-d h:i:s");
                $issave = $this->CommonModel->saveMasterDetails("messages",$data);
                if($issave){
                    // send notification to user
                    if($user[0]->isAdmin == "yes" && !empty($reciever)){
                        //$this->notification($reciever);
                    }
                    $status['msg'] = ''; 
                    $status['statusCode'] = 200;
                    $status['flag'] = 'S';
                    echo json_encode($status); exit;
                }else{
                    $status['msg'] = 'Someting was wrong while sending the message. Please try again'; 
                    $status['statusCode'] = 200;
                    $status['flag'] = 'F';
                    echo json_encode($status); exit;
                }
        }else{
            //error
        }
        //$msg = $this->input->post('message');
        //echo $msg;
	}
	public function send()
	{
        $where = array("userID"=>$this->session->userdata('userId'));
        $userType = $this->session->userdata('usertype');
        
        $user = $this->CommonModel->getMasterDetails('userregistration','',$where);
        if(isset($user) && !empty($user)){
            $data = array();
            
            $data['sender_id'] = $this->session->userdata('userId');
            if($userType == "Admin")
            {
                $data['by_admin'] = 'y';
            }else
            {
                // student sent message to admin
                $data['by_admin'] = 'n';
            }
            
            $data['message'] = $this->input->post('message');
            $data['project_id'] = $this->input->post('project_id');
                $data['created_date'] = date("Y-m-d h:i:s");
                $issave = $this->CommonModel->saveMasterDetails("project_messages",$data);
                if($issave){
                    // send notification to user
                    if($userType == "Admin"){
                        //$this->notification($reciever);
                    }
                    $status['msg'] = ''.date("h:i a"); 
                    $status['statusCode'] = 200;
                    $status['flag'] = 'S';
                    echo json_encode($status); exit;
                }else{
                    $status['msg'] = 'Someting was wrong while sending the message. Please try again'; 
                    $status['statusCode'] = 200;
                    $status['flag'] = 'F';
                    echo json_encode($status); exit;
                }
        }else{
            //error
        }
        //$msg = $this->input->post('message');
        //echo $msg;
	}
    public function read($sender,$reciever=''){

        $where = array("userID"=>$this->session->userdata('userId'));
        $user = $this->CommonModel->getMasterDetails('userregistration','',$where);
        if(isset($user) && !empty($user)){
            $data = array();
            $data['sender_read']= "y";
            $data['receiver_read']= "y";
            if($user[0]->userType == "Admin"){
                
                $where = array();
                $where['receiver_id = '] = "0";
                $where['sender_id = '] = $reciever;
                if($reciever !=""){
                    $update = $this->CommonModel->updateMasterDetails("messages",$data,$where);
                }
            
            }else{
                $where = array();
                $where['receiver_id = '] = $this->session->userdata('userId');
                $update = $this->CommonModel->updateMasterDetails("messages",$data,$where);
            }
        
        }
        $status['msg'] = ''; 
        $status['statusCode'] = 200;
        $status['flag'] = 'S';
        echo json_encode($status); exit;
    }

    public function notification($reciever){
       
        $where = array("tempName"=>"EmailVerification");
		$emailContent = $this->CommonModel->getMasterDetails('emailMaster','',$where);
		if(!isset($emailContent) || empty($emailContent))
		{
			$status['data'] = "";//"Email Template Not Found. 'Email Verification'";
			$status['msg'] = "Email Template Not Found. 'Email Verification'";
			$status['statusCode'] = 996;
			$status['flag'] = 'F';
			echo json_encode($status); exit;
		}
        $mailContent = str_replace("{{otp}}",$otp,$emailContent[0]->emailContent);
		$mailContent = str_replace("{{userName}}",$name,$mailContent);
		$from= $this->config->item('supportEmail');
		$to=$email;
		$subject=$emailContent[0]->subject;
		$fromName= "KPIT SHODH";  //$this->$this->fromName;
		$msg=$mailContent;
        
        return $isEmailSend=$this->emails->sendMailDetails($from,$fromName,$to,$cc='',$bcc='',$subject,$msg);
    }
}

?>