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

        $this->CommonModel->validateUserType("Admin");
        // $whereque=array("status ="=>"'active'");
        // $adminData = $this->CommonModel->GetMasterListDetails('*','trl_users_question_answers',$whereque,'','','','');
        // //print_r($adminData);exit;
        // foreach($adminData as $key=>$ansdetails){
        //     $ansUseId = $ansdetails->userID;
        //     echo $ansUseId;
        //     echo "<br>";

        //     $where = array("status="=>"'active'","userID="=>$ansUseId);
        //     $ansData = $this->CommonModel->GetMasterListDetails('*','trl_users_question_answers',$whereque,'','','','');
        //     print_r($ansData);
        //     echo "<br>";
        // }
        // exit;
        // echo $ansUseId;
        $userId = $this->session->userdata('userId');
        $join = array();
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

        $join[2]['type'] ="LEFT JOIN";
		$join[2]['table']="userregistration";
        $join[2]['alias'] ="usr";
		$join[2]['key1'] ="userID";
		$join[2]['key2'] ="userID";

        $join[3]['type'] ="LEFT JOIN";
		$join[3]['table']="master_college";
		$join[3]['t1alias']="usr";
        $join[3]['alias'] ="clg";
		$join[3]['key1'] ="college_id";
		$join[3]['key2'] ="college_id";
        

         //$where=array("projectID"= 2);
         $select="t.*,c.category_name,sc.sub_cat_name,clg.is_top_100,clg.is_premier,(select count(msg_id) from ab_project_messages where ab_project_messages.project_id = t.projectID and msg_id > ( SELECT IFNULL((select lastReadMsgId from ab_project_messages_read_stats where ab_project_messages_read_stats.userID = ".$userId." and ab_project_messages_read_stats.projectID = t.projectID),0))) as msg_count";
         //$select="t.*,c.category_name,sc.sub_cat_name,clg.is_top_100,clg.is_premier,(select count(msg_id) from ab_project_messages where ab_project_messages.project_id = t.projectID and msg_id > (SELECT IFNULL( (SELECT lastReadMsgId FROM ab_project_messages_read_stats where ab_project_messages_read_stats.userID = ".$userId." and ab_project_messages_read_stats.projectID = ab_project_messages_read_stats.projectID = t.projectID), 0))) as msg_count";
         $where=array("t.status ="=>"'active'", "phaseOneDataSubmited = "=>1,"t.currentPhase="=>"1","t.patentStatus="=>"' '","t.projectStatus="=>"' '");
         //print_r($where);exit;
        // $adminData = $this->CommonModel->GetMasterListDetails($select,'project_master',$where,'10','',$join,'');
        $adminData = $this->CommonModel->GetMasterListDetails($select,'project_master',$where,'','',$join,'');	
        //print_r($adminData); exit;
        $whereapprove=array("t.status ="=>"'active'","t.projectStatus="=>"'Approved'");
        // $adminData = $this->CommonModel->GetMasterListDetails($select,'project_master',$where,'10','',$join,'');
        $approvestatus = $this->CommonModel->GetMasterListDetails($select,'project_master',$whereapprove,'','',$join,'');
        //echo ($approvestatus->userID[0]);exit;
        $wherereject=array("t.status ="=>"'active'","t.projectStatus="=>"'Reject'");
        // $adminData = $this->CommonModel->GetMasterListDetails($select,'project_master',$where,'10','',$join,'');
        $rejectstatus = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherereject,'','',$join,'');
        $wherehold=array("t.status ="=>"'active'","t.projectStatus="=>"'Hold'");
        // $adminData = $this->CommonModel->GetMasterListDetails($select,'project_master',$where,'10','',$join,'');
        $holdstatus = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherehold,'','',$join,'');

        $wherephasetwo=array("t.status ="=>"'active'","t.projectStatus="=>"'Approved'","t.currentPhase<"=>"3","t.phaseTwoDataSubmited="=>"1","t.phaseTwoStatus="=>"''");
        //$wherephasetwo=array("t.status ="=>"'active'","t.projectStatus="=>"'Approved'","t.currentPhase<"=>"3","t.phaseTwoDataSubmited="=>"1","t.phaseTwoStatus!="=>"'Hold'","t.phaseTwoStatus!="=>"'Reject'");
        $phasetwoall = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherephasetwo,'','',$join,'');
        
        $wherephasetwoapprove=array("t.status ="=>"'active'","t.phaseTwoStatus="=>"'Approved'","t.currentPhase>="=>"2");
        $phasetwoapprovestatus = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherephasetwoapprove,'','',$join,'');

        $wherephasetworeject=array("t.status ="=>"'active'","t.phaseTwoStatus="=>"'Reject'");
        $phasetworejecttatus = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherephasetworeject,'','',$join,'');

        $wherephasetwohold=array("t.status ="=>"'active'","t.phaseTwoStatus="=>"'Hold'");
        $phasetwoholdstatus = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherephasetwohold,'','',$join,'');
        //condition "t.phaseThreeStatus="=>"' '"
        $wherephasethreeall=array("t.status ="=>"'active'","t.phaseTwoStatus="=>"'Approved'");
        //print_r($wherephasethreeall);exit;
        $phasethreeall = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherephasethreeall,'','',$join,'');
        //print_r($phasethreeall);exit;
        $wherefifty=array("t.status ="=>"'active'","t.phaseThreeStatus="=>"'50'");
        // $adminData = $this->CommonModel->GetMasterListDetails($select,'project_master',$where,'10','',$join,'');
        $fiftystatus = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherefifty,'','',$join,'');
        $wherehuntwo=array("t.status ="=>"'active'","t.phaseThreeStatus="=>"'bottom50'");
        // $adminData = $this->CommonModel->GetMasterListDetails($select,'project_master',$where,'10','',$join,'');
        $huntwostatus = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherehuntwo,'','',$join,'');
        $wherebottom=array("t.status ="=>"'active'","t.phaseThreeStatus="=>"'200'");
        // $adminData = $this->CommonModel->GetMasterListDetails($select,'project_master',$where,'10','',$join,'');
        $bottomstatus = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherebottom,'','',$join,'');
        //print_r($bottomstatus);exit;
        //$huntwostatus = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherehuntwo,'','',$join,'');

        $wherefinalists=array("t.status ="=>"'active'","t.phaseThreeStatus in ('50'"=>",'Between_100-200')");
        $finalists = $this->CommonModel->GetMasterListDetails($select,'project_master',$wherefinalists,'','',$join,'');

            $data=array();
            if(isset($adminData)&& !empty($adminData))
            {
                 $data['adminData'] = $adminData;
                //print_r($data['adminData']);exit;
                
            }else{
                $data['adminData'] = "";
            }
            if(isset($approvestatus)&& !empty($approvestatus))
            {
                 $data['approvestatus'] = $approvestatus;
                //print_r($data['approvestatus']);exit;
                
            }else{
                $data['approvestatus'] = "";
            }
            if(isset($rejectstatus)&& !empty($rejectstatus))
            {
                 $data['rejectstatus'] = $rejectstatus;
                //print_r($data['rejectstatus']);exit;
            }else{
                $data['rejectstatus'] = "";
            }
            if(isset($holdstatus)&& !empty($holdstatus))
            {
                 $data['holdstatus'] = $holdstatus;
                //print_r($data['holdstatus']);exit;
            }else{
                $data['holdstatus'] = "";
            }
            if(isset($phasetwoall)&& !empty($phasetwoall))
            {
                 $data['phasetwoall'] = $phasetwoall;
                //print_r($data['phasetwoapprovestatus']);exit;
            }else{
                $data['phasetwoapprovestatus'] = "";
            }
            if(isset($phasetwoapprovestatus)&& !empty($phasetwoapprovestatus))
            {
                 $data['phasetwoapprovestatus'] = $phasetwoapprovestatus;
                //print_r($data['phasetwoapprovestatus']);exit;
            }else{
                $data['phasetwoapprovestatus'] = "";
            }
            if(isset($phasetworejecttatus)&& !empty($phasetworejecttatus))
            {
                 $data['phasetworejecttatus'] = $phasetworejecttatus;
                //print_r($data['phasetworejecttatus']);exit;
            }else{
                $data['phasetworejecttatus'] = "";
            }
            if(isset($phasetwoholdstatus)&& !empty($phasetwoholdstatus))
            {
                 $data['phasetwoholdstatus'] = $phasetwoholdstatus;
                //print_r($data['phasetwoholdstatus']);exit;
            }else{
                $data['phasetwoholdstatus'] = "";
            }
            if(isset($phasethreeall)&& !empty($phasethreeall))
            {
                 $data['phasethreeall'] = $phasethreeall;
                //print_r($data['phasethreeall']);exit;
            }else{
                $data['phasethreeall'] = "";
            }
            if(isset($fiftystatus)&& !empty($fiftystatus))
            {
                 $data['fiftystatus'] = $fiftystatus;
                //print_r($data['fiftystatus']);exit;
            }else{
                $data['fiftystatus'] = "";
            }
            if(isset($huntwostatus)&& !empty($huntwostatus))
            {
                 $data['huntwostatus'] = $huntwostatus;
                //print_r($data['huntwostatus']);exit;
            }else{
                $data['huntwostatus'] = "";
            }
            if(isset($bottomstatus)&& !empty($bottomstatus))
            {
                 $data['bottomstatus'] = $bottomstatus;
                //print_r($data['bottomstatus']);exit;
            }else{
                $data['bottomstatus'] = "";
            }
            if(isset($finalists)&& !empty($finalists))
            {
                 $data['finalists'] = $finalists;
                //print_r($data['bottomstatus']);exit;
            }else{
                $data['finalists'] = "";
            }


           

        $data['pageTitle']="KPIT sparkle | Admin Dashboard";
        $data['metaDescription']="Admin Dashboard";
        $data['metakeywords']="KPIT sparkle Admin Dashboard";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/dashboard',$data);
        $this->load->view('admin/footer');
	}

}