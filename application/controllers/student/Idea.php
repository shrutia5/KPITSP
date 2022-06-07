<?php

use PhpOffice\PhpSpreadsheet\Calculation\Category;

defined('BASEPATH') OR exit('No direct script access allowed');

class Idea extends CI_Controller {

    public $validateData;

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('CommonModel');
        // Your own constructor code
        if (empty($this->session->userdata('userId'))) {
            redirect('logout');
            exit;
        }
    }

    public function index() {
        // print_r($this->session->userdata('userId'));exit; 
        if (empty($this->session->userdata('userId'))) {
            redirect('logout');
            exit;
        }

        $join = array();
        $join[0]['type'] = "LEFT JOIN";
        $join[0]['table'] = "project_master";
        $join[0]['alias'] = "p";
        $join[0]['key1'] = "userID";
        $join[0]['key2'] = "userID";
        $select1 = "t.*,p.projectID,p.sparkleID,p.projectName,p.projectDiscription,p.categoryID,p.subCategoryID,p.currentStep,p.currentPhase,projectStatus,phaseTwoStatus,phaseThreeStatus,p.technicalDescription,p.keywords,p.patentFiled,p.patentStatus,p.patentApplicationNumber,p.leanCanvas,p.simulationReport,p.valuePropositionCanvas,p.prototypeProgressVideo,prototypeProgressVideo2";
        $userid = $this->session->userdata('userId');
        $where1 = array("p.userID=" => $userid);
        $projectdetails = $this->CommonModel->GetMasterListDetails($select1, 'userregistration', $where1, '', '', $join, '');
        if (isset($projectdetails) && !empty($projectdetails)) {
            if ($projectdetails[0]->projectStatus == "Reject" || $projectdetails[0]->phaseTwoStatus == "Reject" || $projectdetails[0]->phaseThreeStatus == "Reject") {
                redirect(base_url() . "student/dashboard");
                exit;
            }
            $data['projectdetails'] = $projectdetails[0];
            $subCat = $projectdetails[0]->subCategoryID;
            $whereSubCat = array("sub_cat_id=" => $subCat);
            $subCat = $this->CommonModel->GetMasterListDetails('', 'master_sub_category', $whereSubCat, '', '', '', '');
            //print_r($subCat);exit;
            if (isset($subCat) && !empty($subCat)) {
                $data['subCat'] = $subCat[0];
            } else {
                $data['subCat'] = "";
            }
            $da = "phase-" . $projectdetails[0]->currentPhase . "%'";
        } else {
            $data['projectdetails'] = "";
            $da = "phase-1%'";
        }
        // get helpfull resoruces as per the stage
        //$projectdetails[0]->currentPhase;

        $wherPhase = array("section LIKE '%" => $da, "status = " => "'active'");
        $helpfulDetails = $this->CommonModel->GetMasterListDetails("*", 'helpfulResources', $wherPhase, '', '', array(), '');
        $data['helpfulDetails'] = $helpfulDetails;
        //print_r($helpfulDetails); exit;
        $userid = $this->session->userdata('userId');
        $wheretr = array("userID=" => $userid);
        $trlDetails = $this->CommonModel->GetMasterListDetails("*", 'trl_users_question_answers', $wheretr, '', '', array(), '');
        //print "<pre>";
        //print_r($trlDetails);exit;
        $data['trlDetails'] = $trlDetails;
        $other = array("orderBy" => "trl_name", "order" => "ASC");
        $where = array("is_del =" => 0);
        $trlNames = $this->CommonModel->GetMasterListDetails('*', "master_trl", $where, '', '', $join = array(), $other);
        if (isset($trlNames) && !empty($trlNames)) {
            foreach ($trlNames as $key => $value) {
                $other = array("orderBy" => "trlQuestionID", "order" => "ASC");
                $where = array("status =" => "'active'", "trlLevelID=" => $value->id);
                $trlQuestions = $this->CommonModel->GetMasterListDetails('*', "trl_questions", $where, '', '', $join = array(), $other);
                if (isset($trlQuestions) && !empty($trlQuestions)) {
                    $trlNames[$key]->questionList = $trlQuestions;
                }
            }
        }
        // $other=array("orderBy"=>"trl_name","order"=>"ASC");
        $where = array("status =" => "'active'");
        $mstercat = $this->CommonModel->GetMasterListDetails('*', "master_category", $where, '', '', $join = array(), $other = array());
        //print_r($mstercat);exit;
        if (isset($mstercat) && !empty($mstercat)) {

            $data['mstercat'] = $mstercat;
            //echo $mstercat[0]->projectDiscription;exit;
        } else {
            $data['mstercat'] = "";
        }
        $wherecategory = array("status =" => "'active'");
        $userCategory = $this->CommonModel->GetMasterListDetails('*', "master_category", $wherecategory, '', '', '', '');
        //print_r($userCategory);exit;
        if (isset($userCategory) && !empty($userCategory)) {
            $data['userCategory'] = $userCategory;
        } else {
            $data['userCategory'] = "";
        }
        $where = array("status =" => "'active'");
        $mstersubcat = $this->CommonModel->GetMasterListDetails('*', "master_sub_category", $where, '', '', $join = array(), $other = array());
        //print_r($mstersubcat);exit;
        if (isset($mstersubcat) && !empty($mstersubcat)) {
            $data['mstersubcat'] = $mstersubcat;
            //echo $mstersubcat[0]->category_id;exit;
        } else {
            $data['mstersubcat'] = "";
        }

        $data['trlQuestions'] = $trlNames;
        $infoData = $this->CommonModel->GetMasterListDetails("*", 'infoSettings', array(), '', '', array(), '');
        $data['infoSetting'] = $infoData[0];


        //print "<pre>";
        //print_r($trlNames); exit;
        // $data['mstercat']=$mstercat;
        // $data['mstersubcat']=$mstersubcat;
        $data['pageTitle'] = "KPIT sparkle | Student Dashboard";
        $data['metaDescription'] = "Student Dashboard";
        $data['metakeywords'] = "KPIT sparkle Student Dashboard";
        $data['metakeywords'] = "KPIT sparkle Student Dashboard";
        $this->load->view('student/header', $data);
        $this->load->view('student/submitIdea', $data);
        $this->load->view('student/footer');
    }

    public function projectDetails() {

        $join = array();
        $join[0]['type'] = "LEFT JOIN";
        $join[0]['table'] = "userregistration";
        $join[0]['alias'] = "m";
        $join[0]['key1'] = "memberID";
        $join[0]['key2'] = "userID";
        $select1 = "t.*,m.firstname,m.lastName";
        $userid = $this->session->userdata('userId');
        $data['userid'] = $userid;
        $where1 = array("t.userID=" => $userid);
        $memberdetails = $this->CommonModel->GetMasterListDetails($select1, 'membersdetails', $where1, '', '', $join, '');
        //print_r($memberdetails);exit;
        if (isset($memberdetails) && !empty($memberdetails)) {
            $data['memberdetails'] = $memberdetails;
        } else {
            $data['memberdetails'] = "";
        }

        $join1 = array();
        $join1[0]['type'] = "LEFT JOIN";
        $join1[0]['table'] = "master_category";
        $join1[0]['alias'] = "mc";
        $join1[0]['key1'] = "categoryID";
        $join1[0]['key2'] = "category_id";

        $join1[1]['type'] = "LEFT JOIN";
        $join1[1]['table'] = "master_sub_category";
        $join1[1]['alias'] = "msc";
        $join1[1]['key1'] = "subCategoryID";
        $join1[1]['key2'] = "sub_cat_id";
        $where = array("t.userID=" => $userid);
        $select = "t.*,mc.category_name,msc.sub_cat_name";
        $projectd = $this->CommonModel->GetMasterListDetails($select, 'project_master', $where, '', '', $join1, '');

        if (isset($projectd) && !empty($projectd)) {
            $data['projectd'] = $projectd[0];
            //print_r($projectd[0]);exit;
        } else {
            $data['projectd'] = "";
        }
        $proId = $projectd[0]->projectID;
        //echo $proId;exit;
        $wrereque = array("status=" => "'active'");
        $trlquestion = $this->CommonModel->GetMasterListDetails('', 'trl_questions', $wrereque, '', '', '', '');
        //print_r($trlquestion);exit;
        if (isset($trlquestion) && !empty($trlquestion)) {
            $data['trlquestion'] = $trlquestion;
            //print_r($trlquestion[0]);exit;
        } else {
            $data['trlquestion'] = "";
        }

        $wrerequeans = array("status=" => "'active'", "userID=" => $userid, "projectID=" => $proId);
        //print_r($wrerequeans);exit;
        $trlquestionans = $this->CommonModel->GetMasterListDetails('', 'trl_users_question_answers', $wrerequeans, '', '', '', '');
        //print_r($trlquestionans);exit;
        if (isset($trlquestionans) && !empty($trlquestionans)) {
            $data['trlquestionans'] = $trlquestionans;
            //print_r($trlquestionans[0]);exit;
        } else {
            $data['trlquestionans'] = "";
        }
        //ab_trl_users_question_answers


        $join = array();
        $join[0]['type'] = "INNER JOIN";
        $join[0]['table'] = "userregistration";
        $join[0]['alias'] = "u";
        $join[0]['key1'] = "userID";
        $join[0]['key2'] = "userID";

        $join[1]['type'] = "INNER JOIN";
        $join[1]['table'] = "project_master";
        $join[1]['alias'] = "p";
        $join[1]['key1'] = "projectID";
        $join[1]['key2'] = "projectID";

        $select = "p.*,u.firstname,u.lastName,u.status";
        $where1 = array("t.memberID=" => $userid);
        $teamProjects = $this->CommonModel->GetMasterListDetails($select, 'membersdetails', $where1, '', '', $join, '');
        // print_r($teamProjects);
        $data['teamProjects'] = $teamProjects;

        $whereMsg = array("t.project_id=" => $proId);
        $joinMsg = array();
        $joinMsg[0]['type'] = "LEFT JOIN";
        $joinMsg[0]['table'] = "userregistration";
        $joinMsg[0]['alias'] = "u";
        $joinMsg[0]['key1'] = "sender_id";
        $joinMsg[0]['key2'] = "userID";

        $selectMsg = "t.*,u.firstname,u.lastName,u.status";
        $projectsMessages = $this->CommonModel->GetMasterListDetails($selectMsg, 'project_messages', $whereMsg, '', '', $joinMsg, '');
        $data['projectsMessages'] = $projectsMessages;

        $data['pageTitle'] = "KPIT sparkle | Student Dashboard";
        $data['metaDescription'] = "Student Dashboard";
        $data['metakeywords'] = "KPIT sparkle Student Dashboard";
        $this->load->view('student/header', $data);
        $this->load->view('student/project-details', $data);
        $this->load->view('student/footer');
    }

    public function getSubCategory() {
        $cateID = $this->input->post('cateID');
        if (isset($cateID)) {
            $where = array("status =" => "'active'", "category_id=" => $cateID);
            $mstercat = $this->CommonModel->GetMasterListDetails('sub_cat_name,sub_cat_id', "master_sub_category", $where, '', '', $join = array(), $other = array());
            // print_r($mstercat);exit;
            if (!empty($mstercat)) {
                $status['data'] = $mstercat;
                $status['flag'] = 'S';
                echo json_encode($status);
                exit;
            } else {
                $status['data'] = "";
                $status['flag'] = 'F';
                echo json_encode($status);
                exit;
            }
        }
    }

    public function addMemberDetails() {

        $memberData = array();
        $this->form_validation->set_rules('contact', 'contact', 'required');
        $memberData['projectID'] = $this->input->post('projettid');
        $memberData['memberID'] = $this->input->post('contact');
        $mobileNo = str_split($memberData['memberID'], 10);
        //print_r($mobileNo[0]);exit;
        $conno = $mobileNo[0];
        //echo $conno;exit;
        $memberData['designation'] = $this->input->post('member');
        $memberData['userID'] = $this->session->userdata('userId');

        if ($this->form_validation->run() == true) {
            $where = array("phoneNumber" => $conno, "userID !=" => $this->session->userdata('userId'));
            $userData = $this->CommonModel->getMasterDetails('userregistration', '', $where);
            //print_r($userData); exit;

            if (!empty($userData)) {
                $memcID = $userData[0]->userID;
                $memberData['memberID'] = $memcID;

                $where = array("memberID" => $memberData['memberID'], "userID" => $this->session->userdata('userId'));
                $memberId = $this->CommonModel->getMasterDetails('membersdetails', '', $where);
                //print_r($memberId);
                $wherename = array("userID" => $this->session->userdata('userId'));
                $membername = $this->CommonModel->getMasterDetails('membersdetails', '', $wherename);
                //count($membername);
                $mamber = count($membername);
                //print_r($membername);
                //echo $mamber;
                if ($mamber < 4) {
                    if (empty($memberId)) {
                        $isSave = $this->CommonModel->saveMasterDetails("membersdetails", $memberData);
                        $status['msg'] = 'Member Has Been Added';
                        $status['flag'] = 'S';
                        $status['redirect'] = base_url() . "/student/project";
                        echo json_encode($status);
                        exit;
                    } else {
                        //echo "Memmber already exits";
                        $status['msg'] = 'Member already exits.';
                        $status['statusCode'] = validation_errors();
                        $status['flag'] = 'F';
                        echo json_encode($status);
                        exit;
                    }
                } else {
                    $status['msg'] = 'Maximum 4 Member';
                    $status['statusCode'] = validation_errors();
                    $status['flag'] = 'M';
                    $status['redirect'] = base_url() . "/student/project";
                    echo json_encode($status);
                    exit;
                }
            } else {
                $status['msg'] = 'Invalid contact number';
                $status['statusCode'] = validation_errors();
                $status['flag'] = 'F';
                echo json_encode($status);
                exit;
            }
        } else {

            $status['statusCode'] = validation_errors();
            //$status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
    }

    public function saveProject() {
        if (empty($this->session->userdata('userId'))) {
            redirect('logout');
            exit;
        }
        $projectData = array();
        $projectData['projectName'] = $this->input->post('projectName');
        $projectData['categoryID'] = $this->input->post('category');
        $projectData['subCategoryID'] = $this->input->post('suCategory');
        $projectData['projectDiscription'] = $this->input->post('projectDiscription');
        $projectData['userID'] = $this->session->userdata('userId');
        //$projectData['projectID']= $this->input->post('projectID');  
        // echo $projectData['projectName']."<br>";
        // echo  $projectData['categoryID']."<br>";
        // echo  $projectData['subCategoryID']."<br>";
        // echo $projectData['projectDiscription']."<br>";exit;
        $where = array("userID" => $this->session->userdata('userId'));
        $projectDetails = $this->CommonModel->getMasterDetails('project_master', '', $where);

        if (isset($projectDetails) && !empty($projectDetails)) {
            if ($projectDetails[0]->currentStep == 1)
                $projectData['currentStep'] = 2;

            $where = array("userID" => $this->session->userdata('userId'));
            $iscreated = $this->CommonModel->updateMasterDetails('project_master', $projectData, $where);
            if (!empty($iscreated)) {
                $status['data'] = ""; //$projectID;
                $status['flag'] = 'S';
                $this->CommonModel->logUserActivity("Project details updated", "PROJECT_MODIFIED", $projectDetails["projectID"]);
                echo json_encode($status);
                exit;
            } else {
                $status['data'] = "";
                $status['flag'] = 'F';
                echo json_encode($status);
                exit;
            }
        } else {

            $isSave = $this->CommonModel->saveMasterDetails("project_master", $projectData);
            if (!empty($isSave)) {
                $projectID = $this->db->insert_id();

                $length = 6;
                $sparkleID = substr(str_repeat(0, $length) . $projectID, - $length);

                if ($userDetails[0]->country_id == 101) {
                    $sparkleIDarr = array("sparkleID" => "INSP23" . $sparkleID);
                } else if ($userDetails[0]->country_id == 82) {
                    $sparkleIDarr = array("sparkleID" => "DESP23" . $sparkleID);
                } else if ($userDetails[0]->country_id == 217) {
                    $sparkleIDarr = array("sparkleID" => "THSP23" . $sparkleID);
                }

                $where = array("userID" => $this->session->userdata('userId'));
                $iscreated = $this->CommonModel->updateMasterDetails('project_master', $sparkleIDarr, $where);
                $this->CommonModel->logUserActivity("Project details submited", "PROJECT_SUBMITED", $projectID);
                $status['data'] = $projectID;
                $status['flag'] = 'S';
                echo json_encode($status);
                exit;
            } else {
                $status['data'] = "";
                $status['flag'] = 'F';
                echo json_encode($status);
                exit;
            }
        }
    }

    public function saveUserIdea() {
        if (empty($this->session->userdata('userId'))) {
            redirect('logout');
            exit;
        }
        $ideaData = array();
        $postData = $this->input->post();
        $ideaData['projectID'] = $this->input->post('projectID');
        $ideaData['userID'] = $this->session->userdata('userId');
        //  echo $ideaData['projectID'];
        //  echo $ideaData['userID'];exit;
        $this->validateData = $this->validateideaData($postData);
        if (!empty($this->validateData)) {
            $status['data'] = $this->validateData;
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
        //print_r($postData);exit;
        // echo $postData[5]->projectID;exit;
        foreach ($postData as $key => $value) {
            //echo  $value[0]->questionID;exit;
            if (strpos($key, 'trlQuestion') !== false) {
                $keyarry = explode("_", $key);
                $ideaData['questionID'] = $keyarry[1];
                $where = array("userID" => $ideaData['userID'], "projectID" => $ideaData['projectID'], "questionID" => $ideaData['questionID']);
                //print_r($where);
                $updateque = $this->CommonModel->getMasterDetails('trl_users_question_answers', '', $where);
                //print_r($updateque);
                if (isset($updateque) && !empty($updateque)) {
                    $ideaData['questionID'] = $keyarry[1];
                    $ideaData['qanswer'] = $value;
                    $where = array("trlQAnsID" => $updateque[0]->trlQAnsID);
                    //print_r($where);
                    $isupdatepro = $this->CommonModel->updateMasterDetails("trl_users_question_answers", $ideaData, $where);
                    //print_r($isupdatepro);exit;
                } else {
                    $ideaData['questionID'] = $keyarry[1];
                    $ideaData['qanswer'] = $value;
                    $isSave = $this->CommonModel->saveMasterDetails("trl_users_question_answers", $ideaData);
                }
            }
        }
        $this->checkPhaseOneDatatStatus();
        if (!isset($isSave) || !empty($isSave)) {
            if (isset($updateque) && isset($updateque[0]->projectID)) {
                $this->CommonModel->logUserActivity("Project trl updated", "TRL_MODIFIED", $updateque[0]->projectID);
            }

            // save step
            if (!isset($_POST['autosave'])) {
                $where = array("userID" => $this->session->userdata('userId'));
                $projectDetails = $this->CommonModel->getMasterDetails('project_master', '', $where);
                if (isset($projectDetails) && !empty($projectDetails)) {
                    $currentStep = $_POST['sectionId'] + 1;
                    if ($currentStep > $projectDetails[0]->currentStep) {
                        $projectDetails = array('currentStep' => $currentStep);
                        $iscreated = $this->CommonModel->updateMasterDetails('project_master', $projectDetails, $where);
                        if (!empty($iscreated)) {
                            $status['data'] = ""; //$projectID;
                            $status['flag'] = 'S';
                            echo json_encode($status);
                            exit;
                        } else {
                            $status['data'] = "";
                            $status['flag'] = 'F';
                            echo json_encode($status);
                            exit;
                        }
                    }
                }
            }

            $status['data'] = $this->validateData;
            $status['flag'] = 'S';
            echo json_encode($status);
            exit;
        }
    }

    public function validateideaData($data = array()) {
        $issue = array();
        $count = 0;
        foreach ($data as $key => $value) {
            if (strpos($key, 'trlQuestion') !== false) {
                $keyarry = explode("_", $key);
                $ideaData['questionID'] = $keyarry[1];
                $ideaData['qanswer'] = $value;
                $length = strlen($value);
                $where = array("trlQuestionID =" => $ideaData['questionID']);
                $qDetails = $this->CommonModel->GetMasterListDetails('*', "trl_questions", $where, '', '', $join = array(), $other = array());
                //print_r($qDetails);
                //echo $qDetails[0]->minLength;exit;
                if ($qDetails[0]->isRequired === "Yes" && $ideaData['qanswer'] === "") {
                    $issue[$count]['qid'] = $ideaData['questionID'];
                    $issue[$count]['message'] = "This field is required";
                    $count++;
                }
                if (isset($qDetails[0]->minLength) && !empty($qDetails[0]->minLength) && $length < $qDetails[0]->minLength) {
                    $issue[$count]['qid'] = $ideaData['questionID'];
                    $issue[$count]['message'] = "Minimum 200 characters required";
                    $count++;
                }
                if (isset($qDetails[0]->maxLength) && !empty($qDetails[0]->maxLength) && $length > $qDetails[0]->maxLength) {
                    $issue[$count]['qid'] = $ideaData['questionID'];
                    $issue[$count]['message'] = "Maximum 1000 characters required";
                    $count++;
                }
            }
        }
        return $issue;
    }

    public function saveideafiles() {

        $this->load->library('realtimeupload');
        $imagepath = $this->config->item("imagesPATH") . "studentFiles/";

        $projectID = $this->input->post('projectID');
        $ideaData['userID'] = $this->session->userdata('userId');
        $name = $this->input->post('name');
        $keyarry = explode("_", $name);

        $where = array("projectID =" => $projectID);
        $sparkID = $this->CommonModel->GetMasterListDetails('sparkleID', "project_master", $where, '', '', $join = array(), $other = array());
        $fullPath = $this->config->item("imagesPATH") . "studentFiles/" . $sparkID[0]->sparkleID;
        $linkPath = base_url() . "images/studentFiles/" . $sparkID[0]->sparkleID;
        if (!is_dir($fullPath)) {
            mkdir($fullPath, 0777);
            chmod($fullPath, 0777);
        } else {
            if (!is_writable($fullPath)) {
                chmod($fullPath, 0777);
            }
        }

        $this->CommonModel->logUserActivity("Prototype attachment uploaded", "PROJECT_ATTACHMENT_UPLOADED", $projectID);

        if ($keyarry[0] == "attachment") {
            $config = array();
            $config['upload_path'] = $fullPath;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 50000;
            $this->load->library('upload', $config);

            $settings = array(
                'uploadFolder' => $fullPath,
                'extension' => array('pdf'),
                'maxFolderFiles' => 0,
                'maxFolderSize' => 0,
                'returnLocation' => true,
                'uniqueFilename' => false,
                'dbTable' => 'project_master',
                'fileTypeColumn' => '',
                'fileColumn' => $keyarry[1],
                'forignKey' => 'userID',
                'forignValue' => $this->session->userdata('userId'),
                'extraData' => array("userID" => $this->session->userdata('userId')),
                'maxFileSize' => 100000,
            );

            if ($keyarry[1] == 'prototypeProgressVideo' || $keyarry[1] == 'prototypeProgressVideo2') {
                $settings['extension'] = array('mp4');
                $settings['maxFileSize'] = 300000;
            }
            $this->realtimeupload->init($settings);
            exit;
        }

        $where = array("trlQuestionID =" => $keyarry[1]);
        $qDetails = $this->CommonModel->GetMasterListDetails('*', "trl_questions", $where, '', '', $join = array(), $other = array());

        $uploadType = explode("|", $qDetails[0]->uploadType);
        $fileSize = $qDetails[0]->fileSize;

        // Real tome file upload
        $settings = array(
            'uploadFolder' => $fullPath,
            'extension' => $uploadType,
            'maxFolderFiles' => 0,
            'maxFolderSize' => 0,
            'returnLocation' => true,
            'uniqueFilename' => false,
            'dbTable' => 'trl_users_question_answers',
            'fileTypeColumn' => 'fileType',
            'fileColumn' => 'docName',
            'forignKey' => 'questionID',
            'forignValue' => $keyarry[1],
            'extraData' => array('userID' => $ideaData['userID'], "projectID" => $projectID, "questionID" => $keyarry[1]),
            'maxFileSize' => $fileSize,
        );
        $this->realtimeupload->init($settings);
        $this->checkPhaseOneDatatStatus();
        exit;
        // End Real tome file upload
        //CI Upload
        /*

          $config=array();
          $config['upload_path']= $fullPath;
          $config['allowed_types']=$qDetails[0]->uploadType;
          $config['max_size']= $qDetails[0]->fileSize;
          $this->load->library('upload', $config);
          if (! $this->upload->do_upload("file"))
          {
          $issue[0]['qid']= $keyarry[1];
          $issue[0]['message']= "<div class='error errorline'>".$this->upload->display_errors()." Only ".$qDetails[0]->uploadType." file is allow.</div>";
          $status['data'] = $issue;
          $status['flag'] = 'F';
          $status['error'] = $this->upload->display_errors();
          echo json_encode($status); exit;
          }else
          {
          $data = array('upload_data' => $this->upload->data());
          $keyarry=explode("_",$name);
          $ideaData['projectID']=$projectID;
          $ideaData['userID']= $ideaData['userID'];
          $ideaData['questionID']=$keyarry[1];
          $ideaData['docName']=$data["upload_data"]['file_name'];
          $ideaData['fileType']=$data["upload_data"]['file_type'];
          $ideaData['docType']="ProtoType";
          $where=array("userID"=>$ideaData['userID'],"projectID"=>$ideaData['projectID'],"questionID"=> $ideaData['questionID']);
          $updatefile = $this->CommonModel->getMasterDetails('trl_users_question_answers','',$where);
          if(isset($updatefile) && !empty($updatefile)){
          $where=array("trlQAnsID"=> $updatefile[0]->trlQAnsID);
          $isupdatepro =$this->CommonModel->updateMasterDetails("trl_users_question_answers",$ideaData,$where);
          if($isupdatepro)
          {
          $issue[0]['qid']= $keyarry[1];
          $issue[0]['message']= "<div class='tlfile_".$keyarry[1]."'> <a href='".$linkPath."/".$ideaData['docName']."'>".$ideaData['docName']."</a><span data-trlQAnsID='".$updatefile[0]->trlQAnsID."' data-questionID='".$keyarry[1]."' class='removeTlFiles'><i class='bx bx-trash-alt'></i></span></div>";
          $status['data'] = $issue;
          $status['type'] ="file";
          $status['flag'] = 'S';
          $status["status"] = "File uploaded";
          $status["url"] = $ideaData['docName'];
          echo json_encode($status); exit;
          }
          }
          else{
          $isSave=$this->CommonModel->saveMasterDetails("trl_users_question_answers",$ideaData);
          //print_r($isSave);
          if($isSave)
          {
          $issue[0]['qid']= $keyarry[1];
          $issue[0]['message']= "<div class='tlfile_".$keyarry[1]."'><a href='".$linkPath."/".$ideaData['docName']."'>".$ideaData['docName']."</a><span data-trlQAnsID='".$this->db->insert_id()."' data-questionID='".$keyarry[1]."' class='removeTlFiles'><i class='bx bx-trash-alt'></i></span></div>";
          $status['data'] = $issue;
          $status['type'] ="file";
          //$status['data'] = $this->validateData;
          $status['flag'] = 'S';
          $status["status"] = "File uploaded";
          $status["url"] = $ideaData['docName'];
          echo json_encode($status); exit;
          }
          }

          }

         */
    }

    public function getIdeaFile() {

        $status['message'] = "";
        $status['flag'] = 'F';

        $name = $this->input->post('name');
        $keyarry = explode("_", $name);
        $questionID = $keyarry[1];
        $projectID = $this->input->post('projectID');
        $userID = $this->session->userdata('userId');
        $where = array("projectID =" => $projectID);

        $sparkID = $this->CommonModel->GetMasterListDetails('sparkleID,leanCanvas,simulationReport,valuePropositionCanvas,prototypeProgressVideo,prototypeProgressVideo2', "project_master", $where, '', '', $join = array(), $other = array());
        if (!empty($sparkID)) {

            $linkPath = base_url() . "images/studentFiles/" . $sparkID[0]->sparkleID;

            if ($keyarry[0] == "attachment") {
                $this->checkPhaseTwoDatatStatus();
                $projectDetails = (array) $sparkID[0];

                foreach ($projectDetails as $key => $val) {
                    if ($key == $questionID) {
                        $status['flag'] = 'S';
                        $status['message'] = "<div class='attfile_" . $keyarry[1] . "'><a href='" . $linkPath . "/" . $val . "'>" . $val . "</a><span data-field='" . $questionID . "' data-questionID='" . $questionID . "' class='removeAttFiles'><i class='bx bx-trash-alt'></i></span></div>";
                    }
                }
            } else {
                $where = array("userID" => $userID, "projectID" => $projectID, "questionID" => $questionID);
                $fileDetails = $this->CommonModel->getMasterDetails('trl_users_question_answers', '', $where);
                if (isset($fileDetails) && !empty($fileDetails)) {
                    $status['flag'] = 'S';
                    $status['message'] = "<div class='tlfile_" . $keyarry[1] . "'><a href='" . $linkPath . "/" . $fileDetails[0]->docName . "'>" . $fileDetails[0]->docName . "</a><span data-trlQAnsID='" . $fileDetails[0]->trlQAnsID . "' data-questionID='" . $keyarry[1] . "' class='removeTlFiles'><i class='bx bx-trash-alt'></i></span></div>";
                }
            }
        }


        echo json_encode($status);
        exit;
    }

    public function saveAttachmentfile() {
        
    }

    public function removeIdeaFiles() {


        $ansID = $this->input->post('id');
        $questionID = $this->input->post('questionID');

        if (!isset($ansID) || empty($ansID)) {
            $status['data'] = $issue;
            $status['message'] = "Error while deleting file. Please try again.";
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
        // get record
        $where = array("userID" => $this->session->userdata('userId'), "trlQAnsID" => $ansID);
        $getFiles = $this->CommonModel->getMasterDetails('trl_users_question_answers', '', $where);
        //print_r($getFiles); exit;
        if (isset($getFiles) && !empty($getFiles)) {

            $where = array("projectID" => $getFiles[0]->projectID);
            $projectDetails = $this->CommonModel->getMasterDetails('project_master', '', $where);
            $fullPath = $this->config->item("imagesPATH") . "studentFiles/" . $projectDetails[0]->sparkleID;

            if (isset($getFiles[0]->docName) && !empty($getFiles[0]->docName)) {
                //unlink($fullPath."/".$getFiles[0]->docName);
                $where = array("trlQAnsID" => $ansID);
                //print $fullPath;
                //print_r($where); exit;
                $isDel = $this->CommonModel->deleteMasterDetails("trl_users_question_answers", $where);
                if ($isDel) {
                    $this->checkPhaseOneDatatStatus();
                    $status['data'] = "";
                    $status['questionID'] = $questionID;
                    $status['message'] = "deleted";
                    $status['flag'] = 'S';
                    echo json_encode($status);
                    exit;
                } else {
                    $status['data'] = "";
                    $status['questionID'] = $questionID;
                    $status['message'] = "Error while deleting file. Please try again.";
                    $status['flag'] = 'F';
                    echo json_encode($status);
                    exit;
                }
            }
        }
    }

    public function savePrototypeDetails() {

        $technicalDescription = $this->input->post('technicalDescription');
        $keywords = $this->input->post('keywords');
        $patentFiled = $this->input->post('patentFiled');
        $patentStatus = $this->input->post('patentStatus');
        $patentApplicationNumber = $this->input->post('patentApplicationNumber');

        $projectData = array();
        if (!empty($technicalDescription)) {
            $projectData['technicalDescription'] = $technicalDescription;
        }
        if (!empty($keywords)) {
            $projectData['keywords'] = $keywords;
        }
        $projectData['patentFiled'] = intval($patentFiled);
        if (!empty($patentStatus)) {
            $projectData['patentStatus'] = $patentStatus;
        }

        if (!empty($patentApplicationNumber)) {
            $projectData['patentApplicationNumber'] = $patentApplicationNumber;
        }

        $where = array("userID" => $this->session->userdata('userId'));
        $isUpdated = $this->CommonModel->updateMasterDetails('project_master', $projectData, $where);
        if ($isUpdated) {

            $this->CommonModel->logUserActivity("Prototype details upddated", "PROJECT_PROTOTYPE_MODIFIED", $this->input->post('projectID'));

            $this->checkPhaseTwoDatatStatus();
            $status['data'] = "";
            $status['message'] = $patentFiled;
            $status['flag'] = 'S';
            echo json_encode($status);
            exit;
        } else {
            $status['data'] = "";
            $status['message'] = "Error while deleting file. Please try again.";
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
    }

    public function removeIdeaAttFiles() {

        $type = $this->input->post('type');

        if (!isset($type) || empty($type)) {
            $status['data'] = $issue;
            $status['message'] = "Error while deleting file. Please try again.";
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
        $projectData = array($type => NULL);
        //print_r($projectData);
        //echo "<br>";
        $where = array("userID" => $this->session->userdata('userId'));
        //print_r($where);
        $isUpdated = $this->CommonModel->updateMasterDetails('project_master', $projectData, $where);
        //print_r($isUpdated);
        if ($isUpdated) {
            // remove file from server 
            $filePath = $this->config->item("imagesPATH");

            $projectd = $this->CommonModel->getMasterDetails('project_master', "*", $where);
            //print_r($projectd); exit;
            if (isset($projectd) && !empty($projectd)) {
                // print $filePath.$projectd[0]->sparkleID."/".$projectd[0]->valuePropositionCanvas; exit;
                if (file_exists($filePath . $projectd[0]->sparkleID . "/" . $projectd[0]->valuePropositionCanvas)) {
                    unlink($filePath . $projectd[0]->sparkleID . "/" . $projectd[0]->valuePropositionCanvas);
                }

                $this->CommonModel->logUserActivity("Prototype attachment removed", "PROJECT_ATTACHMENT_REMOVED", $projectd[0]->projectID);
            }

            $this->checkPhaseTwoDatatStatus();
            $status['data'] = "";
            $status['message'] = "deleted";
            $status['flag'] = 'S';
            $status['projectd'] = $projectd;
            echo json_encode($status);
            exit;
        } else {
            $status['data'] = "";
            $status['message'] = "Error while deleting file. Please try again.";
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
    }

    public function removeMember() {

        $memID = $this->input->post('memID');
        //echo $memID;exit;
        //$questionID= $this->input->post('questionID');

        if (!isset($memID) || empty($memID)) {
            $status['data'] = array();
            $status['message'] = "Error while deleting file. Please try again.";
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
        // get record
        $where = array("memID=" => $memID);
        $getmemdetail = $this->CommonModel->getMasterDetails('membersdetails', '', $where);
        //print_r($getmemdetail);exit;
        if (isset($getmemdetail) && !empty($getmemdetail)) {
            $where = array("memID" => $memID);
            $memberDel = $this->CommonModel->deleteMasterDetails("membersdetails", $where);
            //print_r($memberDel);exit;
            if ($memberDel) {
                $status['data'] = "";
                $status['memID'] = $memID;
                $status['msg'] = "deleted Member";
                $status['flag'] = 'S';
                $status['redirect'] = base_url() . "/student/project";
                echo json_encode($status);
                exit;
            } else {
                $status['data'] = "";
                $status['questionID'] = $memID;
                $status['mess'] = "Error while deleting file. Please try again.";
                $status['flag'] = 'F';
                echo json_encode($status);
                exit;
            }
        }
    }

    public function memberProjectDetails($projectID) {
        //echo $projectID;exit;

        $userid = $this->session->userdata('userId');
        $data['userid'] = $userid;
        $join = array();
        $join[0]['type'] = "LEFT JOIN";
        $join[0]['table'] = "userregistration";
        $join[0]['alias'] = "m";
        $join[0]['key1'] = "memberID";
        $join[0]['key2'] = "userID";

        $select1 = "t.*,m.firstname,m.lastName";
        $whereproject = array("projectID=" => $projectID);
        $project = $this->CommonModel->getMasterDetails('project_master', '', $whereproject);
        // print_r($project);
        $pUserId = $project[0]->userID;
        $whereuser = array("userID=" => $pUserId);
        $userp = $this->CommonModel->getMasterDetails('userregistration', '', $whereuser);
        if (isset($userp) && !empty($userp)) {
            $data['userp'] = $userp;
        } else {
            $data['userp'] = "";
        }
        // print_r($userp);exit;
        $where1 = array("t.projectID=" => $projectID);
        $memberdetails = $this->CommonModel->GetMasterListDetails($select1, 'membersdetails', $where1, '', '', $join, '');
        // print_r($memberdetails);exit;
        if (isset($memberdetails) && !empty($memberdetails)) {
            $data['memberdetails'] = $memberdetails;
        } else {
            $data['memberdetails'] = "";
        }

        $join1 = array();
        $join1[0]['type'] = "LEFT JOIN";
        $join1[0]['table'] = "master_category";
        $join1[0]['alias'] = "mc";
        $join1[0]['key1'] = "categoryID";
        $join1[0]['key2'] = "category_id";

        $join1[1]['type'] = "LEFT JOIN";
        $join1[1]['table'] = "master_sub_category";
        $join1[1]['alias'] = "msc";
        $join1[1]['key1'] = "subCategoryID";
        $join1[1]['key2'] = "sub_cat_id";
        $where = array("t.projectID=" => $projectID);
        $select = "t.*,mc.category_name,msc.sub_cat_name";
        $projectd = $this->CommonModel->GetMasterListDetails($select, 'project_master', $where, '', '', $join1, '');

        if (isset($projectd) && !empty($projectd)) {
            $data['projectd'] = $projectd[0];
            //print_r($projectd[0]);exit;
        } else {
            $data['projectd'] = "";
        }
        $proId = $projectd[0]->projectID;
        $userID = $projectd[0]->userID;
        $wrereque = array("status=" => "'active'");
        $trlquestion = $this->CommonModel->GetMasterListDetails('', 'trl_questions', $wrereque, '', '', '', '');
        //print_r($trlquestion);exit;
        if (isset($trlquestion) && !empty($trlquestion)) {
            $data['trlquestion'] = $trlquestion;
            //print_r($trlquestion[0]);exit;
        } else {
            $data['trlquestion'] = "";
        }

        $wrerequeans = array("status=" => "'active'", "userID=" => $userID, "projectID=" => $proId);
        //print_r($wrerequeans);
        $trlquestionans = $this->CommonModel->GetMasterListDetails('', 'trl_users_question_answers', $wrerequeans, '', '', '', '');
        //echo $trlquestionans[0]->userID;
        //print_r($trlquestionans);exit;
        if (isset($trlquestionans) && !empty($trlquestionans)) {
            $data['trlquestionans'] = $trlquestionans;
            //print_r($trlquestionans[0]);exit;
        } else {
            $data['trlquestionans'] = "";
        }
        //ab_trl_users_question_answers
        $whereMsg = array("t.project_id=" => $proId);
        $joinMsg = array();
        $joinMsg[0]['type'] = "LEFT JOIN";
        $joinMsg[0]['table'] = "userregistration";
        $joinMsg[0]['alias'] = "u";
        $joinMsg[0]['key1'] = "sender_id";
        $joinMsg[0]['key2'] = "userID";

        $selectMsg = "t.*,u.firstname,u.lastName,u.status";
        $projectsMessages = $this->CommonModel->GetMasterListDetails($selectMsg, 'project_messages', $whereMsg, '', '', $joinMsg, '');
        $data['projectsMessages'] = $projectsMessages;

        $data['pageTitle'] = "KPIT sparkle | Student Dashboard";
        $data['metaDescription'] = "Student Dashboard";
        $data['metakeywords'] = "KPIT sparkle Student Dashboard";
        $this->load->view('student/header', $data);
        $this->load->view('student/project-details', $data);
        $this->load->view('student/footer');
    }

    public function checkPhaseOneDatatStatus() {

        $where = array("isRequired=" => "'Yes'", "status=" => "'active'");
        $trlQuestions = $this->CommonModel->GetMasterListDetails('trlQuestionID', "trl_questions", $where, '', '', $join = array(), '');
        //print_r($trlQuestions);exit;
        if (isset($trlQuestions) && !empty($trlQuestions)) {
            $totalQutionsSubmited = 0;

            $questionIDs = array();
            foreach ($trlQuestions as $ques) {
                $questionIDs[] = $ques->trlQuestionID;
            }
            // print_r($questionIDs);
            // echo "<br>";
            $questionIDs_submited = array();
            $userid = $this->session->userdata('userId');
            $wheretr = array("userID=" => $userid);
            $trlDetails = $this->CommonModel->GetMasterListDetails("questionID", 'trl_users_question_answers', $wheretr, '', '', array(), '');
            if (!empty($trlDetails)) {
                foreach ($trlDetails as $ans) {
                    if (in_array($ans->questionID, $questionIDs)) {
                        $questionIDs_submited[] = $ans->questionID;
                    }
                }
            }
            //print_r($questionIDs_submited);exit;
            $phaseOneDataSubmited = 0;
            if (count($questionIDs_submited) >= count($questionIDs)) {
                $phaseOneDataSubmited = 1;
            }
            //echo $phaseOneDataSubmited;exit;
            $where = array("userID" => $userid);
            $projectData['phaseOneDataSubmited'] = $phaseOneDataSubmited;
            $iscreated = $this->CommonModel->updateMasterDetails('project_master', $projectData, $where);
            //exit;
        }
    }

    public function checkPhaseTwoDatatStatus() {
        $userid = $this->session->userdata('userId');
        $where = array("userID=" => $userid);
        $projectd = $this->CommonModel->GetMasterListDetails('*', 'project_master', $where, '', '', '', '');
        //print_r($projectd);exit;
        if (isset($projectd) && !empty($projectd)) {
            $pObj = $projectd[0];

            $phaseDataSubmited = 0;
            if (!empty($pObj->technicalDescription) && !empty($pObj->keywords) && !empty($pObj->leanCanvas) && !empty($pObj->simulationReport) && !empty($pObj->valuePropositionCanvas) && !empty($pObj->prototypeProgressVideo)) {
                if (!empty($pObj->patentFiled)) {
                    if (!empty($pObj->patentFiled) && !empty($pObj->patentApplicationNumber)) {
                        $phaseDataSubmited = 1;
                    } else {
                        $phaseDataSubmited = 0;
                    }
                } else {
                    $phaseDataSubmited = 1;
                }
            }
            if ($pObj->phaseTwoDataSubmited != $phaseDataSubmited) {
                $projectData['phaseTwoDataSubmited'] = $phaseDataSubmited;
                $this->CommonModel->updateMasterDetails('project_master', $projectData, $where);
            }
        }
    }

    public function shareWithIncubation() {
        $userid = $this->session->userdata('userId');
        $shareWithIncubator = $this->input->post('shareWithIncubator');
        $where = array("userID=" => $userid);
        $projectd = $this->CommonModel->GetMasterListDetails('*', 'project_master', $where, '', '', '', '');
        //print_r($projectd);exit;
        if (isset($projectd) && !empty($projectd)) {
            $projectData = array("shareWithIncubator" => $shareWithIncubator);
            $iscreated = $this->CommonModel->updateMasterDetails('project_master', $projectData, $where);
            $status['data'] = $mstercat;
            $status['flag'] = 'S';
            echo json_encode($status);
            exit;
        }
        $status['data'] = "";
        $status['flag'] = 'F';
        echo json_encode($status);
        exit;
    }

    public function getSubcategoryList() {
        $categoryId = $this->input->post('categoryID');
        // echo $categoryId;exit;
        if (isset($categoryId)) {
            $wheresubcat = array("status =" => "'active'", "category_id=" => $categoryId);
            $mstercat = $this->CommonModel->GetMasterListDetails('*', "master_sub_category", $wheresubcat, '', '', '', '');
            //print_r($mstercat);exit;
            if (!empty($mstercat)) {
                $status['data'] = $mstercat;
                $status['flag'] = 'S';
                echo json_encode($status);
                exit;
            } else {
                $status['data'] = "";
                $status['flag'] = 'F';
                echo json_encode($status);
                exit;
            }
        }
    }

}
