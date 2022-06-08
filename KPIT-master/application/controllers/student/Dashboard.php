<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); 
        $this->load->model('CommonModel');
        // Your own constructor code
    }

    function updateguide($section) {

        $guideStatusData = array();
        $userID = $this->session->userdata['userId'];
        $guideStatusData['userId'] = $userID;
        
        if($section == 'student_dashboard') {
            $guideStatusData['std_dashboard'] = 'Y';
        }
        else if($section == 'student_submitidea') {
            $guideStatusData['std_submitidea'] = 'Y';
        }
        else if($section == 'student_profile') {
            $guideStatusData['std_myaccount'] = 'Y';
        }
        else if($section == 'student_project') {
            $guideStatusData['std_project'] = 'Y';
        }

        $whereuser=array("userID="=>$userID);
        $saveguidedstatus = $this->CommonModel->updateMasterDetails('guidedstatus', $guideStatusData, $whereuser);
    }

	public function index()
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        
        $this->CommonModel->validateUserType("User");
        $join = array();$data=array();
        $infoData = $this->CommonModel->GetMasterListDetails("*",'infoSettings',array(),'','',$join,'');

        $data['infoSetting'] =$infoData[0];
           
            $join[0]['type'] ="LEFT JOIN";
            $join[0]['table']="master_category";
            $join[0]['alias'] ="c";
            $join[0]['key1'] ="categoryID";
            $join[0]['key2'] ="category_id";
    
            $join[1]['type'] ="LEFT JOIN";
            $join[1]['table']="master_sub_category";
            $join[1]['alias'] ="sc";
            $join[1]['key1'] ="subCategoryID";
            $join[1]['key2'] ="sub_cat_id";
            
             $select1="t.*,c.category_name,sc.sub_cat_name";
             //print_r($select1);exit;
             $userID=$this->session->userdata('userId');
             $where1=array("t.status ="=>"'active'","t.userID="=>$userID);
             //print_r($where1);exit;
          
            $adminData1 = $this->CommonModel->GetMasterListDetails($select1,'project_master',$where1,'','',$join,'');
            
                if(isset($adminData1)&& !empty($adminData1))
                {
                     $data['adminData1'] = $adminData1[0];
                    //print_r($data['adminData1']);exit;
                    
                }else{
                    $data['adminData1'] = "";
                }
                
            
        $join = array();
        $join[0]['type'] ="INNER JOIN";
        $join[0]['table']="userregistration";
        $join[0]['alias'] ="u";
        $join[0]['key1'] ="userID";
        $join[0]['key2'] ="userID";

        $join[1]['type'] ="INNER JOIN";
        $join[1]['table']="project_master";
        $join[1]['alias'] ="p";
        $join[1]['key1'] ="projectID";
        $join[1]['key2'] ="projectID";
        
        $select="p.*,u.firstname,u.lastName,u.status";
        $where1=array("t.memberID="=>$userID);
        $teamProjects = $this->CommonModel->GetMasterListDetails($select,'membersdetails',$where1,'','',$join,'');
        $data['teamProjects'] = $teamProjects;

        $whereuserid=array("userID="=>$userID);
        $infoGuidedData = $this->CommonModel->GetMasterListDetails("*",'guidedstatus',$whereuserid,'','',array(),'');        

        // $where=array("userID"=>$this->session->userdata('userId'),"status"=>"active");
        // $data['ideaDetails']=$this->CommonModel->getMasterDetails('project_master',"*",$where);
        // $data['pageTitle']="KPIT-SHODH | Student Dashboard";
        // $data['metaDescription']="Student Dashboard";
        // $data['metakeywords']="KPIT-SHODH Student Dashboard";
       

        $data['pageTitle']="KPIT sparkle | Student Dashboard";
        $data['metaDescription']="Student Dashboard";
        $data['metakeywords']="KPIT sparkle Student Dashboard";
        $data['infoGuidedData']=$infoGuidedData;
        $this->load->view('student/header',$data);
        $this->load->view('student/dashboard',$data);
        //$this->load->view('student/project-details',$data);
        $this->load->view('student/footer');
	}

    public function finalIdea(){
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }

        $userid = $this->session->userdata('userId');
        $msgDetails = $this->CommonModel->sendProjectTextMessage($userid, "phaseOneIdeaSubmissionCompletion");

        $data['pageTitle']="KPIT sparkle | Student Dashboard";
        $data['metaDescription']="Student Dashboard";
        $data['metakeywords']="KPIT sparkle Student Dashboard";
        $this->load->view('student/header',$data);
        $this->load->view('student/final',$data);
        $this->load->view('student/footer');
    }

   
}