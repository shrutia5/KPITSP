<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('CommonModel');
        $this->load->model('user');
        $this->load->library("Emails");
        $this->load->library("ValidateData");
        // Your own constructor code
    }

    public function index() {
        
    }

    public function register() {
        $data = array();
        $wherestate = array("status=" => 'active', "country_id=" => '101');
        $userState = $this->CommonModel->getMasterDetails('master_states', '*', $wherestate);
        $wherebranch = array("status=" => 'active');
        $userBranch = $this->CommonModel->getMasterDetails('master_branch', '*', $wherebranch);
        $wheredegree = array("status=" => 'active');
        $userDegree = $this->CommonModel->getMasterDetails('master_degree', '*', $wheredegree);
        $wherestream = array("status=" => 'active');
        $userStream = $this->CommonModel->getMasterDetails('master_stream', '*', $wherestream);
        if (isset($userState) && !empty($userState)) {
            $data['userState'] = $userState;
            //print_r($data['userState']);exit;
        } else {
            $data['userState'] = "";
        }
        if (isset($userDegree) && !empty($userDegree)) {
            $data['userDegree'] = $userDegree;
            //print_r($data['userDegree']);exit;
        } else {
            $data['userDegree'] = "";
        }
        if (isset($userStream) && !empty($userStream)) {
            $data['userStream'] = $userStream;
            //print_r($data['userStream']);exit;
        } else {
            $data['userStream'] = "";
        }
        if (isset($userBranch) && !empty($userBranch)) {
            $data['userBranch'] = $userBranch;
            //print_r($data['userBranch']);exit;
        } else {
            $data['userBranch'] = "";
        }
        $data['pageTitle'] = "KPIT sparkle | Student Register";
        $data['metaDescription'] = "Student Register";
        $data['metakeywords'] = "KPIT sparkle student register";
        $data['showLogin'] = "yes";
        $this->load->view('student/header-register', $data);
        $this->load->view('student/register');
        $this->load->view('student/footer');
    }

    public function login() {
        if ($this->session->userdata('userId')) {
            redirect('student/dashboard');
        }
        $data['pageTitle'] = "KPIT sparkle | Student Login";
        $data['metaDescription'] = "Student Login";
        $data['metakeywords'] = "KPIT sparkle student Login";
        $data['showLogin'] = "yes";
        $this->load->view('student/header-register', $data);
        $this->load->view('student/login');
        $this->load->view('student/footer');
    }

    public function verifyuser() {

        $this->form_validation->set_rules('userEmail', 'Email', 'required');
        $this->form_validation->set_rules('userPass', 'password', 'required');
        $userEmail = $this->input->post('userEmail');
        $userPass = md5($this->input->post('userPass'));
        //   echo $userEmail;
        //   echo $userPass;exit;
        if ($this->form_validation->run() == true) {
            $con = array(
                'returnType' => 'single',
                'conditions' => array(
                    'password' => $userPass,
                    'status' => 'active'
                )
            );


            if (strpos($userEmail, '@') != false) {
                // Login using email
                $con['conditions']['email'] = $userEmail;
            } else {
                // Login using phone
                $con['conditions']['phoneNumber'] = $userEmail;
            }
            //print_r($con);exit;

            $checkLogin = $this->user->getRows($con);
            if ($checkLogin) {
                if ($checkLogin['verify_email'] == "no" && $checkLogin['userType'] == "User") {
                    $this->session->set_userdata('tmpotpUserId', $checkLogin['userID']);
                    $status['msg'] = 'Please verify your email before login';
                    $status['statusCode'] = 200;
                    $status['flag'] = 'V';
                    $status['redirect'] = base_url() . "verify";
                    echo json_encode($status);
                    exit;
                }
                $this->session->set_userdata('isUserLoggedIn', TRUE);
                $this->session->set_userdata('userId', $checkLogin['userID']);
                $this->session->set_userdata('name', $checkLogin['firstname']);
                $this->session->set_userdata('lname', $checkLogin['lastName']);
                $this->session->set_userdata('proImg', $checkLogin['profilePic']);
                $this->session->set_userdata('usertype', $checkLogin['userType']);
                $status['statusCode'] = 200;
                $status['redirect'] = base_url() . "student/dashboard";
                $status['flag'] = 'S';
                switch ($checkLogin['userType']) {
                    case "User":
                        $status['redirect'] = base_url() . "student/dashboard";
                        break;
                    case "Admin":
                        $status['redirect'] = base_url() . "admin/dashboard";
                        break;
                    case "Evaluator":
                        if ($checkLogin['NDAaccepted'] == "0") {
                            $this->session->unset_userdata('isUserLoggedIn');
                            $this->session->unset_userdata('userId');
                            $this->session->set_userdata('tmpUserId', $checkLogin['userID']);
                            $this->session->set_userdata('usertype', $checkLogin['userType']);
                            $status['redirect'] = base_url() . "evaluator/resetpassword";
                        } else {
                            $status['redirect'] = base_url() . "evaluator/dashboard";
                        }
                        break;
                    case "Jury":
                        if ($checkLogin['NDAaccepted'] == "0") {
                            $this->session->unset_userdata('isUserLoggedIn');
                            $this->session->unset_userdata('userId');
                            $this->session->set_userdata('tmpUserId', $checkLogin['userID']);
                            $this->session->set_userdata('usertype', $checkLogin['userType']);
                            $status['redirect'] = base_url() . "jury/resetpassword";
                        } else {
                            $status['redirect'] = base_url() . "jury/dashboard";
                        }

                        break;
                    // case "jury":
                    //     $status['redirect'] = base_url()."jury/dashboard2";
                    //     break;
                    case "Incubator":
                        if ($checkLogin['NDAaccepted'] == "0") {
                            $this->session->unset_userdata('isUserLoggedIn');
                            $this->session->unset_userdata('userId');
                            $this->session->set_userdata('tmpUserId', $checkLogin['userID']);
                            $this->session->set_userdata('usertype', $checkLogin['userType']);
                            $status['redirect'] = base_url() . "incubator/resetpassword";
                        } else {
                            $status['redirect'] = base_url() . "incubator/dashboard";
                        }
                        // $status['redirect'] = base_url()."incubator/dashboard";
                        break;
                    case "Mentor":
                        if ($checkLogin['NDAaccepted'] == "0") {
                            $this->session->unset_userdata('isUserLoggedIn');
                            $this->session->unset_userdata('userId');
                            $this->session->set_userdata('tmpUserId', $checkLogin['userID']);
                            $this->session->set_userdata('usertype', $checkLogin['userType']);
                            $status['redirect'] = base_url() . "mentor/resetpassword";
                        } else {
                            $status['redirect'] = base_url() . "mentor/dashboard";
                        }
                        break;
                }
                echo json_encode($status);
                exit;
            } else {
                $status['msg'] = 'Wrong email or password, please try again.';
                $status['statusCode'] = 400;
                $status['flag'] = 'F';
                echo json_encode($status);
                exit;
            }
        } else {
            $status['msg'] = 'Please Enter Your Email & Password';
            $status['statusCode'] = 400;
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
    }

    public function logout() {

        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('login');
    }

    public function forgotPassword() {
        $data['pageTitle'] = "KPIT sparkle | Forgot Password";
        $data['metaDescription'] = "Forgot Password";
        $data['metakeywords'] = "KPIT sparkle forgot password";
        $data['showLogin'] = "yes";
        $this->load->view('student/header-register', $data);
        $this->load->view('student/forgot-password');
        $this->load->view('student/footer');
    }

    public function resetPasswordRequest() {
        $status = array();

        $this->form_validation->set_rules('userEmail', 'Email', 'required|valid_email');
        // echo $this->input->post('userEmail');exit;
        if ($this->form_validation->run() == true) {



            $con = array(
                'returnType' => 'single',
                'conditions' => array(
                    'email' => $this->input->post('userEmail'),
                    'status' => 'active'
            ));
            $checkEmail = $this->user->getRows($con);
            // print_r($checkEmail);exit;
            if ($checkEmail) {
                $resetPassString = uniqid();
                $userDetails = array("otp" => $resetPassString);
                $isupdated = $this->CommonModel->updateMasterDetails("userregistration", $userDetails, array('userID' => $checkEmail['userID']));
                $resetpassURL_encoded = base64_encode($resetPassString);
                $urlLink = base_url() . "updatePasswordForm/" . $resetpassURL_encoded;
                //echo  $urlLink;exit;
                if (!$isupdated) {
                    $status['msg'] = $this->systemmsg->getErrorCode(235);
                    $status['statusCode'] = 997;
                    $status['data'] = array();
                    $status['flag'] = 'F';
                    echo json_encode($status);
                    exit;
                } else {
                    $where = array("tempName" => "forgotPasswordLinkForUserTemp");
                    $tempData = $this->CommonModel->getMasterDetails('emailMaster', '', $where);
                    if (empty($tempData)) {
                        $status['msg'] = $this->systemmsg->getErrorCode(210);
                        $status['statusCode'] = 997;
                        $status['data'] = array();
                        $status['flag'] = 'F';
                        echo json_encode($status);
                        exit;
                    }
                    if (strpos($tempData[0]->emailContent, "{{userName}}") !== false) {
                        $mailContent = str_replace("{{userName}}", $checkEmail['firstname'] . " " . $checkEmail['lastName'], $tempData[0]->emailContent);
                    }

                    if (strpos($mailContent, "{{resetPasswordLink}}") !== false) {
                        $mailContent = str_replace("{{resetPasswordLink}}", $urlLink, $mailContent);
                    }

                    if (strpos($mailContent, "{{email}}") !== false) {
                        $mailContent = str_replace("{{email}}", $checkEmail['email'], $mailContent);
                    }

                    $subject = $tempData[0]->subject;
                    $msg = $mailContent;
                    $to = $checkEmail['email'];
                    $isEmailSend = $this->emails->sendMailDetails($to, $cc = '', $bcc = '', $subject, $msg);
                    // $isEmailSend=1;            
                    if ($isEmailSend) {

                        $status['msg'] = $this->systemmsg->getSucessCode(421);
                        $status['statusCode'] = validation_errors();
                        $status['flag'] = 'S';
                        $status['redirect'] = 'login';
                        echo json_encode($status);
                        exit;
                    } else {
                        $status['msg'] = $this->systemmsg->getErrorCode(236);
                        $status['statusCode'] = validation_errors();
                        $status['flag'] = 'F';
                        echo json_encode($status);
                        exit;
                    }
                }
            } else {
                $status['msg'] = $this->systemmsg->getErrorCode(237);
                $status['statusCode'] = 400;
                $status['flag'] = 'F';
                // $status['loadstate'] = false;
                echo json_encode($status);
                exit;
            }
        } else {
            $status['msg'] = $this->systemmsg->getErrorCode(238);
            $status['statusCode'] = 997;
            $status['data'] = array();
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
            echo json_encode($data);
            exit;
        }
    }

    public function updatePasswordForm($otpString = "") {
        //echo  $otpString;exit;
        //$otpString="NjE3MTRmMWQ5M2IzYQ==";
        $otpString = base64_decode($otpString);
        //echo $otpString; exit;
        $where = array("otp" => $otpString);
        $userData = $this->CommonModel->getMasterDetails('userregistration', 'otp,userID', $where);
        // print_r($userData);exit;
        if (isset($userData) && !empty($userData)) {
            $data = array();
            // $data['primaryMenu'] = $this->menuDetails;
            // $data['footerMenu'] = $this->footerMenuDetails;
            // $data['secondary'] = $this->isSecondary;
            // $data['pageDetails'] = "";
            // $data['css'] = "";
            $data['userID'] = $userData[0]->userID;
            // $data['globalcss'] = $this->globalCss;
            // $data['globalScript'] = $this->globalScript;

            $this->load->view('student/header-register', $data);
            $this->load->view('student/reset-password', $data);
            $this->load->view('student/footer');
        } else {
            $this->session->set_userdata('resetMsg', "Invalid link");
            redirect('forgot-password');
        }
    }

    public function updatePassword() {
        $this->form_validation->set_rules('userPass', 'password', 'required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');
        if ($this->form_validation->run() == false) {
            $status['msg'] = 'Please fill all the mandatory fields.';
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }

        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[userPass]');
        //echo $this->input->post('userPass');exit;
        //  echo $this->session->userdata('userID'); exit;
        $userID = $this->input->post('userid');
        if (empty($userID)) {
            if (!empty($this->session->userdata('tmpUserId'))) {
                $userID = $this->session->userdata('tmpUserId');
            }
        }
        if (empty($userID)) {
            $status['msg'] = $this->systemmsg->getErrorCode(239);
            $status['statusCode'] = 400;
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
        //$userID=$this->input->post('userID');
        if ($this->form_validation->run() == true) {

            //echo $userID=$this->input->GET('userID ');
            // echo $this->input->post('userPass');exit;

            $password = md5($this->input->post('userPass'));
            $userDetails = array("otp" => "", "password" => $password);
            // print_r($userDetails);exit;
            $isupdated = $this->CommonModel->updateMasterDetails("userregistration", $userDetails, array('userID ' => $userID));
            // print_r($isupdated);exit;
            if ($isupdated) {
                $status['msg'] = 'Password Has Been Updated';
                $status['flag'] = 'S';
                $this->session->unset_userdata('tmpUserId');
                $status['redirect'] = base_url() . "/login";
                echo json_encode($status);
                exit;
            } else {
                $status['msg'] = 'Somthing Went Wrong. Try Again.';
                $status['statusCode'] = validation_errors();
                $status['flag'] = 'F';
                echo json_encode($status);
                exit;
            }
        } else {
            $status['msg'] = 'Password Should be Match';
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
    }

    public function getcontactno() {
        $userId = $this->session->userdata('userId');

        $where = array("userType =" => 'User', "userID !=" => $userId);
        $usercontact = $this->CommonModel->getMasterDetails('userregistration', '*', $where);
        //print_r($usercontact->phoneNumber);exit;

        $number = array();
        foreach ($usercontact as $phone => $userphone) {
            //$dat = array();
            // $dat["name"] = $userphone->phoneNumber.' ('.$userphone->firstname.' '.$userphone->lastName.')';
            //$dat["phoneNumber"] = $userphone->phoneNumber;
            //$number[] = $dat;
            if (isset($userphone->phoneNumber) && !empty($userphone->phoneNumber)) {
                $number[] = $userphone->phoneNumber . '-(' . $userphone->firstname . ' ' . $userphone->lastName . ')';
            }
            //
        }

        echo json_encode($number);
        exit;
    }

    public function resetPassword() {
        $data['pageTitle'] = "KPIT sparkle | Reset Password";
        $data['metaDescription'] = "Reset Password";
        $data['metakeywords'] = "KPIT sparkle Reset password";
        $data['showLogin'] = "yes";
        $this->load->view('student/header-register', $data);
        $this->load->view('student/reset-password');
        $this->load->view('student/footer');
    }

    // public function registerUser(){
    //     // $wherestate = array("status=" =>'active');
    //     // $userState = $this->CommonModel->getMasterDetails('master_states','*',$wherestate);
    //     //print_r($userState);
    //     $userData=array();
    //      $userData['facebookUrl'] = $this->input->post('faceboolUrl');
    //      $userData['twitterUrl'] = $this->input->post('twitterUrl');
    //      $userData['instagramUrl'] = $this->input->post('instagramUrl');
    //      $userData['linkedInUrl'] = $this->input->post('linkedinUrl');
    //      $userData['state_id'] = $this->input->post('state');
    //      $userData['city_id'] = $this->input->post('city');
    //      $userData['college_id'] = $this->input->post('college');
    //      $userData['degree_id'] = $this->input->post('degree');
    //      $userData['yearOfCompletion'] = $this->input->post('YearOfCompletion');
    //      $userData['stream_id'] = $this->input->post('stream');
    //     echo(rand(10,100));exit;
    //     $isSave=$this->CommonModel->saveMasterDetails("userregistration",$userData); 
    // }
    public function registerUser() {

        $userData = array();
        $userData['firstname'] = $this->validatedata->validate('fname', 'First Name', true, '', array());
        $userData['lastName'] = $this->validatedata->validate('lname', 'Last Name', true, '', array());
        $userData['email'] = $this->validatedata->validate('email', 'Email', true, '', array());
        $userData['country_id'] = $this->validatedata->validate('countryCode', 'countryCode', true, '', array());
        $userData['phoneNumber'] = $this->validatedata->validate('contact', 'Contact Details', true, '', array());
        $userData['password'] = md5($this->validatedata->validate('password', 'Password', true, '', array()));
        $userData['cpassword'] = md5($this->validatedata->validate('cpassword', 'Confirm password', true, '', array()));
        $userData['gender'] = $this->validatedata->validate('gender', 'Gender', true, '', array());
        $userData['facebookUrl'] = $this->validatedata->validate('faceboolUrl', 'facebook URL', true, '', array());
        $userData['twitterUrl'] = $this->validatedata->validate('twitterUrl', 'Twitter URL', true, '', array());
        $userData['instagramUrl'] = $this->validatedata->validate('instagramUrl', 'Instagram URL', true, '', array());
        $userData['linkedInUrl'] = $this->validatedata->validate('linkedinUrl', 'Linkedin URL', true, '', array());
        $userData['state_id'] = $this->validatedata->validate('state', 'State Name', true, '', array());
        $userData['city_id'] = $this->validatedata->validate('city', 'City Name', true, '', array());
        $userData['college_id'] = $this->validatedata->validate('college', 'College Name', true, '', array());
        $userData['branch_id'] = $this->validatedata->validate('branch', 'Branch Name', true, '', array());
        $userData['degree_id'] = $this->validatedata->validate('degree', 'Degree Name', true, '', array());
        $userData['stream_id'] = $this->validatedata->validate('stream', 'Stream Name', true, '', array());
        $userData['email_otp'] = random_int(100000, 999999);
        $userData['sms_otp'] = random_int(1000, 9999);
        $userData['yearOfCompletion'] = $this->validatedata->validate('YearOfCompletion', 'Year of completion', true, '', array());
        $userData['identityCard'] = $this->input->post('identityCard');
        if ($userData['college_id'] == "other") {
            $userData['college_id'] = "";
            $userData['otherCollege'] = $this->validatedata->validate('otherCollege', 'Other College Name', true, '', array());
            $userData['city_id'] = "";
            $userData['otherCity'] = $this->validatedata->validate('otherCity', 'Other City Name', true, '', array());
        }
        //print_r( $userData);exit;
        $name = $userData['firstname'] . " " . $userData['lastName'];
        $where = array("email" => $userData['email']);
        $duplicateEmail = $this->CommonModel->getMasterDetails('userregistration', '', $where);
        //print_r($duplicateEmail);exit;
        if (isset($duplicateEmail) && !empty($duplicateEmail)) {
            $status['data'] = ""; //"Email Template Not Found. 'Email Verification'";
            $status['msg'] = "This email address has been used already.Please try another.";
            $status['statusCode'] = 996;
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
        // check duplicate contact number
        $where2 = array("phoneNumber" => $userData['phoneNumber']);
        $duplicateContact = $this->CommonModel->getMasterDetails('userregistration', '', $where2);
        if (isset($duplicateContact) && !empty($duplicateContact)) {
            $status['data'] = ""; //"Email Template Not Found. 'Email Verification'";
            $status['msg'] = "This contact number has been used already.Please try another.";
            $status['statusCode'] = 996;
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }

        if (!$this->input->post('g-recaptcha-response')) {
            $status['msg'] = "Catpcha Not Verified";
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        } else {
            $secKey = "6Ld0Sg4fAAAAALxuMTPYx10YB5AIs89Nfv0BnuCb";
            $ip = $_SERVER['REMOTE_ADDR'];
            $response = $this->input->post('g-recaptcha-response');
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secKey&response=$response&remoteip=$ip";
            $fire = file_get_contents($url);
            $data = json_decode($fire);
            // print_r($data->success);exit;
            if (!$data->success) {
                $status['msg'] = "Captcha Not Verified!";
                $status['statusCode'] = validation_errors();
                $status['flag'] = 'F';
                echo json_encode($status);
                exit;
            }
        }
        // $this->sendVerificationEmail($name,$userData['email_otp'],$userData['sms_otp'],$userData['email'],$userData['contactNo']);
        $this->sendVerificationEmail($name, $userData['email_otp'], $userData['email_otp'], $userData['email'], $userData['phoneNumber']);
        $iscreated = $this->CommonModel->saveMasterDetails('userregistration', $userData);

        if (!$iscreated) {
            $status['msg'] = "Something was wrong. Please try again";
            $status['statusCode'] = 998;
            $status['data'] = array();
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        } else {
            $rUserDetails = $this->CommonModel->getMasterDetails('userregistration', '', array("email" => $userData['email']));
            if (!empty($rUserDetails)) {
                $this->session->set_userdata('tmpotpUserId', $rUserDetails[0]->userID);
            }
            $status['msg'] = $this->systemmsg->getSucessCode(422);
            $status['statusCode'] = 400;
            $status['data'] = array();
            $status['flag'] = 'S';
            $email = $userData['email'];
//            $this->sendVerificationDone($name, $email);
            echo json_encode($status);
            exit;
        }
    }

    public function checkDuplicate() {
        $postData = $this->input->post();

        if ($postData['tocheck'] == "email") {
            // check duplicate email
            $where = array("email" => $postData['value']);
            $status['msg'] = "This email address has been used already.Please try another.";
        } else {
            // check duplicate contact number
            $where = array("phoneNumber" => $postData['value']);
            $status['msg'] = "This contact number has been used already.Please try another.'";
        }

        $duplicateEmail = $this->CommonModel->getMasterDetails('userregistration', '', $where);

        if (isset($duplicateEmail) && !empty($duplicateEmail)) {
            $status['data'] = ""; //"Email Template Not Found. 'Email Verification'";
            $status['statusCode'] = 996;
            $status['flag'] = 'F';
        } else {
            $status['msg'] = "Validated" . $postData['tocheck'];
            $status['statusCode'] = 400;
            $status['data'] = array();
            $status['flag'] = 'S';
        }
        echo json_encode($status);
        exit;
    }

    public function sendVerificationEmail($name, $otp, $smsotp, $email, $number) {
        $where = array("tempName" => "EmailVerification");
        $emailContent = $this->CommonModel->getMasterDetails('emailMaster', '', $where);
        if (!isset($emailContent) || empty($emailContent)) {
            $status['data'] = ""; //"Email Template Not Found. 'Email Verification'";
            $status['msg'] = "Email Template Not Found. 'Email Verification'";
            $status['statusCode'] = 996;
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
        $mailContent = str_replace("{{otp}}", $otp, $emailContent[0]->emailContent);
        $mailContent = str_replace("{{userName}}", $name, $mailContent);
        // $from= $this->config->item('supportEmail');
        $to = $email;
        $subject = $emailContent[0]->subject;
        // $fromName= "KPIT SHODH";  //$this->$this->fromName;
        $msg = $mailContent;

        // send sms Verification
//        if ($number != "") {
//            $message = str_replace("{{otp}}", $smsotp, $emailContent[0]->smsContent);
//            $url = "https://smsozone.com/api/mt/SendSMS?user=kpitpap&password=kpitpap@7654321&senderid=KSPRKL&channel=Trans&DCS=0&flashsms=0&number=$number&text=$message&route=2069";
//            $ch = curl_init($url);
//            curl_setopt($ch, CURLOPT_HEADER, false);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            //curl_setopt($ch, CURLOPT_POSTFIELDS);
//            $contents = curl_exec($ch);
//            curl_close($ch);
//        }

        return $isEmailSend = $this->emails->sendMailDetails($to, $cc = '', $bcc = '', $subject, $msg);
    }

    public function Verify() {
        $userId = $this->session->userdata('tmpotpUserId');
        $whereUser = array("userID=" => $userId);
        //print_r($whereUser);exit;
        $userDetails = $this->CommonModel->getMasterDetails('userregistration', '', $whereUser);
        if (isset($userDetails) && !empty($userDetails)) {
            $data['userDetails'] = $userDetails[0];
        } else {
            $data['userDetails'] = "";
        }
        //print_r($userDetails);exit;
        $data['pageTitle'] = "KPIT Sparkle | Student Verification";
        $data['metaDescription'] = "Student Verification";
        $data['metakeywords'] = "KPIT Sparkle student verification";
        $data['showLogin'] = "yes";
        $this->load->view('student/header-register', $data);
        $this->load->view('student/verify', $data);
        $this->load->view('student/footer');
    }

    public function resendOTP() {
        $dataId = $this->input->post('dataId');
        $userData['email_otp'] = random_int(1000, 9999);
        $whereupdateotp = array("userID=" => $dataId);
        $updateemailotp = $this->CommonModel->updateMasterDetails('userregistration', $userData, $whereupdateotp);
        if (!empty($updateemailotp)) {
            $getuserdata = $this->CommonModel->getMasterDetails('userregistration', '', $whereupdateotp);
            //print_r($getuserdata);exit;
            $name = $getuserdata[0]->firstname . ' ' . $getuserdata[0]->lastName;
            $email_otp = $getuserdata[0]->email_otp;
            $email = $getuserdata[0]->email;
            $phone = $getuserdata[0]->phoneNumber;
            $this->sendVerificationEmail($name, $email_otp, $email_otp, $email, $phone);
            $status['msg'] = "Email Has Been Send To Register Email Id";
            $status['statusCode'] = 998;
            $status['data'] = array();
            $status['flag'] = 'S';
        } else {
            $status['msg'] = "Something was wrong. Please try again";
            $status['statusCode'] = 400;
            $status['data'] = array();
            $status['flag'] = 'F';
        }
        echo json_encode($status);
        exit;
        //echo $dataId;exit;
    }

    public function checkOTP() {
        //$email = $this->validatedata->validate('email','Email',true,'',array());
        //$email_otp = $this->validatedata->validate('email_otp','Email OTP',false,'',array());
        //echo $email_otp;
        // $this->form_validation->set_rules
        $this->form_validation->set_rules('email_otp', 'Email OTP', 'required');
        $email_otp = $this->input->post('email_otp');
        //echo $email_otp;


        if ($this->form_validation->run() == true) {
            $whereverify = array("email_otp=" => $email_otp);
            //print_r($whereverify);
            $userDetails = $this->CommonModel->getMasterDetails('userregistration', '', $whereverify);
            //print_r($userDetails);exit;
            if (!empty($userDetails)) {
                $status['data'] = ""; //"Email Template Not Found. 'Email Verification'";
                $status['msg'] = "Email verification completed successfully";
                $arr = array();
                if ($userDetails[0]->email_otp == $email_otp) {
                    $arr['verify_email'] = "yes";
                }
                $where = array("userID" => $userDetails[0]->userID);
                $userDetailsUP = $this->CommonModel->updateMasterDetails('userregistration', $arr, $where);
                //$msg= "Incorrect OTP.";
                // if(isset($arr['verify_email']) && isset($arr['verify_contact'])){
                //     $msg = "Email verification completed successfully";
                // }elseif(isset($arr['verify_email'])){
                //     $msg = "Email verification completed successfully";
                // }

                $status['statusCode'] = 996;
                $status['flag'] = 'S';
                $status['redirect'] = base_url() . "login";
                $name = $userDetails[0]->firstname . " " . $userDetails[0]->lastName;
                $this->sendVerificationDone($name, $userDetails[0]->email);
                echo json_encode($status);
                exit;
            } else {
                $status['data'] = ""; //"Email Template Not Found. 'Email Verification'";
                $status['msg'] = "Invalid OTP";
                $status['statusCode'] = 996;
                $status['flag'] = 'F';
                echo json_encode($status);
                exit;
            }
        }
        // $status['data'] = "";//"Email Template Not Found. 'Email Verification'";
        // $status['msg'] = $msg;
        // $status['statusCode'] = 996;
        // $status['flag'] = 'S';
        // $status['redirect'] = base_url()."login";
        // $name = $userDetails[0]->firstname." ".$userDetails[0]->lastname;
        // $this->sendVerificationDone($name,$email);
        //echo json_encode($status); exit;
    }

    public function sendVerificationDone($name, $email) {
        $where = array("tempName" => "registration");
        $emailContent = $this->CommonModel->getMasterDetails('emailMaster', '', $where);
        if (!isset($emailContent) || empty($emailContent)) {
            $status['data'] = ""; //"Email Template Not Found. 'Email Verification'";
            $status['msg'] = "Email Template Not Found. 'Account Verification'";
            $status['statusCode'] = 996;
            $status['flag'] = 'F';
            echo json_encode($status);
            exit;
        }
        $mailContent = str_replace("{{username}}", $name, $emailContent[0]->emailContent);
        $from = $this->config->item('supportEmail');
        $to = $email;
        $subject = $emailContent[0]->subject;
        $fromName = "KPIT Sparkle";  //$this->$this->fromName;
        $msg = $mailContent;

        return $isEmailSend = $this->emails->sendMailDetails($to, $cc = '', $bcc = '', $subject, $msg);
    }

    public function getCityList() {
        //$stateID= $this->input->post('stateID');
        $college_id = $this->input->post('college_id');
        // echo $college_id."<br>";
        $whereclg = array("status =" => "'active'", "college_id=" => $college_id);
        $clgList = $this->CommonModel->GetMasterListDetails('*', "master_college", $whereclg, '', '', $join = array(), $other = array());
        //  print_r($clgList);
        //  echo "<br>";
        $city_id = $clgList[0]->city_id;
        //echo $city_id;exit;
        //echo $college_id."<br>";exit;
        //echo "<br>";
        if (isset($city_id)) {
            $where = array("status =" => "'active'", "city_id=" => $city_id);
            $mstercat = $this->CommonModel->GetMasterListDetails('*', "master_cities", $where, '', '', $join = array(), $other = array());
            //print_r($mstercat);
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

    public function getCollegelist() {
        // $city_id= $this->input->post('city_id');
        $stateID = $this->input->post('stateID');
        //echo $stateID."<br>";
        if (isset($stateID)) {
            $whereCollege = array("status =" => "'active'", "state_id=" => $stateID);
            $mstercat = $this->CommonModel->GetMasterListDetails('*', "master_college", $whereCollege, '', '', $join = array(), $other = array());
            //print_r($mstercat);
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

    public function uploadfile() {

        $this->load->library('realtimeupload');
        $name = $this->input->post('name');

        $fullPath = $this->config->item("ICARD_PATH");

        if (!is_dir($fullPath)) {
            mkdir($fullPath, 0777);
            chmod($fullPath, 0777);
        } else {
            if (!is_writable($fullPath)) {
                chmod($fullPath, 0777);
            }
        }

        $config = array();
        $config['upload_path'] = $fullPath;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 50000;
        $this->load->library('upload', $config);
        $settings = array(
            'uploadFolder' => $fullPath,
            'extension' => array('pdf', 'jpeg', 'jpg', 'png'),
            'maxFolderFiles' => 0,
            'maxFolderSize' => 0,
            'returnLocation' => true,
            'uniqueFilename' => false,
            'isSaveToDB' => "N",
            'maxFileSize' => 100000,
        );
        if ($this->session->userdata('userId')) {
            $settings['dbTable'] = 'userregistration';
            $settings['fileTypeColumn'] = '';
            $settings['fileColumn'] = 'identityCard';
            $settings['forignKey'] = 'userID';
            $settings['forignValue'] = $this->session->userdata('userId');
            $settings['extraData'] = array("userID" => $this->session->userdata('userId'));
            $settings["isSaveToDB"] = "Y";
        }
        //echo print_r($settings);exit;
        $this->realtimeupload->init($settings);
        exit;
    }

    public function removeicard() {
        $image = $this->input->post('imgname');
        if (isset($image) && !empty($image)) {
            $path = $this->config->item('ICARD_PATH');
            if (file_exists($path . $image)) {
                unlink($path . $image);
                $status['msg'] = $this->systemmsg->getSucessCode(400);
                $status['data'] = "";
                $status['flag'] = 'S';
                echo json_encode($status);
                exit;
            } else {
                $status['msg'] = $this->systemmsg->getSucessCode(400);
                $status['data'] = "";
                $status['flag'] = 'S';
                echo json_encode($status);
                exit;
            }
        }
    }

}
