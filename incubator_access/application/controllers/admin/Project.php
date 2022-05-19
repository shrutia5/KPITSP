<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); 
        $this->load->model('CommonModel');
        $this->load->library("Emails");
        //$this->CommonModel->validateUserType("Admin");
        // Your own constructor code
    }

public function projectDetails($id)
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }

        $join = array();
        $join[0]['type'] ="LEFT JOIN";
        $join[0]['table']="userregistration";
        $join[0]['alias'] ="m";
        $join[0]['key1'] ="memberID";
        $join[0]['key2'] ="userID";
        $select1="t.*,m.firstname,m.lastName,m.phoneNumber,m.email";
             $userid = $this->session->userdata('userId');
              $where1=array("t.projectID="=>$id);
            //   print_r($where1); 
            $memberdetails = $this->CommonModel->GetMasterListDetails($select1,'membersdetails',$where1,'','',$join,'');
           $wherep = array("projectID="=>$id);
           $teamp = $this->CommonModel->GetMasterListDetails('','project_master',$wherep,'','','','');
           $userIDteam = $teamp[0]->userID;
           $whereut = array("userID="=>$userIDteam);
           $userTeam = $this->CommonModel->GetMasterListDetails('','userregistration',$whereut,'','','','');
           //print_r($userTeam);exit;
            //print_r($memberdetails);exit;
            if(!empty($memberdetails)){
            $muserId = $memberdetails[0]->userID;
            //echo $muserId;exit;
            $wherelead =array("userID="=>$muserId);
            $teamlead = $this->CommonModel->GetMasterListDetails('','userregistration',$wherelead,'','','','');
            }

            
                if(isset($memberdetails)&& !empty($memberdetails))
                {
                     $data['memberdetails']= $memberdetails;
                     //echo $memberdetails[0]->firstname;exit;
                }else{
                    $data['memberdetails'] = "";
                //echo "null";exit;
                }
                if(isset($userTeam)&& !empty($userTeam))
            {
                 $data['userTeam']= $userTeam;
                 //echo $userTeam[0]->firstname;exit;
            }else{
                $data['userTeam'] = "";
            //echo "null";exit;
            }
                if(isset($teamlead)&& !empty($teamlead))
                {
                     $data['teamlead']= $teamlead[0];
                     //echo $teamlead[0]->firstname;exit;
                }else{
                    $data['teamlead'] = "";
                //echo "null";exit;
                }
                
                $join1 = array();
                $join1[0]['type'] ="LEFT JOIN";
                $join1[0]['table']="master_category";
                $join1[0]['alias'] ="mc";
                $join1[0]['key1'] ="categoryID";
                $join1[0]['key2'] ="category_id";
                
                $join1[1]['type'] ="LEFT JOIN";
                $join1[1]['table']="master_sub_category";
                $join1[1]['alias'] ="msc";
                $join1[1]['key1'] ="subCategoryID";
                $join1[1]['key2'] ="sub_cat_id";
                $where = array("t.projectID="=>$id);
                $select = "t.*,mc.category_name,msc.sub_cat_name";
                $projectd= $this->CommonModel->GetMasterListDetails($select,'project_master',$where,'','',$join1,'');
                //print_r($projectd);exit;
                if(isset($projectd)&& !empty($projectd))
                {
                     $data['projectd']= $projectd[0];
                     //print_r($projectd[0]);exit;
                }else{
                    $data['projectd'] = "";
                }

               
             
              $where2=array("status ="=>"'active'");
            //   print_r($where1); 
            $trlquestion = $this->CommonModel->GetMasterListDetails('','trl_questions',$where2,'','','',array('orderBy'=>'trlLevelID', 'order'=>'ASC'));
        //   print_r($trlquestion[0]->qName);exit;
        //     print_r($trlquestion);exit;
                if(isset($trlquestion)&& !empty($trlquestion))
                {
                     $data['trlquestion']= $trlquestion;
                     //echo $trlquestion[0]->firstname;exit;
                }else{
                    $data['trlquestion'] = "";
                //echo "null";exit;
                }

                //  $join2 = array();
                // $join2[0]['type'] ="LEFT JOIN";
                // $join2[0]['table']="userregistration";
                // $join2[0]['alias'] ="m";
                // $join2[0]['key1'] ="memberID";
                // $join2[0]['key2'] ="userID";
                // $select1="t.*,m.firstname,m.lastName";
                $where2 = array("projectID="=>$id);
                $trlqueans= $this->CommonModel->GetMasterListDetails('','trl_users_question_answers',$where2,'','','','');
                // echo "<pre>";
                // print_r($trlqueans);exit;
                // echo "</pre>";
                if(isset($trlqueans)&& !empty($trlqueans))
                {
                     $data['trlqueans']= $trlqueans;
                     //print_r($trlqueans[0]);exit;
                }else{
                    $data['trlqueans'] = "";
                }
                
        $whereMsg =array("t.project_id="=>$id);
        $joinMsg = array();
        $joinMsg[0]['type'] ="LEFT JOIN";
        $joinMsg[0]['table']="userregistration";
        $joinMsg[0]['alias'] ="u";
        $joinMsg[0]['key1'] ="sender_id";
        $joinMsg[0]['key2'] ="userID";
        
        $selectMsg ="t.*,u.firstname,u.lastName,u.status";
        $projectsMessages = $this->CommonModel->GetMasterListDetails($selectMsg,'project_messages',$whereMsg,'','',$joinMsg,'');
        $data['projectsMessages'] = $projectsMessages;
        $data['pageTitle']="KPIT sparkle | Admin Project Deatils";
        $data['metaDescription']="Admin Project Deatils";
        $data['metakeywords']="KPIT sparkle Admin Project Details";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/project-detail',$data);
        $this->load->view('admin/footer');
	}

    public function approveProject(){
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $where = array();
        $where['projectID'] =  $this->input->post('projectid');
        $getProjectStatus = $this->CommonModel->getMasterDetails('project_master',"*",$where);
        //print_r($getProjectStatus);exit;
        $userID = $getProjectStatus[0]->userID;
        $whereuser['userID'] = $userID;
        //print_r($whereuser);exit;
        $getProjectStatus = $this->CommonModel->getMasterDetails('userregistration',"*",$whereuser);
        //print_r($getProjectStatus);exit;
        //print_r($where);exit;
        
        $fname = $getProjectStatus[0]->firstname;
        $lname = $getProjectStatus[0]->	lastName;
        $name = ucfirst($fname)." ".ucfirst($lname);
        $email = $getProjectStatus[0]->	email;
        //echo $name;exit;
        $projectStatus['projectStatus'] = "Approved";
        $projectStatus['currentPhase'] = 2;
        $updateProjectStatus = $this->CommonModel->updateMasterDetails("project_master", $projectStatus,$where);
        
        if( $updateProjectStatus){
            $this->CommonModel->logUserActivity("Project Approved by admin", "PROJECT_MODIFIED" , $this->input->post('projectid'));
            $msgDetails = $this->CommonModel->sendProjectTextMessage($userID, "phaseOneIdeaApproval");
            $this->sendStatusMail($this->input->post('projectid'), 'ideaSatusChanged', 'Approved');
            $status['msg'] = "Project Approved";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'S';
            //$this->sendMailForApproveProject($name,$email);
            $status['redirect'] = base_url()."admin/dashboard";
            echo json_encode($status); exit;
        }else{
            $status['msg'] = "Something was wrong while saving the data. Please try again.";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }
    }

    public function rejectProject(){
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $where = array();
        $where['projectID'] =  $this->input->post('projectid');
        //print_r($where);exit;
        $projectStatus['projectStatus'] = "Reject";
        $projectStatus['rejectionReason'] = $this->input->post('reason');
        $updateProjectStatus = $this->CommonModel->updateMasterDetails("project_master", $projectStatus,$where);
        //print_r($updateProjectStatus);exit;
        if( $updateProjectStatus){
                        
            $this->CommonModel->logUserActivity("Project Rejected by admin", "PROJECT_MODIFIED" , $this->input->post('projectid'));

            $where['projectID'] =  $this->input->post('projectid');
            $getProjectStatus = $this->CommonModel->getMasterDetails('project_master',"userID",$where);
            $userID = $getProjectStatus[0]->userID;
            $msgDetails = $this->CommonModel->sendProjectTextMessage($userID, "phaseOneIdeaRejection");
            $this->sendStatusMail($this->input->post('projectid'), 'ideaSatusChanged', 'Rejected');
            $status['msg'] = "Project Rejected";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'S';
            $status['redirect'] = base_url()."admin/dashboard";
            echo json_encode($status); exit;
        }else{
            $status['msg'] = "Something was wrong while saving the data. Please try again.";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }
    }
    

    public function holdProject(){
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $where = array();
        $where['projectID'] =  $this->input->post('projectid');
        //print_r($where);exit;
        $projectStatus['projectStatus'] = "Hold";
        $projectStatus['currentPhase'] = "1";
        $updateProjectStatus = $this->CommonModel->updateMasterDetails("project_master", $projectStatus,$where);
        //print_r($updateProjectStatus);exit;
        if( $updateProjectStatus){
            $this->CommonModel->logUserActivity("Project put on hold by admin", "PROJECT_MODIFIED" , $this->input->post('projectid'));
            $status['msg'] = "Project on Hold";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'S';
            $status['redirect'] = base_url()."admin/dashboard";
            echo json_encode($status); exit;
        }else{
            $status['msg'] = "Something was wrong while saving the data. Please try again.";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }
    }

    public function phase2approveProject(){
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $where = array();
        $where['projectID'] =  $this->input->post('projectid');
        //print_r($where);exit;
        $projectStatus['phaseTwoStatus'] = "Approved";
        $projectStatus['currentPhase'] = 3;
        $updateProjectStatus = $this->CommonModel->updateMasterDetails("project_master", $projectStatus,$where);
        //print_r($updateProjectStatus);exit;
        if( $updateProjectStatus){
            $this->CommonModel->logUserActivity("Project Approved by admin phase 2", "PROJECT_MODIFIED" , $this->input->post('projectid'));
            $this->sendStatusMail($this->input->post('projectid'), 'ideaSatusChanged', 'Approved');
            $status['msg'] = "Project Approved";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'S';
            $status['redirect'] = base_url()."admin/dashboard";
            echo json_encode($status); exit;
        }else{
            $status['msg'] = "Something was wrong while saving the data. Please try again.";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }
    }
    public function phase2rejectProject(){
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $where = array();
        $where['projectID'] =  $this->input->post('projectid');
        //print_r($where);exit;
        $projectStatus['phaseTwoStatus'] = "Reject";
        $projectStatus['rejectionReason'] = $this->input->post('reason');
        $updateProjectStatus = $this->CommonModel->updateMasterDetails("project_master", $projectStatus,$where);
        //print_r($updateProjectStatus);exit;
        if( $updateProjectStatus){
            $this->CommonModel->logUserActivity("Project Approved by admin phase 2", "PROJECT_MODIFIED" , $this->input->post('projectid'));
            $this->sendStatusMail($this->input->post('projectid'), 'ideaSatusChanged', 'Rejected');
            $status['msg'] = "Project Rejected";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'S';
            $status['redirect'] = base_url()."admin/dashboard";
            echo json_encode($status); exit;
        }else{
            $status['msg'] = "Something was wrong while saving the data. Please try again.";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }
    }

    public function phase2holdProject(){
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $where = array();
        $where['projectID'] =  $this->input->post('projectid');
        //print_r($where);exit;
        $projectStatus['phaseTwoStatus'] = "Hold";
        $updateProjectStatus = $this->CommonModel->updateMasterDetails("project_master", $projectStatus,$where);
        //print_r($updateProjectStatus);exit;
        if( $updateProjectStatus){
            $this->CommonModel->logUserActivity("Project Approved by admin phase 2", "PROJECT_MODIFIED" , $this->input->post('projectid'));
            $status['msg'] = "Project on hold";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'S';
            $status['redirect'] = base_url()."admin/dashboard";
            echo json_encode($status); exit;
        }else{
            $status['msg'] = "Something was wrong while saving the data. Please try again.";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }
    }

    public function fiftyProject(){
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $where = array();
        $where['projectID'] =  $this->input->post('projectid');
        //print_r($where);exit;
        $projectStatus['phaseThreeStatus'] = "50";
        $updateProjectStatus = $this->CommonModel->updateMasterDetails("project_master", $projectStatus,$where);
        //print_r($updateProjectStatus);exit;
        if( $updateProjectStatus){
            $this->CommonModel->logUserActivity("Project put in Top 50 by admin ", "PROJECT_MODIFIED" , $this->input->post('projectid'));
            $this->sendStatusMail($this->input->post('projectid'), 'ideaSatusChanged', 'in Top 50');
            $status['msg'] = "Project approved";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'S';
            $status['redirect'] = base_url()."admin/dashboard";
            echo json_encode($status); exit;
        }else{
            $status['msg'] = "Something was wrong while saving the data. Please try again.";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }
    }

    public function bottomfiftyProject(){
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $where = array();
        $where['projectID'] =  $this->input->post('projectid');
        //print_r($where);exit;
        $projectStatus['phaseThreeStatus'] = "bottom50";
        $updateProjectStatus = $this->CommonModel->updateMasterDetails("project_master", $projectStatus,$where);
        //print_r($updateProjectStatus);exit;
        if( $updateProjectStatus){
            $this->CommonModel->logUserActivity("Project put in Bottom 50 by admin ", "PROJECT_MODIFIED" , $this->input->post('projectid'));
            $status['msg'] = "Project on hold";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'S';
            $status['redirect'] = base_url()."admin/dashboard";
            echo json_encode($status); exit;
        }else{
            $status['msg'] = "Something was wrong while saving the data. Please try again.";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }
    }

    public function twohunProject(){
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $where = array();
        $where['projectID'] =  $this->input->post('projectid');
        //print_r($where);exit;
        $projectStatus['phaseThreeStatus'] = "200";
        $updateProjectStatus = $this->CommonModel->updateMasterDetails("project_master", $projectStatus,$where);
        //print_r($updateProjectStatus);exit;
        if( $updateProjectStatus){
            $this->CommonModel->logUserActivity("Project put in 200 by admin ", "PROJECT_MODIFIED" , $this->input->post('projectid'));
            $status['msg'] = "Project Rejected";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'S';
            $status['redirect'] = base_url()."admin/dashboard";
            echo json_encode($status); exit;
        }else{
            $status['msg'] = "Something was wrong while saving the data. Please try again.";
            $status['statusCode'] = 400;
            $status['data'] =array();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }
    }
    
    public function sendStatusMail($projectID, $templateName, $status){
        
        $where=array("tempName"=>$templateName);
        
        $tempData = $this->CommonModel->getMasterDetails('emailMaster','',$where);
        
        if(isset($tempData)&& !empty($tempData)){
            $join = array();
            $join[0]['type'] ="LEFT JOIN";
            $join[0]['table']="userregistration";
            $join[0]['alias'] ="m";
            $join[0]['key1'] ="userID";
            $join[0]['key2'] ="userID";
            $select1="m.firstname,m.lastName,m.phoneNumber,m.email,rejectionReason";
            $userid = $this->session->userdata('userId');
            $where1=array("t.projectID="=>$projectID);
                
            $memberdetails = $this->CommonModel->GetMasterListDetails($select1,'project_master',$where1,'','',$join,'');
            
            if(isset($memberdetails)&& !empty($memberdetails) && !empty($memberdetails[0]->email)){
                $this->load->library("Emails");
                $data['memberdetails']= $memberdetails;
                $mailContent = str_replace("{{userName}}",$memberdetails[0]->firstname." ".$memberdetails[0]->lastName, $tempData[0]->emailContent);
                $mailContent=str_replace("{{status}}", $status, $mailContent);
                
                $rejectionReason = "";
                if($status=="Rejected"){
                    $rejectionReason = $memberdetails[0]->rejectionReason;
                }
                $mailContent=str_replace("{{reason}}", $rejectionReason, $mailContent);

                $subject=$tempData[0]->subject;
                $subject=str_replace("{{status}}", $status, $tempData[0]->subject);
                $msg=$mailContent;
                $to=$memberdetails[0]->email;
                $isEmailSend=$this->emails->sendMailDetails($to,$cc='',$bcc='',$subject,$msg);
            }
        }
    }
}