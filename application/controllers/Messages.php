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
            date_default_timezone_set('Asia/Kolkata');
            $data['message'] = $this->input->post('message');
            $data['project_id'] = $this->input->post('project_id');
                $data['created_date'] = date("Y-m-d H:i:s");
                $issave = $this->CommonModel->saveMasterDetails("project_messages",$data);
                if($issave){
                    // send notification to user
                    if($userType == "Admin"){

                        // message to team leader
                        $join = array();
                        $join[0]['type'] ="LEFT JOIN";
                        $join[0]['table']="userregistration";
                        $join[0]['alias'] ="m";
                        $join[0]['key1'] ="userID";
                        $join[0]['key2'] ="userID";
                        $whereProject = array("projectID="=>$data['project_id']);
                        $select1="m.firstname,m.lastName,m.email";
                        $membersQ = $this->CommonModel->GetMasterListDetails($select1,'project_master',$whereProject,'','',$join,'');
                        if(!empty($membersQ)){
                            foreach($membersQ as $member){
                                $this->notification($member->firstname, $member->email);
                            }
                        }

                        // message to team member
                        $join = array();
                        $join[0]['type'] ="LEFT JOIN";
                        $join[0]['table']="userregistration";
                        $join[0]['alias'] ="m";
                        $join[0]['key1'] ="memberID";
                        $join[0]['key2'] ="userID";
                        $whereProject = array("projectID="=>$data['project_id']);
                        $select1="m.firstname,m.lastName,m.email";
                        $membersQ = $this->CommonModel->GetMasterListDetails($select1,'membersdetails',$whereProject,'','',$join,'');
                        if(!empty($membersQ)){
                            foreach($membersQ as $member){
                                $this->notification($member->firstname, $member->email);
                            }
                        }
                        
                    }
                    $status['userType'] = $userType; 
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

        $lastReadMsgId = intval($this->input->post('lastReadMsgId'));
        if(!empty($lastReadMsgId)){
            
            $projectID = intval($this->input->post('msgProjectID'));
            $whereMsg = array("userID"=>$sender, "projectID"=>$projectID);

            $msgDetails = $this->CommonModel->getMasterDetails('project_messages_read_stats','',$whereMsg);
            
            if(!empty($msgDetails)){
                $this->CommonModel->updateMasterDetails("project_messages_read_stats",array("lastReadMsgId"=>$lastReadMsgId), $whereMsg);
            }else{
                $this->CommonModel->saveMasterDetails("project_messages_read_stats",array("lastReadMsgId"=>$lastReadMsgId, "userID"=>$sender, "projectID"=>$projectID));
            }
        }
        

        $where = array("userID"=>$this->session->userdata('userId'));
        $user = $this->CommonModel->getMasterDetails('userregistration','',$where);
        if(isset($user) && !empty($user)){
            $data = array();
            $data['sender_read']= "y";
            $data['receiver_read']= "y";
            if(isset($user[0]->isAdmin) && $user[0]->isAdmin == "yes"){
                
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

    public function notification($recieverName, $recieverEmail){
       
        $where = array("tempName"=>"msgNotification");
		$emailContent = $this->CommonModel->getMasterDetails('emailMaster','',$where);
        //var_dump($emailContent);
        if(!empty($emailContent)){
            
            $from= $this->config->item('supportEmail');
            $fromName= "KPIT SHODH";  //$this->$this->fromName;

            $subject=$emailContent[0]->subject;
            $mailContent = str_replace("{{userName}}",$recieverName,$emailContent[0]->emailContent);

            return $isEmailSend=$this->emails->sendMailDetails($from,$fromName,$recieverEmail,$cc='',$bcc='',$subject,$mailContent);
        }
		/*if(!isset($emailContent) || empty($emailContent))
		{
			$status['data'] = "";//"Email Template Not Found. 'Email Verification'";
			$status['msg'] = "Email Template Not Found. 'Email Verification'";
			$status['statusCode'] = 996;
			$status['flag'] = 'F';
			echo json_encode($status); exit;
		}*/
        //$mailContent = str_replace("{{otp}}",$otp,$emailContent[0]->emailContent);
		
    }
}

?>