<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myaccount extends CI_Controller {

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
            redirect('logout');
            exit;
        }


        $join = array();
		$join[0]['type'] ="LEFT JOIN";
		$join[0]['table']="master_college";
        $join[0]['alias'] ="c";
		$join[0]['key1'] ="college_id";
		$join[0]['key2'] ="college_id";

        $join[1]['type'] ="LEFT JOIN";
		$join[1]['table']="master_cities";
        $join[1]['alias'] ="city";
		$join[1]['key1'] ="city_id";
		$join[1]['key2'] ="city_id ";
        $where=array("t.userID="=>$this->session->userdata('userId'));
       // print_r($where);
        $select = "t.*,c.college_name,city.city_name";
         
         $userData = $this->CommonModel->GetMasterListDetails($select,'userregistration',$where,'','',$join,'');
         //print_r($userData);
        // exit;
        // $where=array("status ="=>"'active'"); 
        // $userState = $this->CommonModel->GetMasterListDetails('','master_states',$where,'','','','');
        $wherestate = array("status=" =>'active',"country_id="=>'101');
        $userState = $this->CommonModel->getMasterDetails('master_states','*',$wherestate);
        $userCollege = $this->CommonModel->getMasterDetails('master_college','','');
        $where=array("status ="=>"'active'");
        $userCity = $this->CommonModel->GetMasterListDetails('','master_cities',$where,'30','','','');
        // $select="t.*";
        $where=array("status ="=>"'active'");
        $userDegree = $this->CommonModel->GetMasterListDetails('','master_degree',$where,'','','','');
        $where=array("status ="=>"'active'");
        $userStream = $this->CommonModel->GetMasterListDetails('','master_stream',$where,'','','','');
        
        
            $data=array();
            if(isset($userData)&& !empty($userData))
            {
                $data['userData'] = $userData[0];
                //print_r($userData); echo "<br/>";exit;
            }else{
                $data['userData'] = "";
            }

            if(isset($userState)&& !empty($userState))
            {
                $data['userState'] = $userState;
               //print_r($userState);exit;
            }else{
                $data['userState'] = "";
            }

            if(isset($userCollege)&& !empty($userCollege))
            {
                $data['userCollege'] = $userCollege;
               //print_r($userCollege);exit;
            }else{
                $data['userCollege'] = "";
            }

            if(isset($userCity)&& !empty($userCity))
            {
                $data['userCity'] = $userCity;
               //print_r($userCity);exit;
            }else{
                $data['userCity'] = "";
            }

            if(isset($userDegree)&& !empty($userDegree))
            {
                $data['userDegree'] = $userDegree;
               //print_r($userDegree);exit;
            }else{
                $data['userDegree'] = "";
            }

            if(isset($userStream)&& !empty($userStream))
            {
                $data['userStream'] = $userStream;
               //print_r($userStream);exit;
            }else{
                $data['userStream'] = "";
            }

            $userID=$this->session->userdata('userId');
            $whereuserid=array("userID="=>$userID);
            $infoGuidedData = $this->CommonModel->GetMasterListDetails("*",'guidedstatus',$whereuserid,'','',array(),'');

            $data['pageTitle']="KPIT sparkle | Student Dashboard";
            $data['metaDescription']="Student Dashboard";
            $data['metakeywords']="KPIT sparkle Student Dashboard";
            $data['infoGuidedData']=$infoGuidedData;
            $this->load->view('student/header',$data);
            $this->load->view('student/myAccount',$data);
            $this->load->view('student/footer');
	}

    
    public function updateEducationalProfile(){

        // $config['upload_path']='./images/eduDocs';
        // $config['allowed_types']='gif|jpg|png';
        // $config['max_size']= '2048';
       
        // $this->load->library('upload',$config);

        // if (!$this->upload->do_upload('img'))
        // {
        //         $error = $this->upload->display_errors();
        // }
        // else
        // {
        //        $file_data=$this->upload->data();

        // }
        // else
        // {
        //         $data = array('upload_data' => $this->upload->data());

        //         print_r($data); exit;

        //         $this->load->view('upload_success', $data);
        // }
       
        
        if(empty($this->session->userdata('userId')))
        {
            redirect('logout');
            exit;
        }
        $this->form_validation->set_rules('state_id', 'State','required'); 
        $this->form_validation->set_rules('college', 'College','required'); 
        $this->form_validation->set_rules('city', 'City','');
        $this->form_validation->set_rules('degree_id', 'Degree','required');
        $this->form_validation->set_rules('stream_id', 'Stream','required');
        $this->form_validation->set_rules('yearofcom', 'Year of Completion','required');
        //$this->form_validation->set_rules('id_img', 'College Identity Card','required');
       //echo $state= $this->input->post('state');exit;
        if($this->form_validation->run() == false)
        {
            $status['msg'] = 'Please fill all the mandatory fields.'; 
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        } 
    //     echo $this->input->post('userid');
    //    echo $this->input->post('state_id');
    //    echo $this->input->post('college_id');
    //    echo $this->input->post('city_id'); 
    //    echo $this->input->post('degree_id'); 
    //    echo $this->input->post('stream_id'); 
    //    echo $this->input->post('yearofcom');exit;
         
         if($this->form_validation->run() == true){ 

            //echo $userID=$this->input->GET('userID ');
            // echo $this->input->post('userPass');exit;
            $userID= $this->input->post('userid');
            $state= $this->input->post('state_id');
            $college= $this->input->post('college');
            $city= $this->input->post('city');
            $degree= $this->input->post('degree_id');
            $stream= $this->input->post('stream_id');
            $yearofcom= $this->input->post('yearofcom');
            $otherCollege='';
            $otherCity='';
            
            if($college == "other"){
                $this->form_validation->set_rules('otherCollege', 'Other College Name','required');
                $this->form_validation->set_rules('otherCity', 'Other City Name','required');
                $college="0"; 
                $city="0"; 
                $otherCollege = $this->input->post('otherCollege');
                $otherCity = $this->input->post('otherCity');
               
            }

            $userDetails=array("state_id"=> $state,"college_id"=>$college,"city_id"=>$city,"otherCollege"=>$otherCollege,"otherCity"=>$otherCity,"degree_id"=>$degree,"stream_id"=>$stream,"yearOfCompletion"=>$yearofcom);
            
            $config['upload_path']          = './uploads/student_icards';
            $config['allowed_types']        = 'pdf|jpg|jpeg|png';
            $config['max_size']             = 200;
            if(isset($_FILES['id_img'])){

                $this->load->library('upload', $config);
                if ( $this->upload->do_upload('id_img'))
                {
                    $upload_data = $this->upload->data();
                    $userDetails["identityCard"] = $upload_data["file_name"];
                }else{
                    echo "failed";
                }
            }
             //print_r($userDetails);exit;
            $isupdated = $this->CommonModel->updateMasterDetails("userregistration",$userDetails,array('userID '=>$userID));
             //print_r($isupdated);exit;
            if($isupdated)
            {
                $this->CommonModel->logUserActivity("Student edcation details updated", "PROFILE_UPDATED" , $userID);
                $status['msg'] = 'Profile Has Been Updated'; 
                $status['flag'] = 'S';
                $status['redirect'] = base_url()."/student/dashboard";
                echo json_encode($status); exit;
            }else
            {
                $status['msg'] = 'Somthing Went Wrong. Try Again.'; 
                $status['statusCode'] = validation_errors();
                $status['flag'] = 'F';
                echo json_encode($status); exit;
            }

         }else
         {
            $status['msg'] = 'Data Should be Match'; 
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status); exit;

         }
    }

    public function updateReferenceProfile(){
        $this->form_validation->set_rules('ref1_fname', 'Reference1 First Name','required'); 
        $this->form_validation->set_rules('ref1_lname', 'Reference1 Last Name','required'); 
        $this->form_validation->set_rules('ref1_email', 'Reference1 Email','required');
        $this->form_validation->set_rules('ref1_phone', 'Reference1 Contact Number','required');
        $this->form_validation->set_rules('ref1_designation', 'Reference1 Designation','required');
        $this->form_validation->set_rules('ref2_fname', 'Reference2 First Name','required'); 
        $this->form_validation->set_rules('ref2_lname', 'Reference2 Last Name','required'); 
        $this->form_validation->set_rules('ref2_email', 'Reference2 Email','required');
        $this->form_validation->set_rules('ref2_phone', 'Reference2 Contact Number','required');
        $this->form_validation->set_rules('ref2_designation', 'Reference2 Designation','required');

        $userID= $this->input->post('userid');
        $ref1_fname= $this->input->post('ref1_fname');
        $ref1_lname= $this->input->post('ref1_lname');
        $ref1_email= $this->input->post('ref1_email');
        $ref1_phone= $this->input->post('ref1_phone');
        $ref1_designation= $this->input->post('ref1_designation');
        $ref2_fname= $this->input->post('ref2_fname');
        $ref2_lname= $this->input->post('ref2_lname');
        $ref2_email= $this->input->post('ref2_email');
        $ref2_phone= $this->input->post('ref2_phone');
        $ref2_designation= $this->input->post('ref2_designation');
        if($this->form_validation->run() == false)
        {
            $status['msg'] = 'Please fill all the mandatory fields.'; 
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        } 
    //     echo $this->input->post('userid');
    //    echo $this->input->post('ref1_fname');
    //    echo $this->input->post('ref1_lname');
    //    echo $this->input->post('ref1_email'); 
    //    echo $this->input->post('ref1_phone'); 
    //    echo $this->input->post('ref1_designation'); 
    //    echo $this->input->post('ref2_fname');
    //    echo $this->input->post('ref2_lname');
    //    echo $this->input->post('ref2_email');
    //    echo $this->input->post('ref2_phone');
    //    echo $this->input->post('ref2_designation'); exit;
         if($this->form_validation->run() == true){ 

            //echo $userID=$this->input->GET('userID ');
            // echo $this->input->post('userPass');exit;
           
            // $id_img= $this->input->post('id_img');
            // $id_img ="img.png";
            $userDetails=array("ref1FirstName"=> $ref1_fname,"ref1LastName"=>$ref1_lname,"ref1Email"=>$ref1_email,"ref1ConcatNo"=>$ref1_phone,"ref1Designation"=>$ref1_designation,"ref2FirstName"=>$ref2_fname,"ref2LastName"=>$ref2_lname,"ref2Email"=>$ref2_email,"ref2ContactNo"=>$ref2_phone,"	ref2Designation"=>$ref2_designation);
             //print_r($userDetails);exit;
            $isupdated = $this->CommonModel->updateMasterDetails("userregistration",$userDetails,array('userID '=>$userID));
             //print_r($isupdated);exit;
            if($isupdated)
            {
                $this->CommonModel->logUserActivity("Student refrence details updated", "PROFILE_UPDATED" , $userID);
                $status['msg'] = 'Refrence Details Has Been Updated'; 
                $status['flag'] = 'S';
                $status['redirect'] = base_url()."/student/dashboard";
                echo json_encode($status); exit;
            }else
            {
                $status['msg'] = 'Somthing Went Wrong. Try Again.'; 
                $status['statusCode'] = validation_errors();
                $status['flag'] = 'F';
                echo json_encode($status); exit;
            }

         }else
         {
            $status['msg'] = 'Data Should be Match'; 
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
            
        }
    }
    
    public function SetprofilePic(){
        //$this->load->model('user_model');
        $this->load->library('slim');
        $imagename = 'profile_' . time() . "_1.png";
        //echo  $imagename;exit;
        // Get posted data, if something is wrong, exit
        try {
            $images = $this->slim->getImages();
            //  print_r($_POST['']);exit;
             // print_r($images) ; exit;
        }
        catch (Exception $e) {
            
            // Possible solutions
            // ----------
            // Make sure you're running PHP version 5.6 or higher
            
         $this->slim->outputJSON(array(
             'status' => SlimStatus::FAILURE,
             'message' => 'Unknown'
            ));
            
            //echo "sayali"; 
         return;
         }
 
         // No image found under the supplied input name
         if ($images === false) {
             
             $this->slim->outputJSON(array(
                 'status' => SlimStatus::FAILURE,
                 'message' => 'No data posted'
         ));
 
         return;
         }
 
         // Should always be one image (when posting async), so we'll use the first on in the array (if available)
         $image = array_shift($images);
          //print_r($image); exit;
         if (!isset($image)) {
 
         $this->slim->outputJSON(array(
         'status' => SlimStatus::FAILURE,
         'message' => 'No images found'
         ));
 
         return;
         }
 
         if (!isset($image['output']['data']) && !isset($image['input']['data'])) {
 
         $this->slim->outputJSON(array(
         'status' => SlimStatus::FAILURE,
         'message' => 'No image data'
         ));
 
         return;
         }
 
         // if we've received output data save as file
         if (isset($image['output']['data'])) {
 
         // get the name of the file
         $name = $image['output']['name'];
            // echo $name;exit;
         // get the crop data for the output image
         $data = $image['output']['data'];
         // echo $data; exit;
         // If you want to store the file in another directory pass the directory name as the third parameter.
         // $file = Slim::saveFile($data, $name, 'my-directory/');
 
         // If you want to prevent Slim from adding a unique id to the file name add false as the fourth parameter.
         // $file = Slim::saveFile($data, $name, 'tmp/', false);
        $profileurl = $this->config->item('PROFILE_IMAGE_PATH');
        //echo $profileurl;  exit;
         $output =$this->slim->saveFile($data, $imagename,$profileurl,false);
        //  echo $data;
        //  echo $name;
        //  echo $profileurl;
        //  print_r($output); exit;
         }
 
         // if we've received input data (do the same as above but for input data)
         if (isset($image['input']['data'])) {
 
         // get the name of the file
         $name = $image['input']['name'];
 
         // get the crop data for the output image
         $data = $image['input']['data'];
 
         // If you want to store the file in another directory pass the directory name as the third parameter.
         // $file = Slim::saveFile($data, $name, 'my-directory/');
 
         // If you want to prevent Slim from adding a unique id to the file name add false as the fourth parameter.
         // $file = Slim::saveFile($data, $name, 'tmp/', false);
         $input = $this->slim->saveFile($data, $name,$profileurl,false);
         
 
         }
 
 
 
         //
         // Build response to client
         //
         $response = array(
         'status' => SlimStatus::SUCCESS
         );
 
         if (isset($output) && isset($input)) {
 
         $response['output'] = array(
         'file' => $output['name'],
         'path' => $output['path']
         );
 
         $response['input'] = array(
         'file' => $input['name'],
         'path' => $input['path']
         );
 
         }
         else {
             $response['file'] = isset($output) ? $output['name'] : $input['name'];
             $response['path'] = isset($output) ? $output['path'] : $input['path'];
         }
 
 
         //$data = array('profilePic' => $imagename);
        //   print_r($data); exit;
          //print_r($imagename);exit;
          $userDetails=array("profilePic"=> $imagename);
          $userID = $this->session->userdata['userId'];
         //$isrename = rename($profileurl.$response['file'],$profileurl . $imagename);
         $isupdate = $this->CommonModel->updateMasterDetails("userregistration",$userDetails, array('userID '=>$userID));
         $this->session->unset_userdata('proImg');
            $this->session->set_userdata('proImg',$imagename);
             /*if (isset($_SESSION['USER']['profile_pic']) && !empty($_SESSION['USER']['profile_pic'])) {
                 if ($_SESSION['USER']['profile_pic'] != 'default') {
 
                     if(file_exists($_SERVER["DOCUMENT_ROOT"].'/internationaleducators/uploads/profile_pic/' . $_SESSION['USER']['profile_pic'])){
                     unlink($_SERVER["DOCUMENT_ROOT"].'/internationaleducators/uploads/profile_pic/' . $_SESSION['USER']['profile_pic']);
                     }
 
                 }
             }*/
            //  $_SESSION['USER']['profile_pic'] = $imagename;
            //  $this->slim->outputJSON($response);
            //  exit;

    }

    public function updateResourcesProfile(){

       
        if(empty($this->session->userdata('userId')))
        {
            redirect('logout');
            exit;
        }

        // $this->form_validation->set_rules('profilepic', 'Profilr Pic','required');
        /*$this->form_validation->set_rules('facebookUrl', 'Facebook URL','required'); 
        $this->form_validation->set_rules('twitterUrl', 'Twitter URL','required'); 
        $this->form_validation->set_rules('instagramUrl', 'Instagram URL','required');
        $this->form_validation->set_rules('linkedInUrl', 'LinkedIn URL','required');
        
        
        if($this->form_validation->run() == false)
        {
            $status['msg'] = 'Please fill all the mandatory fields.'; 
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status); exit;
        }*/ 

            //echo $profile_pic;
            // echo $this->input->post('userid');
            // echo  $this->input->post('profilepic');
            // echo  $this->input->post('old_profilepic');
            // echo $this->input->post('facebookUrl');
            // echo $this->input->post('twitterUrl');
            // echo $this->input->post('instagramUrl');  
            // echo $this->input->post('linkedInUrl');exit;
         //if($this->form_validation->run() == true)
         { 

            //echo $userID=$this->input->GET('userID ');
            // echo $this->input->post('userPass');exit;
            $userID= $this->input->post('userid');
            // $profilepic=  $this->input->post('profilepic');
            $facebookUrl= $this->input->post('facebookUrl');
            $twitterUrl= $this->input->post('twitterUrl');
            $instagramUrl= $this->input->post('instagramUrl');
            $linkedInUrl= $this->input->post('linkedInUrl');
            
            $userDetails=array("facebookUrl"=> $facebookUrl,"twitterUrl"=>$twitterUrl,"instagramUrl"=>$instagramUrl,"linkedInUrl"=>$linkedInUrl);
             //print_r($userDetails);exit;
            $isupdated = $this->CommonModel->updateMasterDetails("userregistration",$userDetails,array('userID '=>$userID));
             //print_r($isupdated);exit;
            if($isupdated)
            {
                $this->CommonModel->logUserActivity("Student resources details updated", "PROFILE_UPDATED" , $userID);
                $status['msg'] = 'Resources Has Been Updated'; 
                $status['flag'] = 'S';
                $status['redirect'] = base_url()."/student/dashboard";
                echo json_encode($status); exit;
            }else
            {
                $status['msg'] = 'Somthing Went Wrong. Try Again.'; 
                $status['statusCode'] = validation_errors();
                $status['flag'] = 'F';
                echo json_encode($status); exit;
            }

         }/*else
         {
            $status['msg'] = 'Data Should be Match'; 
            $status['statusCode'] = validation_errors();
            $status['flag'] = 'F';
            echo json_encode($status); exit;

         }*/
    }
    public function getCollege()
    {
        // $city_id= $this->input->post('city_id');
        $stateID= $this->input->post('stateID');
        //echo $stateID."<br>";
        if(isset($stateID))
        {
            $whereCollege=array("status ="=>"'active'","state_id="=>$stateID);
            $mstercat=$this->CommonModel->GetMasterListDetails('*',"master_college",$whereCollege,'','',$join=array(),$other=array());
               //print_r($mstercat);exit;
            if(!empty($mstercat))
            {
                $status['data'] = $mstercat; 
                $status['flag'] = 'S';
                echo json_encode($status); exit;
            }else
            {
                $status['data'] = ""; 
                $status['flag'] = 'F';
                echo json_encode($status); exit;   
            }
            
        }
    }
    public function getCity()
    {
        $college_id= $this->input->post('college_id');
        //echo $college_id;
        $whereclg = array("status ="=>"'active'","college_id="=>$college_id);
        $clgList=$this->CommonModel->GetMasterListDetails('*',"master_college",$whereclg,'','',$join=array(),$other=array());
         // print_r($clgList);
         // echo "<br>";
        $city_id = $clgList[0]->city_id;
        //echo $city_id;
        //echo $college_id."<br>";exit;
        //echo "<br>";
        if(isset($city_id))
        {
            $where=array("status ="=>"'active'","city_id="=>$city_id);
            $mstercat=$this->CommonModel->GetMasterListDetails('*',"master_cities",$where,'','',$join=array(),$other=array());
              //print_r($mstercat);exit;
            if(!empty($mstercat))
            {
                $status['data'] = $mstercat; 
                $status['flag'] = 'S';
                echo json_encode($status); exit;
            }else
            {
                $status['data'] = ""; 
                $status['flag'] = 'F';
                echo json_encode($status); exit;   
            }
            
        }
    }
    
}

//unlink("uploads/".$group_picture);