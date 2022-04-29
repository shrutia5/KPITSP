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
	public function index()
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Mentor");
        $join = array();
        $join[1]['type'] ="LEFT JOIN";
        $join[1]['table']="master_sub_category";
        $join[1]['alias'] ="sc";
        $join[1]['key1'] ="subCategoryID";
        $join[1]['key2'] ="sub_cat_id";

        $join[2]['type'] ="LEFT JOIN";
        $join[2]['table']="master_category";
        $join[2]['alias'] ="c";
        $join[2]['key1'] ="categoryID";
        $join[2]['key2'] ="category_id";
        $selectc = "t.*,sc.sub_cat_name,c.category_name";
         $wherefinalists=array("t.status ="=>"'active'","t.phaseThreeStatus="=>"'top50'");
         $finalists = $this->CommonModel->GetMasterListDetails($selectc,'project_master',$wherefinalists,'','', $join,'');
        //print_r($finalists);exit;

        $data=array();
        if(isset($finalists) && !empty($finalists)){
            $data['finalists'] = $finalists;
                //print_r($data['finalists']);exit;
                
            }else{
                $data['finalists'] = "";
            }
     
        $data['pageTitle']="KPIT sparkle | Mentor Dashboard";
        $data['metaDescription']="Mentor Dashboard";
        $data['metakeywords']="KPIT sparkle Mentor Dashboard";
        $this->load->view('mentor/men_header',$data);
        $this->load->view('mentor/men_dashborad');
        $this->load->view('mentor/men_footer');
	}
   
    public function resetpassword()
	{
        if(empty($this->session->userdata('tmpUserId'))){
            redirect("login");
            exit;
        }
        $this->CommonModel->validateUserType("Mentor");
        $data['pageTitle']="KPIT sparkle | Mentor Dashboard";
        $data['metaDescription']="Mentor Dashboard";
        $userId = $this->session->userdata('tmpUserId');

        $data['metakeywords']="KPIT sparkle Mentor Reset Password";
        $this->load->view('student/header-register',$data);
        $this->load->view('mentor/men_resetpassword',$data);
        $this->load->view('mentor/men_footer');
	}
    public function updatePassword(){
        $this->form_validation->set_rules('userPass','Password', 'required');
        $this->form_validation->set_rules('cpassword','Confirm Password', 'required');
        $this->form_validation->set_rules('menNDA','Mentor NDA', 'required');
        $userId = $this->session->userdata('tmpUserId');
        //echo  $userId;exit;
        $userPass =  md5($this->input->post('userPass'));
        $cpassword =  md5($this->input->post('cpassword'));
        $menNDA =  $this->input->post('menNDA');
        //echo $userPass ." ".$cpassword." ".$menNDA;
        if($this->form_validation->run() == true){
            $arr['password'] = $userPass;
            $arr['cpassword'] = $cpassword;
            $arr['NDAaccepted']="1";
            $where = array("userID="=>$userId);
            //print_r($where);exit;
            $mentorresetpass = $this->CommonModel->updateMasterDetails('userregistration',$arr,$where);
            if(!empty($mentorresetpass)){
                $status['statusCode'] = 996;
                $status['flag'] = 'S';
                $status['msg'] = 'Password Has Been Updated';
                $status['redirect'] = base_url()."login";
                // $name = $userDetails[0]->firstname." ".$userDetails[0]->lastname;
                // $this->sendVerificationDone($name,$email);
                echo json_encode($status); exit;
            }else{
                $status['statusCode'] = 996;
                $status['flag'] = 'F';
                $status['msg'] = 'Password not updated';
                //$status['redirect'] = base_url()."login";
                // $name = $userDetails[0]->firstname." ".$userDetails[0]->lastname;
                // $this->sendVerificationDone($name,$email);
                echo json_encode($status); exit;
            }
        }
    }

    public function projectdetails($id)
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Mentor");

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
                // print_r($projectd);exit;
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

            // $wherecategory =array("status="=>'active');
            // $categoryList = $this->CommonModel->GetMasterListDetails('','master_category',$wherecategory,'','','','');

            // if(isset($categoryList)&& !empty($categoryList))
            //     {
            //          $data['categoryList']= $categoryList;
            //          //print_r($categoryList[0]);exit;
            //     }else{
            //         $data['categoryList'] = "";
            //     }
        // print_r($prodetail);exit;
        $data["projectDetail"]="Mentor";
        $data['pageTitle']="KPIT sparkle |Mentor Dashboard";
        $data['metaDescription']="Mentor Dashboard";
        $data['metakeywords']="KPIT sparkle Mentor Reset Password";
        $this->load->view('mentor/men_header',$data);
        $this->load->view('evaluator/eva_project-details',$data);
        $this->load->view('mentor/men_footer');
	}
  
}