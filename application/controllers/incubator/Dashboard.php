<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); 
        $this->load->model('CommonModel');
        $this->load->library("emails");
        // Your own constructor code
       
    }
	public function index()
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        
        $userID = $this->session->userdata('userId');
        $this->CommonModel->validateUserType("Incubator");
        $type = $this->input->get("type");
        //$wherefinalists=array("t.status ="=>"'active'","t.phaseThreeStatus in ('50'"=>",'Between_100-200')");
       
        if(isset($type) && !empty($type)){
            switch ($type) {
                case 'top':
                {
                    $wherefinalists['phaseTwoStatus'] = " = 'Approved'";
                    break;
                }
                case 'finalist':
                {
                    $wherefinalists['phaseThreeStatus'] = "= '50'";
                    break;
                }
                case 'kpitSelect':
                    {
                        $wherefinalists['kpitSelect'] = "= 'yes'";
                        break;
                    }
                default:{
                    
                }
            }
        }
        $wherefinalists=array("shareWithIncubator ="=>"'Yes'");
        $join = array();
        $join[0]['type'] ="LEFT JOIN";
        $join[0]['table']="userregistration";
        $join[0]['alias'] ="inc";
        $join[0]['key1'] ="incubatorId";
        $join[0]['key2'] ="userID";

        // category
        $join[1]['type'] ="LEFT JOIN";
        $join[1]['table']="master_category";
        $join[1]['alias'] ="mc";
        $join[1]['key1'] ="categoryID";
        $join[1]['key2'] ="category_id";

        // subcategory
        $join[2]['type'] ="LEFT JOIN";
        $join[2]['table']="master_sub_category";
        $join[2]['alias'] ="sc";
        $join[2]['key1'] ="subCategoryID";
        $join[2]['key2'] ="sub_cat_id";

        $select ="t.*,mc.category_name,sc.sub_cat_name,inc.firstname as incubator_name";
        $finalists = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherefinalists,'','',$join,'');
        //print_r($finalists);exit;

        $data=array();
        if(isset($finalists) && !empty($finalists)){
            $data['finalists'] = $finalists;
                //print_r($data['finalists']);exit;
                
            }else{
                $data['finalists'] = "";
            }
            $wherecategory =array("status="=>"'active'");
            $categoryList = $this->CommonModel->GetMasterListDetails('','master_category',$wherecategory,'','','','');

            if(isset($categoryList)&& !empty($categoryList))
                {
                    $data['categoryList']= $categoryList;
                    foreach ($categoryList as $key => $categoryId) {
                        $category = $categoryId->category_id;
                        $wheresubcate=array("category_id="=>$category);
                        $subCategoryList = $this->CommonModel->GetMasterListDetails('','master_sub_category',$wheresubcate,'','','','');
                        if(isset($subCategoryList) && !empty($subCategoryList))
                        {
                            $categoryList[$key]->subCategoryList =$subCategoryList;
                        }
                        else{
                            $categoryList[$key]->subCategoryList = "";
                        }
                    }
                }else{
                    $data['categoryList'] = "";
                }
                $data['type'] = $type;   
            $data['menuName'] = "sparkle2021";
            $data['pageTitle']="KPIT sparkle | Incubator Dashboard";
            $data['metaDescription']="Incubator Dashboard";
            $data['metakeywords']="KPIT sparkle Incubator Dashboard";
            $this->load->view('incubator/incu_header',$data);
            $this->load->view('incubator/incu_dashboard',$data);
            $this->load->view('incubator/incu_footer');
	}
    public function sparkle2020()
	{

        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Incubator");
        $data['menuName'] = "sparkle2020";
        $data['pageTitle']="KPIT sparkle | incubator Dashboard";
        $data['metaDescription']="incubator Dashboard";
        $data['metakeywords']="KPIT sparkle incubator Dashboard";
        $this->load->view('incubator/incu_header',$data);
        $this->load->view('incubator/incu_sparkle2020',$data);
        $this->load->view('incubator/incu_footer');
	}

    public function sparkle2019()
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Incubator");
        $data['menuName'] = "sparkle2019";
        $data['pageTitle']="KPIT sparkle | Admin Dashboard";
        $data['metaDescription']="incubator Dashboard";
        $data['metakeywords']="KPIT sparkle Admin Dashboard";
        $this->load->view('incubator/incu_header',$data);
        $this->load->view('incubator/incu_sparkle2019',$data);
        $this->load->view('incubator/incu_footer');
	}


    public function resetpassword()
	{
        if(empty($this->session->userdata('tmpUserId'))){
            redirect("login");
            exit;
        }
        $data['pageTitle']="KPIT sparkle | Evaluator Dashboard";
        $data['metaDescription']="Evaluator Dashboard";
        $userId = $this->session->userdata('tmpUserId');

        $data['metakeywords']="KPIT sparkle incubator Reset Password";
        $this->load->view('student/header-register',$data);
        $this->load->view('incubator/incu_resetpassword',$data);
        $this->load->view('incubator/incu_footer');
	}

    public function projectdetails($id)
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Incubator");
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
        $data["projectDetail"]="incubator";
        $data['pageTitle']="KPIT sparkle |Incubator Dashboard";
        $data['metaDescription']="Incubator Dashboard";
        $data['metakeywords']="KPIT sparkle Incubator Reset Password";
        $this->load->view('incubator/incu_header',$data);
        $this->load->view('evaluator/eva_project-details',$data);
        $this->load->view('incubator/incu_footer');
	}

    public function incubateStatus()
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Incubator");

        $userid = $this->session->userdata('userId');
        $incubateAction= $this->input->post('incubateAction');
        $incubateId= $this->input->post('incubateId');
        
        $where = array("projectID="=>$incubateId, "userID="=> $userid);
        $isIncubated = $this->CommonModel->GetMasterListDetails('projectID','project_incubation',$where,'','','','');
        $flag = "S";
        if($incubateAction=="Remove" && !empty($isIncubated)){
            $flag = "F";
        }

        $status['statusCode'] = 996;
        $status['flag'] = $flag;
        $status['msg'] = "Project already selected";
        
        echo json_encode($status); exit;
	}
    public function incubateAction()
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Incubator");

        $userid = $this->session->userdata('userId');
        $incubateAction= $this->input->post('incubateAction');
        $incubateId= $this->input->post('incubateId');
        // echo $incubateAction."id=".$incubateId;exit;
        $arr["incubateAction"] = $incubateAction;
        $arr["incubatorId"] = $userid;
        $where = array("projectID ="=> $incubateId);
        // print_r($where);
        // print_r($arr);exit;
        
        $incubatData = array("projectID"=>$incubateId, "userID"=> $userid);
        
        if($incubateAction=="Remove"){
            $incubatData["incubationDate"] = date("Y-m-d");
            //print_r($incubatData);
            $isSave=$this->CommonModel->saveMasterDetails('project_incubation', $incubatData);
        }else{
            $this->CommonModel->deleteMasterDetails('project_incubation', $incubatData, '');
        }
        

        $updateAction = $this->CommonModel->updateMasterDetails('project_master',$arr,$where);
        // print_r($updateAction);
        if(!empty($updateAction)){
            $status['data'] = "";//"Email Template Not Found. 'Email Verification'";
            $status['statusCode'] = 996;
            $status['flag'] = 'S';
            // $status['redirect'] = base_url()."incubator/dashboard";
            echo json_encode($status); exit;
        }
	}
    public function updatePassword(){
        $this->form_validation->set_rules('userPass','Password', 'required');
        $this->form_validation->set_rules('cpassword','Confirm Password', 'required');
        $this->form_validation->set_rules('incuNDA','Incubator NDA', 'required');
        $userId = $this->session->userdata('tmpUserId');
        $userpass = md5($this->input->post('userPass'));
        $cpassword = md5($this->input->post('cpassword'));
        $incuNDA = $this->input->post('incuNDA');
        //echo   $userId.' '.$userpass.' '.$cpassword.' '.$incuNDA;exit;
        if($this->form_validation->run() == true){
            $arr['password'] = $userpass;
            $arr['cpassword'] = $cpassword;
            $arr['NDAaccepted']='1';
            $where = array("userID="=> $userId);
            $userDetails = $this->CommonModel->GetMasterListDetails('firstname,password,email','userregistration',$where,'','','','');
            if(!empty($userDetails)){
                if($userpass != $userDetails[0]->password){

                    $incuresetpass = $this->CommonModel->updateMasterDetails('userregistration',$arr,$where);
                    if(!empty($incuresetpass)){
        
                        if($incuNDA==1){
                            
                            $whereEmail = array("tempName"=>"incubatorNDA");
                            $emailContent = $this->CommonModel->getMasterDetails('emailMaster','',$whereEmail);
                            if(!empty($emailContent) && !empty($userDetails))
                            {
                                $mailContent = str_replace("{{username}}",$userDetails[0]->firstname,$emailContent[0]->emailContent);
                                
                                $from= $this->config->item('supportEmail');
                                $cc= $this->config->item('CCEmail');
                                $to=$userDetails[0]->email;
                                $subject=$emailContent[0]->subject;
                                $fromName= "KPIT Sparkle";  //$this->$this->fromName;
                                $msg=$mailContent; 
                                
                                $isEmailSend=$this->emails->sendMailDetails($to,$cc=$from,$bcc='',$subject,$msg);
                            }
                        }
        
                        $status['statusCode'] = 996;
                        $status['flag'] = 'S';
                        $status['msg'] = "Password Has Been Updated";
                        $status['redirect'] = base_url()."login";
                        echo json_encode($status); exit;
                    }else{
                        $status['statusCode'] = 996;
                        $status['flag'] = 'F';
                        $status['msg']= "Password Not Updated";
                        echo json_encode($status); exit;
                    }
                }else{
                    $status['statusCode'] = 996;
                    $status['flag'] = 'F';
                    $status['msg']= "Use different password";
                    echo json_encode($status); exit;
                }
            }else{
                $status['statusCode'] = 996;
                $status['flag'] = 'F';
                $status['msg']= "Password Not Updated";
                echo json_encode($status); exit;
            }
            exit;

        }
    }
   
  
}