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
       
        $this->CommonModel->validateUserType("Jury");
        if(isset($_GET['filterOption']) && !empty($_GET['filterOption'])){
            $filterData = $_GET['filterOption'];  
            //print  $filterData; exit;   
            if($filterData == "All"){
                $jurywherefinalists=array("t.status ="=>"'active'","t.phaseThreeStatus in ('50'"=>",'Between_100-200')");
                $juryFinalists = $this->CommonModel->GetMasterListDetails('','project_master',$jurywherefinalists,'','','',''); 
            }else{
                $jurywherefinaliststop10=array("t.status ="=>"'active'","juryAction="=>"'Top 10'");
                $juryFinalists = $this->CommonModel->GetMasterListDetails('','project_master',$jurywherefinaliststop10,'','','','');
            }
        }else{
            $jurywherefinalists=array("t.status ="=>"'active'","t.phaseThreeStatus in ('50'"=>",'Between_100-200')");
            $juryFinalists = $this->CommonModel->GetMasterListDetails('','project_master',$jurywherefinalists,'','','','');
        }
        if(isset($juryFinalists) && !empty($juryFinalists)){
             $data['juryFinalists'] = $juryFinalists;
            foreach ($juryFinalists as $key => $juryvalue) {
                //print_r($juryvalue);
                $join = array();
                $join[0]['type'] ="LEFT JOIN";
                $join[0]['table']="userregistration";
                $join[0]['alias'] ="u";
                $join[0]['key1'] ="memberID";
                $join[0]['key2'] ="userID";
                $selectm = "t.*,u.firstname,u.lastName";
                $ProjectId = $juryvalue->projectID;
                $wheremem = array("t.projectID="=> $ProjectId);
                $jurymem =  $this->CommonModel->GetMasterListDetails($selectm,'membersdetails',$wheremem,'','',$join,'');
                //print_r($jurymem); 
                if(isset($jurymem) && !empty($jurymem))
                {
                    $juryFinalists[$key]->jurymem =$jurymem;   
                }
                else{
                    $juryFinalists[$key]->jurymem = "";
                }
                // echo "<pre>";
                // print_r($juryFinalists); 
            }//exit;
        }else{
            $data['juryFinalists']="";
        }
        $data['pageTitle']="KPIT sparkle | Jury Dashboard";
        $data['metaDescription']="Jury Dashboard";
        $data['metakeywords']="KPIT sparkle Jury Dashboard";
        $this->load->view('jury/header',$data);
        $this->load->view('jury/dashboard',$data);
        $this->load->view('jury/footer');
	}
    public function resetpassword(){
        $data['pageTitle']="KPIT sparkle | Jury Dashboard";
        $data['metaDescription']="Jury Dashboard";
        $data['metakeywords']="KPIT sparkle Jury Dashboard";
        $this->load->view('student/header-register',$data);
        $this->load->view('jury/jury_resetpassword',$data);
        $this->load->view('student/footer');
    }
    public function updatePassword(){
        $this->form_validation->set_rules('userPass', 'password', 'required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');
        $this->form_validation->set_rules('juryNDA', 'Jury NDA', 'required');
        $userID = $this->session->userdata('tmpUserId');
        $userPass = md5($this->input->post('userPass'));
        $cuserPass = md5($this->input->post('cpassword'));
        //echo  $userPass .''. $cuserPass;exit;
        if($this->form_validation->run() == true){
            $arr['password']=$userPass;
            $arr['cpassword']=$cuserPass;
            $arr['NDAaccepted']='1';
             $wherejuryresetpass = array("userID="=>$userID);
             $juryresetpass = $this->CommonModel->updateMasterDetails('userregistration',$arr,$wherejuryresetpass);
             if(!empty($juryresetpass)){
                $status['statusCode'] = 996;
                $status['flag'] = 'S';
                $status['msg'] = 'Password Has Been Updated';
                $status['redirect'] = base_url()."login";
                echo json_encode($status); exit;
             }else{
                $status['statusCode'] = 996;
                $status['msg'] = "Password Not Updated";
                $status['flag'] = 'F';
                echo json_encode($status); exit;
             }
        }
    }

    public function projectDetails($id){
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Jury");
        $join = array();
        $join[0]['type'] ="LEFT JOIN";
        $join[0]['table']="userregistration";
        $join[0]['alias'] ="m";
        $join[0]['key1'] ="memberID";
        $join[0]['key2'] ="userID";
        $select1="t.*,m.firstname,m.lastName,m.phoneNumber,m.email";
        $userid = $this->session->userdata('userId');
        $where1=array("t.projectID="=>$id);
             // print_r($where1); 
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
        //    print_r($trlquestion);exit;
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
               // print_r($where2);
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
        $data["projectDetail"]="jury";
        $data['pageTitle']="KPIT sparkle |Jury Dashboard";
        $data['metaDescription']="Jury Dashboard";
        $data['metakeywords']="KPIT sparkle Jury Reset Password";
        $this->load->view('jury/header',$data);
        $this->load->view('evaluator/eva_project-details',$data);
        $this->load->view('jury/footer');
    }
    public function selectInTop10(){

        
        $projectId = $this->input->post('projectId');
        $jurysatus = $this->input->post('jurysatus');
    //echo $jurysatus;exit;
        if($jurysatus == "Yes"){
            $jury10['juryAction'] = "Top 10";
            //echo $jury10['juryAction'];
            $juryacwhere = array("projectID="=> $projectId);
            $juryTop10List = $this->CommonModel->updateMasterDetails('project_master',$jury10,$juryacwhere);
        }elseif($jurysatus == "No"){
            $jury10['juryAction'] = "";
            //echo $jury10['juryAction'];
            $juryacwhere = array("projectID="=> $projectId);
            $juryTop10List = $this->CommonModel->updateMasterDetails('project_master',$jury10,$juryacwhere);
        }
        
        if(!empty($juryTop10List)){
            $status['statusCode'] = 996;
            $status['flag'] = 'S';
            if($jurysatus == "Yes"){
                $status['msg'] = "Project in Top 10";
            }elseif($jurysatus == "No"){
                $status['msg'] = "Project remove from Top 10";
            }
            echo json_encode($status); exit;
        }else{
            $status['flag'] = 'F';
            $status['msg'] = "Project";
            echo json_encode($status); exit;
        }
    }
}
