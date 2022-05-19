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
        
        $this->CommonModel->validateUserType("Evaluator");

        $userID = $this->session->userdata('userId');
        $data=array();
        if(isset($_GET['ajax'])){
            $join = array();
            $join[1]['type'] ="LEFT JOIN";
            $join[1]['table']="master_sub_category";
            $join[1]['alias'] ="sc";
            $join[1]['key1'] ="subCategoryID";
            $join[1]['key2'] ="sub_cat_id";
            $selectc = "t.*,sc.sub_cat_name";
            $wherepro =array("t.status ="=>"'active'","t.phaseTwoStatus="=>"'Approved'","t.currentPhase>="=>"2");
    
            if(isset($_GET['subCtIds']) && !empty($_GET['subCtIds'])){
                $wherepro["t.subCategoryID in ("] = $_GET['subCtIds']."0 )";
            }

            $page_reference = "home";
    
            if(isset($_GET['self_list']) && !empty($_GET['self_list'])){
                $page_reference = "inbox";
                $join[2]['type'] ="LEFT JOIN";
                $join[2]['table']="project_evaluation";
                $join[2]['alias'] ="pe";
                $join[2]['key1'] ="projectID";
                $join[2]['key2'] ="projectID";
                $wherepro['pe.userID='] = $userID;
            }
            
            $prodetail = $this->CommonModel->GetMasterListDetails($selectc,'project_master',$wherepro,'','',$join,'');
            
            if(!empty($prodetail)){
                
                $evPriojIds = array();
                
                $maxEvaluators = 3;
                $totEvalsSetting = $this->CommonModel->getMasterDetails('infoSettings','maxEvaluators',array("infoID ="=>1));
                if(!empty($totEvalsSetting)){
                    $maxEvaluators = $totEvalsSetting[0]->maxEvaluators;
                }

                foreach ($prodetail as $key => $prodetails) {
                    $actionHtml = "";
                    $starClass = "";
                    $starIcon = "bx-star";
                    $isSubmited = 0;
                    $isSubmitedByMe = 0;
                    $proSelected = "Select";
                    $maxLimit = 0;
                  
                    // check all threee sbimited or not
                    $evproQ = $this->CommonModel->GetMasterListDetails("*",'project_evaluation',array("projectID="=>$prodetails->projectID),'','','','');
                    $totSubmit = 0;
                    // check is submited by login user
                    foreach ($evproQ as $key => $value)
                    {
                        if($this->session->userdata('userId') == $value->userID && $value->status == "submited"){
                            $isSubmitedByMe = 1;
                        }
                        if($this->session->userdata('userId') == $value->userID){
                            $proSelected = "Remove";
                            $starClass = "selection-star";
                            $starIcon = "bxs-star";
                        }
                        if($value->status == "submited"){
                            $totSubmit++;
                        }
                    }
                    if(isset($evproQ) && !empty($evproQ) && count($evproQ) >= $maxEvaluators){
                        $isSubmited = 1;
                    }
                    
                    
                    if(isset($_GET['self_list']) && !empty($_GET['self_list'])){
                        $starClass = "selection-star";
                    }else{
                        if(count($evproQ) >= $maxEvaluators){
                            $starClass ="locked-star";
                            $starIcon = "bxs-star";
                            $maxLimit = 1;
                        }
                    }
                    if($totSubmit >= $maxEvaluators){
                        $starIcon = "bxs-star";
                        $starClass = "evaluated-star";
                    }

                    if($isSubmitedByMe){
                        
                        $actionHtml = "<a href='javacript:void(0)' id='project-".$prodetails->projectID."' class='ev-select'>Score Submited</a>";
                    }else{
                        if(!$isSubmited){
                            $actionHtml = "<a href='javacript:void(0)' onclick='return selectProject(".$prodetails->projectID.")' id='project-".$prodetails->projectID."' class='ev-select'>".$proSelected."</a>";
                        }elseif($proSelected == "Remove"){
                            $actionHtml = "<a href='javacript:void(0)' onclick='return selectProject(".$prodetails->projectID.")' id='project-".$prodetails->projectID."' class='ev-select'>".$proSelected."</a>";
                            
                        }else{
                            $actionHtml = "<a href='javacript:void(0)' id='project-".$prodetails->projectID."' class='ev-select'>Project Locked</a>";
                        }
                        
                    }
                    $data[] = array('<span id="ev-star-'.$prodetails->projectID.'" class="'.$starClass.'"><i class="bx '.$starIcon.'"></i></span> ',
                    '<a href="'.base_url().'evaluator/project-details/'.$prodetails->projectID.'?page_reference='.$page_reference.'" target="_blank" id="project_link_'.$prodetails->projectID.'">'.$prodetails->sparkleID.'</a>',
                                    $prodetails->projectName,
                                    $prodetails->sub_cat_name ,
                                    $actionHtml
                                    );
                }
            }
            
            echo json_encode(array("data"=>$data)); exit;
        }

        if(isset($prodetail) && !empty($prodetail)){
            $data['prodetail'] = $prodetail;
        }else{
            $data['prodetail'] = "";
        }
            $wherecategory =array("status="=>"'active'");
            $categoryList = $this->CommonModel->GetMasterListDetails('','master_category',$wherecategory,'','','','');


            if(isset($categoryList)&& !empty($categoryList))
                {
                    $data['categoryList']= $categoryList;
                    foreach ($categoryList as $key => $categoryId) {
                        $category = $categoryId->category_id;
                        // echo  $category;exit;
                        $wheresubcate=array("category_id="=>$category);
                        $subCategoryList = $this->CommonModel->GetMasterListDetails('','master_sub_category',$wheresubcate,'','','','');
                        // print_r($subCategoryList);
                        if(isset($subCategoryList) && !empty($subCategoryList))
                        {
                            $categoryList[$key]->subCategoryList =$subCategoryList;

                        }
                        else{
                            $categoryList[$key]->subCategoryList = "";
                        }
                    }
                    // exit;
                    //  $data['categoryList']= $categoryList;
                    // print "<pre>";
                    //  print_r($categoryList);exit;
                    //  print "</pre>";
                }else{
                    $data['categoryList'] = "";
                }
                $data['menuName'] = "home";
        $data['pageTitle']="KPIT sparkle | Evaluator Dashboard";
        $data['metaDescription']="Evaluator Dashboard";
        $data['metakeywords']="KPIT sparkle Evaluator Dashboard";
        $this->load->view('evaluator/header',$data);
        $this->load->view('evaluator/dashboard',$data);
        $this->load->view('evaluator/footer');
	}
    public function help()
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Evaluator");
        $data['menuName'] = "help";
        $data['pageTitle']="KPIT sparkle | Evaluator Dashboard";
        $data['metaDescription']="Evaluator Dashboard";
        $data['metakeywords']="KPIT sparkle Evaluator Dashboard";
        $this->load->view('evaluator/header',$data);
        $this->load->view('evaluator/help',$data);
        $this->load->view('evaluator/footer');
	}

    public function summary()
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Evaluator");
        $data['menuName'] = "summary";
        $data['pageTitle']="KPIT sparkle | Evaluator Dashboard";
        $data['metaDescription']="Evaluator Dashboard";
        $data['metakeywords']="KPIT sparkle Evaluator Dashboard";
        $this->load->view('evaluator/header',$data);
        $this->load->view('evaluator/summary',$data);
        $this->load->view('evaluator/footer');
	}

    public function login()
	{
        $data['pageTitle']="KPIT sparkle | Evaluator Dashboard";
        $data['metaDescription']="Evaluator Dashboard";
        $data['metakeywords']="KPIT sparkle Evaluator login";
        $this->load->view('student/header-register',$data);
        $this->load->view('evaluator/eva_login',$data);
        $this->load->view('evaluator/footer');
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

        $data['metakeywords']="KPIT sparkle Evaluator Reset Password";
        $this->load->view('student/header-register',$data);
        $this->load->view('evaluator/eva_resetpassword',$data);
        $this->load->view('evaluator/footer');
	}

    public function projectdetails($id)
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Evaluator");

        $join = array();
        $join[0]['type'] ="LEFT JOIN";
        $join[0]['table']="userregistration";
        $join[0]['alias'] ="m";
        $join[0]['key1'] ="memberID";
        $join[0]['key2'] ="userID";
        $select1="t.*,m.firstname,m.lastName,m.phoneNumber,m.email";
        $userid = $this->session->userdata('userId');
        $where1=array("t.projectID="=>$id);
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
                $where2 = array("projectID="=>$id);
                $trlqueans= $this->CommonModel->GetMasterListDetails('','trl_users_question_answers',$where2,'','','','');
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
        
        $where_ev =array("projectID ="=>$id,"userID =" => $userid);
        $data["evaluationDetails"] = $this->CommonModel->getMasterDetails('project_evaluation','*',$where_ev);
                
        $data["projectDetail"]="evaluator";
        $data['pageTitle']="KPIT sparkle | Evaluator Dashboard";
        $data['metaDescription']="Evaluator Dashboard";
        $data['metakeywords']="KPIT sparkle Evaluator Reset Password";
        $this->load->view('evaluator/header',$data);
        $this->load->view('evaluator/eva_project-details',$data);
        $this->load->view('evaluator/footer');
	}
    public function inbox()
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Evaluator");
        $data["menuName"]="inbox";
        $data['pageTitle']="KPIT sparkle | Evaluator Dashboard";
        $data['metaDescription']="Evaluator Dashboard";
        $data['metakeywords']="KPIT sparkle Evaluator login";
        $this->load->view('evaluator/header',$data);
        $this->load->view('evaluator/inbox',$data);
        $this->load->view('evaluator/footer');
	}

    public function selectproject()
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Evaluator");
        $projectID = $this->input->post('projectID');
        $projectStatus = $this->input->post('status');
        $userId = $this->session->userdata('userId');
        if(!empty($projectID)){
            
            $where=array("projectID ="=>$projectID,"userID =" => $userId);
            $isSelected = $this->CommonModel->getMasterDetails('project_evaluation','*',$where);
            $evaluatorData = array("projectID"=>$projectID, "userId"=> $userId);
            $whereProject = array("projectID"=>$projectID);

            if($projectStatus == "Select"){
                if(empty($isSelected)){
                    

                    $maxEvaluators = 3;
                    $totEvalsSetting = $this->CommonModel->getMasterDetails('infoSettings','maxEvaluators',array("infoID ="=>1));
                    if(!empty($totEvalsSetting)){
                        $maxEvaluators = $totEvalsSetting[0]->maxEvaluators;
                    }
                    
                    // check is project available
                    $isAvailable = $this->CommonModel->getMasterDetails('project_master','totEvaluators',$whereProject);
                    //print_r($isAvailable); exit;
                    if(isset($isAvailable) && !empty($isAvailable)){
                        if($isAvailable[0]->totEvaluators >= $maxEvaluators && $isAvailable[0]->totEvaluators != null){
                            $status['msg'] = 'Project was lock. Please refresh the page and try again.'; 
                            $status['flag'] = 'F';
                            echo json_encode($status); exit;
                        }

                    }else{
                        $status['msg'] = 'Project Not found. Please refresh the page and try again.'; 
                        $status['flag'] = 'F';
                        echo json_encode($status); exit;
                    }

                    $isSave=$this->CommonModel->saveMasterDetails('project_evaluation', $evaluatorData);
                    if($isSave){
                        $totEvaluators = 0;
                        $evalSelected = $this->CommonModel->getMasterDetails('project_evaluation','*',$whereProject);
                        if(!empty($evalSelected)){
                            $totEvaluators = count($evalSelected);
                        }
                        $upData = array("totEvaluators" => $totEvaluators);
                        $isUpdate = $this->CommonModel->updateMasterDetails("project_master",$upData,$whereProject);

                        $status['msg'] = 'Project selected'; 
                        $status['flag'] = 'S';
                        echo json_encode($status); exit;
                    }
                }
                $status['msg'] = 'Project already selected.';
            }else{
                if(!empty($isSelected)){
                    
                    $evalSelected = $this->CommonModel->getMasterDetails('project_master','*',$whereProject);
                        if(!empty($evalSelected)){
                            if($evalSelected[0]->totEvaluators !== 0 || $evalSelected[0]->totEvaluators !== null ){
                                $tot = $evalSelected[0]->totEvaluators - 1;
                            }else{
                                $tot =0;
                            }
                        }else{
                            $tot =0;
                        }

                    $evaluatorDataUp = array("totEvaluators"=>$tot);
                    $isSave = $this->CommonModel->updateMasterDetails('project_master',$evaluatorDataUp,$whereProject);
                    $isSave=$this->CommonModel->deleteMasterDetails('project_evaluation', $evaluatorData, '');
                    if($isSave){
                        $status['msg'] = 'Project removed'; 
                        $status['flag'] = 'S';
                        echo json_encode($status); exit;
                    }
                }
                $status['msg'] = 'Unable to remove project';
            }
            

        }
        
        $status['statusCode'] = 400;
        $status['flag'] = 'F';
        echo json_encode($status); exit;
        
	}

    public function saveprojectevaluation()
	{
        if(empty($this->session->userdata('userId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Evaluator");
        $projectID = $this->input->post('projectID');
        $userId = $this->session->userdata('userId');
        
        if(!empty($projectID)){
            
            $where=array("projectID ="=>$projectID,"userID =" => $userId);
            $isSelected = $this->CommonModel->getMasterDetails('project_evaluation','*',$where);
            if(!empty($isSelected)){
                
                $evaluatorData = array(
                    "marketPotential"=>$this->input->post('business'),
                    "productReadiness"=>$this->input->post('simulation'),
                    "invention"=>$this->input->post('innovation'),
                    "technicalProcess"=>$this->input->post('technical'),
                    "impactOnEnvironment"=>$this->input->post('environment'),
                    "reasonForScore"=>$this->input->post('scorereason'),
                    "status"=> "submited");
                
                $isSave = $this->CommonModel->updateMasterDetails('project_evaluation',$evaluatorData,$where);
                if($isSave){

                    $wherePID =array("projectID ="=>$projectID, "status="=> "submited");
                    $evalSelected = $this->CommonModel->getMasterDetails('project_evaluation','*',$wherePID);
                    

                    if($evalSelected!=null){
                        $numberOfEvals = $marketPotential = $productReadiness = $invention = $technicalProcess  = $impactOnEnvironment = 0;
                        foreach($evalSelected as $ev){

                            $numberOfEvals ++;
                            $marketPotential += $this->getRating($ev->marketPotential);
                            $productReadiness += $this->getRating($ev->productReadiness);
                            $invention += $this->getRating($ev->invention);
                            $technicalProcess += $this->getRating($ev->technicalProcess);
                            $impactOnEnvironment += $this->getRating($ev->impactOnEnvironment);

                        }
                        
                        if(!empty($numberOfEvals)){

                            $ptojectData = array("marketPotential"=>round(($marketPotential/$numberOfEvals),2),
                                                 "productReadiness"=>round(($productReadiness/$numberOfEvals),2),
                                                 "invention"=>round(($invention/$numberOfEvals),2),
                                                 "technicalProcess"=>round(($technicalProcess/$numberOfEvals),2),
                                                 "impactOnEnvironment"=>round(($impactOnEnvironment/$numberOfEvals),2),
                                                 "numberOfEvals"=>$numberOfEvals,
                                                );
                            
                            $this->CommonModel->updateMasterDetails('project_master',$ptojectData,array("projectID ="=>$projectID));
                        }
                    }

                    
                    $status['msg'] = 'Score Submitted'; 
                    $status['flag'] = 'S';
                    echo json_encode($status); exit;
                }
            }

        }

        $status['msg'] = 'Unable to save evaluation details'; 
        $status['statusCode'] = 400;
        $status['where'] = $isSelected;
        $status['statusCode'] = 400;
        $status['flag'] = 'F';
        echo json_encode($status); exit;
        
	}

    public function updatePassword(){
        if(empty($this->session->userdata('tmpUserId')))
        {
            redirect("logout");
            exit;
        }
        $this->CommonModel->validateUserType("Evaluator");

        $this->form_validation->set_rules('userPass','Password','required');
        $this->form_validation->set_rules('cpassword','Confirm Password','required');
        $this->form_validation->set_rules('evaNDA','Evaluator NDA','required');
        $userId = $this->session->userdata('tmpUserId');
        $userpass = md5($this->input->post('userPass'));
        $cpassword = md5($this->input->post('cpassword'));

        //echo $userId.' '.$userpass.' '.$cpassword;exit;
        if($this->form_validation->run()==true)
        {
            $arr['password']=$userpass;
            $arr['cpassword']=$cpassword;
            $arr['NDAaccepted']=1;
            $where = array("userID="=>$userId);
            $userDetails = $this->CommonModel->GetMasterListDetails('firstname,password,email','userregistration',$where,'','','','');
            if(!empty($userDetails)){
                if($userpass != $userDetails[0]->password){

                    $updateevapassword = $this->CommonModel->updateMasterDetails('userregistration',$arr,$where);
                    if(!empty($updateevapassword)){
                        
                        $userDetails = $this->CommonModel->GetMasterListDetails('','userregistration',$where,'','','','');
                        $whereEmail = array("tempName"=>"evaluatorNDA");
                        $emailContent = $this->CommonModel->getMasterDetails('emailMaster','',$whereEmail);
                        if(!empty($emailContent) && !empty($userDetails))
                        {
                            $mailContent = str_replace("{{username}}",$userDetails[0]->firstname,$emailContent[0]->emailContent);
                            
                            $from= $this->config->item('supportEmail');
                            $to=$userDetails[0]->email;
                            $subject=$emailContent[0]->subject;
                            $fromName= "KPIT Sparkle";  //$this->$this->fromName;
                            $msg=$mailContent; 
                            
                            $isEmailSend=$this->emails->sendMailDetails($to,$cc=$from,$bcc='',$subject,$msg);
                        }
                        
                        $status['statusCode'] = 996;
                        $status['flag'] = 'S';
                        $status['msg'] = 'Password Has Been Updated';
                        $status['redirect']= base_url()."login";
                        echo json_encode($status); exit;
                    }else{
                        $status['statusCode']= 996;
                        $status['flag']='F';
                        $status['msg'] = 'Password not Updated';
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
        }
    }

    public function getRating($val){
        switch($val){
            case "Satisfactory":
                return 1;
                break;
            case "Good":
                return 2;
                break;
            case "Exceptional":
                return 3;
                break;
        }
    }
}