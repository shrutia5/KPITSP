<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'../admin/crmAPI/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Reports extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); 
        $this->load->model('CommonModel');
        $this->load->library("Emails");
    }
    public function index(){

        $reportType = $this->input->get('reportType');
		$textval = $this->input->get('textval');
		$orderBy = $this->input->get('orderBy');
		$order = $this->input->get('order');
        $country_id = $this->input->get('country_id');
        $state_id = $this->input->get('state_id');
        $city_id = $this->input->get('city_id');
        $report_type = $this->input->get('report_type');
        
        // if(!isset($country_id) || empty($country_id)){
        //     $country_id = "101";
        // }
        $other = array("orderBy"=>$orderBy,"order"=>$order);
		$wherec = $join = array();

        if(isset($statuscode) && !empty($statuscode)){
		$statusStr = str_replace(",",'","',$statuscode);
		$wherec["t.status"] = 'IN ("'.$statusStr.'")';
	
		}
        $data['otherPage']['list'] = "";
        $data['otherPage']['allrep'] = "";
        if(!isset($reportType) || empty($reportType)){
            $reportType = "statistics2";
        }
       // print $reportType; exit;
        switch ($reportType) {
            case 'list_of_reg':
            {
                //-----------join for language table -----------------------------
                $join[0]['type'] ="LEFT JOIN";
                $join[0]['table']="master_college";
                $join[0]['alias'] ="c";
                $join[0]['key1'] ="college_id";
                $join[0]['key2'] ="college_id";

                $join[1]['type'] ="LEFT JOIN";
                $join[1]['table']="project_master";
                $join[1]['alias'] ="p";
                $join[1]['key1'] ="userID";
                $join[1]['key2'] ="userID";

                $join[2]['type'] ="LEFT JOIN";
                $join[2]['table']="master_country";
                $join[2]['alias'] ="cou";
                $join[2]['key1'] ="country_id";
                $join[2]['key2'] ="country_id";

                $join[3]['type'] ="LEFT JOIN";
                $join[3]['table']="master_states";
                $join[3]['alias'] ="s";
                $join[3]['key1'] ="state_id";
                $join[3]['key2'] ="state_id";

                $join[4]['type'] ="LEFT JOIN";
                $join[4]['table']="master_cities";
                $join[4]['alias'] ="ci";
                $join[4]['key1'] ="city_id";
                $join[4]['key2'] ="city_id";

                $isAll = $this->input->post('getAll');
                $selectC="t.*,cou.country_name,s.state_name,c.college_name,ci.city_name,c.is_top_100,c.is_premier,p.projectStatus,p.phaseTwoStatus,p.phaseThreeStatus,p.phaseOneDataSubmited,p.phaseTwoDataSubmited,p.currentPhase,p.phaseThreeStatus";
                $registerUsers = $this->CommonModel->GetMasterListDetails($selectC,'userregistration',$wherec,'','',$join,$other);
                $data['otherPage']['list'] = $registerUsers;
                break;
            }
            case 'all_report':
            {
                // // get country list
                $other = array();
                $wherec = array("is_active"=> " = 1");
                $countryList = $this->CommonModel->GetMasterListDetails("*",'master_country',$wherec,'','',array(),array());
                $tes = array_column($countryList,"country_id");
                // // get state list
                $other = array();
                $wherec = array("status"=> " ='active'");
                if(isset($country_id) && !empty($country_id)){
                    $wherec ["country_id ="] = $country_id;
                }
                
                $stateList = $this->CommonModel->GetMasterListDetails("*",'master_states',$wherec,'','',array(),$other);
                // // get city list
                // $other = array();
                // $wherec = array("status"=> " ='active'");
                // if(isset($state_id) && !empty($state_id)){
                //     $wherec["state_id ="] = $state_id;
                // }else{
                //     $other['whereIn'] = "state_id";
                //     $other['whereData'] = implode(",",array_column($stateList,"state_id"));
                // }
                // $cityList = $this->CommonModel->GetMasterListDetails("*",'master_cities',$wherec,'','',array(),$other);

                // $data['countryList'] = $countryList;
                // $data['stateList'] = $stateList;
                // $data['cityList'] = $cityList;
                $data['country_id'] = $country_id;
                $allrep = $this->input->get('allrep');
                if(!isset($allrep) || empty($allrep)){
                    $allrep = "";
                }
                $tot =0;
                switch ($allrep) {
                    case 'state_wise':
                    {
                       
                        $selectC="t.state_name,t.state_id";
                        
                        $wherec = array("status"=> " ='active'");
                        $stateList = $this->CommonModel->GetMasterListDetails($selectC,'master_states',$wherec,'','',$join,$other);
                        foreach ($stateList as $key => $value) {
                            $join = array();
                            $other= array();
                            $wherec = array();
                            $removeRow = true;
                            $wherec = array("state_id = "=> $value->state_id);
                            $numberOfreg = $this->CommonModel->GetMasterListDetails("count(userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                            $stateList[$key]->numberOfreg = $numberOfreg[0]->tot;
                            if($numberOfreg[0]->tot > 0){
                                $removeRow = false;
                            }

                            $wherec["phaseOneDataSubmited"] = " = '1'";
                            $join[0]['type'] ="LEFT JOIN";
                            $join[0]['table']="project_master";
                            $join[0]['alias'] ="p";
                            $join[0]['key1'] ="userID";
                            $join[0]['key2'] ="userID";
                            $numberOfidea = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                            $stateList[$key]->numberOfidea = $numberOfidea[0]->tot;
                            //$tot += $numberOfidea[0]->tot;
                            if($numberOfidea[0]->tot > 0){
                                $removeRow = false;
                            }
                            $wherec = array("state_id = "=> $value->state_id);
                            $join = array();
                            $wherec["phaseTwoDataSubmited"] = " = '1'";
                            $join[0]['type'] ="LEFT JOIN";
                            $join[0]['table']="project_master";
                            $join[0]['alias'] ="p";
                            $join[0]['key1'] ="userID";
                            $join[0]['key2'] ="userID";
                            $numberOfidea2 = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                            $stateList[$key]->numberOfidea2 = $numberOfidea2[0]->tot;
                            if($numberOfidea2[0]->tot > 0){
                                $removeRow = false;
                            }
                            $wherec = array("state_id = "=> $value->state_id);
                            $join = array();
                            $wherec["phaseTwoStatus"] = " = 'Approved'";
                            $wherec["currentPhase"] = " = '3'";
                            
                            $join[0]['type'] ="LEFT JOIN";
                            $join[0]['table']="project_master";
                            $join[0]['alias'] ="p";
                            $join[0]['key1'] ="userID";
                            $join[0]['key2'] ="userID";
                            $numberOfidea100 = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                            $stateList[$key]->numberOfidea100 = $numberOfidea100[0]->tot;
                            if($numberOfidea100[0]->tot > 0){
                                $removeRow = false;
                            }
                            $wherec = array("state_id = "=> $value->state_id);
                            $join = array();
                            $wherec["phaseThreeStatus"] = " = '50'";
                            $join[0]['type'] ="LEFT JOIN";
                            $join[0]['table']="project_master";
                            $join[0]['alias'] ="p";
                            $join[0]['key1'] ="userID";
                            $join[0]['key2'] ="userID";
                            $numberOfideafinal = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                            $stateList[$key]->numberOfideafinal = $numberOfideafinal[0]->tot;
                            if($numberOfideafinal[0]->tot > 0){
                                $removeRow = false;
                            }
                            if($removeRow){
                                unset($stateList[$key]);
                            }
                        }
                        $data['otherPage']['list'] = $stateList;
                        $data['otherPage']['allrep'] = $allrep;
                        break;
                    }
                    case 'city_wise':
                        {
    
                            $selectC="t.city_name,t.city_id";
                            $wherec = array("status"=> " ='active'");
                            if(isset($city_id) && !empty($city_id)){
                                $wherec["city_id ="] = $city_id;
                            }else{
                                $other['whereIn'] = "state_id";
                                $other['whereData'] = implode(",",array_column($stateList,"state_id"));
                            }
                            //print_r($other);exit;
                            $cityList = $this->CommonModel->GetMasterListDetails($selectC,'master_cities',$wherec,'','',$join,$other);
                            
                            $cityList = $this->getListDetails($cityList,"city_id",true);
                            foreach ($cityList as $key => $value) {
                                $removeRow = true;
                            }
                             
                            
                            $data['otherPage']['list'] = $cityList;
                            $data['otherPage']['allrep'] = $allrep;
                            break;
                        }
                        case 'premier_wise':
                        {
                            $selectC="college_id,college_name";
                            $wherec = array();
                            $wherec["is_premier ="] = "1";
                            $clgList = $this->CommonModel->GetMasterListDetails($selectC,'master_college',$wherec,'','',array(),array());
                            //print_r($clgList);exit;
                            $clgList = $this->getListDetails($clgList,"college_id",false);
                            $data['otherPage']['list'] = $clgList;
                            $data['otherPage']['allrep'] = $allrep;
                            break;
                        }
                        case 'branch_wise':
                        {
                            $selectC="branch_id,branch_name";
                            $wherec = array();
                            $wherec["is_del ="] = "0";
                            $clgList = $this->CommonModel->GetMasterListDetails($selectC,'master_branch',$wherec,'','',array(),array());
                            //print_r($clgList);exit;
                            $clgList = $this->getListDetails($clgList,"branch_id",false);
                            $data['otherPage']['list'] = $clgList;
                            $data['otherPage']['allrep'] = $allrep;
                            break;
                        }
                        case 'degree_wise':
                        {
                            $selectC="degree_id,degree_name";
                            $wherec = array();
                            $wherec["is_del ="] = "0";
                            $clgList = $this->CommonModel->GetMasterListDetails($selectC,'master_degree',$wherec,'','',array(),array());
                            //print_r($clgList);exit;
                            $clgList = $this->getListDetails($clgList,"degree_id",false);
                            $data['otherPage']['list'] = $clgList;
                            $data['otherPage']['allrep'] = $allrep;
                            break;
                        }
                        case 'year_of_com':
                        {
                            $object = new stdClass();
                            $object->yearOfCompletion = "2023";
                            $object1 = new stdClass();
                            $object1->yearOfCompletion = "2024";
                            $object2 = new stdClass();
                            $object2->yearOfCompletion = "2025";
                            $object3 = new stdClass();
                            $object3->yearOfCompletion = "2026";

                            $listData[0] = $object;
                            $listData[1] = $object1;
                            $listData[2] = $object2;
                            $listData[3] = $object3;
                            $clgList = $this->getListDetails($listData,"yearOfCompletion",false);
                            //print_r($clgList);exit;
                            $data['otherPage']['list'] = $clgList;
                            $data['otherPage']['allrep'] = $allrep;
                            break;
                        }
                        case 'gender_wise':
                            {
                                $object = new stdClass();
                                $object->gender = "male";
                                $object1 = new stdClass();
                                $object1->gender = "female";
                                $object2 = new stdClass();
                                $object2->gender = "other";
                                
                                $listData[0] = $object;
                                $listData[1] = $object1;
                                $listData[2] = $object2;
                                $clgList = $this->getListDetails($listData,"gender",false);
                                $data['otherPage']['list'] = $clgList;
                                $data['otherPage']['allrep'] = $allrep;
                                break;
                            }
                            case 'top_100_clg':
                                {
                                    $selectC="college_id,college_name";
                                    $wherec = array();
                                    $wherec["is_top_100 ="] = "1";
                                    $clgList = $this->CommonModel->GetMasterListDetails($selectC,'master_college',$wherec,'','',array(),array());
                                    //print_r($clgList);exit;
                                    $clgList = $this->getListDetails($clgList,"college_id",false);
                                    $data['otherPage']['list'] = $clgList;
                                    $data['otherPage']['allrep'] = $allrep;
                                    break;
                                }
                            
                            
                }
                break;
            }
            case 'statistics':
                {
                
                $join = array();
                $other= array();
                $wherec = array();
                $stateList = array();
                
                $numberOfreg = $this->CommonModel->GetMasterListDetails("count(userID) as tot",'userregistration',array(),'','',array(),array());    
                $stateList['numberOfreg'] = $numberOfreg[0]->tot;

                
                $numberOfreg = $this->CommonModel->GetMasterListDetails("count(userID) as tot",'project_master',array(),'','',array(),array());    
                $stateList['ideaSubmission'] = $numberOfreg[0]->tot;
                
                $wherec["phaseTwoDataSubmited"] = " = '1'";
                $join[0]['type'] ="LEFT JOIN";
                $join[0]['table']="project_master";
                $join[0]['alias'] ="p";
                $join[0]['key1'] ="userID";
                $join[0]['key2'] ="userID";
                $numberOfidea2 = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                $stateList['numberOfidea2'] = $numberOfidea2[0]->tot;

                $join = array();
                $wherec = array();
                $wherec["phaseTwoStatus"] = " = 'Approved'";
                $wherec["currentPhase"] = " = '3'";
                
                $join[0]['type'] ="LEFT JOIN";
                $join[0]['table']="project_master";
                $join[0]['alias'] ="p";
                $join[0]['key1'] ="userID";
                $join[0]['key2'] ="userID";
                $numberOfidea100 = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                $stateList['numberOfidea100'] = $numberOfidea100[0]->tot;

                $wherec = array();
                $join = array();
                $wherec["phaseThreeStatus"] = " = '50'";
                $join[0]['type'] ="LEFT JOIN";
                $join[0]['table']="project_master";
                $join[0]['alias'] ="p";
                $join[0]['key1'] ="userID";
                $join[0]['key2'] ="userID";
                $numberOfideafinal = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                $stateList['numberOfideafinal'] = $numberOfideafinal[0]->tot;
                $data['statData'] = $stateList;
                break;
            }
            case 'statistics2':{
                
                $join = array();
                $other= array();
                $wherec = array();
                $stateList = array();
                $today = Date("Y-m-d");
                $ddate = "2012-2-01";
                $date = new DateTime($ddate);
                $startWeek = $date->format("W");
                $enddate = new DateTime($today);
                $endWeek = $enddate->format("W");
                
                $UserRecord = $this->CommonModel->getUserstatRecord($ddate,$today);
                $projectRecords = $this->CommonModel->getProjectstatRecord($ddate,$today);
                $datauser = array();
                $dataProject = array();
                $dataLabel = array();
                $j=1;
                for ($i=$startWeek; $i <= $endWeek; $i++){ 
                    //$datan[$i]['label'] = "Week 1";
                    //$datan[$i]['backgroundColor'] = array("rgb(255, 99, 132)");
                    $dataLabel[] = "Week ".$j;
                    $datauser[$i] = 0;
                    $dataProject[$i] =0;
                    $j++;
                }
                foreach ($UserRecord as $key => $value) {
                    $datauser[$value->weekdays]= $value->tot;
                }
                foreach ($projectRecords as $key => $value) {
                    $dataProject[$value->weekdays] = $value->tot;
                }
                $data['statDataUser'] = $datauser;
                $data['dataProject'] = $dataProject;
                $data['dataLabel'] = $dataLabel;
                
                break;
            }

            case 'evaluators':{
                
                break;
            }
            case 'voting_graph':{
                
                break;
            }

            default:{ // Abhay : Added this default case in order to show Statistics reports by default on reports page. Same code as case 'statistics' above.
               // print "ggg"; exit;
                $join = array();
                $other= array();
                $wherec = array();
                $stateList = array();
                
                $numberOfreg = $this->CommonModel->GetMasterListDetails("count(userID) as tot",'userregistration',array(),'','',array(),array());    
                $stateList['numberOfreg'] = $numberOfreg[0]->tot;

                
                $numberOfreg = $this->CommonModel->GetMasterListDetails("count(userID) as tot",'project_master',array(),'','',array(),array());    
                $stateList['ideaSubmission'] = $numberOfreg[0]->tot;
                
                $wherec["phaseTwoDataSubmited"] = " = '1'";
                $join[0]['type'] ="LEFT JOIN";
                $join[0]['table']="project_master";
                $join[0]['alias'] ="p";
                $join[0]['key1'] ="userID";
                $join[0]['key2'] ="userID";
                $numberOfidea2 = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                $stateList['numberOfidea2'] = $numberOfidea2[0]->tot;

                $join = array();
                $wherec = array();
                $wherec["phaseTwoStatus"] = " = 'Approved'";
                $wherec["currentPhase"] = " = '3'";
                
                $join[0]['type'] ="LEFT JOIN";
                $join[0]['table']="project_master";
                $join[0]['alias'] ="p";
                $join[0]['key1'] ="userID";
                $join[0]['key2'] ="userID";
                $numberOfidea100 = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                $stateList['numberOfidea100'] = $numberOfidea100[0]->tot;

                $wherec = array();
                $join = array();
                $wherec["phaseThreeStatus"] = " = '50'";
                $join[0]['type'] ="LEFT JOIN";
                $join[0]['table']="project_master";
                $join[0]['alias'] ="p";
                $join[0]['key1'] ="userID";
                $join[0]['key2'] ="userID";
                $numberOfideafinal = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                $stateList['numberOfideafinal'] = $numberOfideafinal[0]->tot;
                $data['statData'] = $stateList;
                break;
            }
        }
        //   print "<pre>";
        //   print_r($data); exit;

        	
		//print $tot;
        if(isset($report_type) && !empty($report_type)){
            if(!isset($allrep) || empty($allrep)){
                $allrep= "";
            }
            
            $this->pdfexcelReport($report_type,$data,$allrep,$reportType); //report_type
            //}
        
        }else{

            $data['filter']['reportType'] = $reportType;
            if(isset($allrep) && !empty($allrep)){
                $data['allrep'] = $allrep;
            }else{
                $data['allrep'] ="";
            }
            $data['menuName'] = "reports";
            $data['pageTitle']="KPIT sparkle | Admin Reports";
            $data['metaDescription']="Admin Reports";
            $data['metakeywords']="KPIT sparkle Admin Reports";
            $this->load->view('admin/header',$data);
            $this->load->view('admin/reports',$data);
            $this->load->view('admin/footer');
        }
    }

    public function getListDetails($list,$where,$isRemove){
        foreach ($list as $key => $value) {
            $join = array();
            $other= array();
            $wherec = array();
            $vv = $where."=";
            $removeRow = true;
            $wherec = array($vv => "'".$value->$where."'");
            $numberOfreg = $this->CommonModel->GetMasterListDetails("count(userID) as tot",'userregistration',$wherec,'','',$join,$other);    
            $list[$key]->numberOfreg = $numberOfreg[0]->tot;
            if($numberOfreg[0]->tot > 0){
                $removeRow = false;
            }

            $wherec["phaseOneDataSubmited"] = " = '1'";
            $join[0]['type'] ="LEFT JOIN";
            $join[0]['table']="project_master";
            $join[0]['alias'] ="p";
            $join[0]['key1'] ="userID";
            $join[0]['key2'] ="userID";
            $numberOfidea = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
            $list[$key]->numberOfidea = $numberOfidea[0]->tot;
            if($numberOfidea[0]->tot > 0){
                $removeRow = false;
            }                                
            $wherec = array($vv=> "'".$value->$where."'");
            $join = array();
            $wherec["phaseTwoDataSubmited"] = " = '1'";
            $join[0]['type'] ="LEFT JOIN";
            $join[0]['table']="project_master";
            $join[0]['alias'] ="p";
            $join[0]['key1'] ="userID";
            $join[0]['key2'] ="userID";
            $numberOfidea2 = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
            $list[$key]->numberOfidea2 = $numberOfidea2[0]->tot;

            if($numberOfidea2[0]->tot > 0){
                $removeRow = false;
            }   

            $wherec = array($vv=>  "'".$value->$where."'");
            $join = array();
            $wherec["phaseTwoStatus"] = " = 'Approved'";
            $wherec["currentPhase"] = " = '3'";
            
            $join[0]['type'] ="LEFT JOIN";
            $join[0]['table']="project_master";
            $join[0]['alias'] ="p";
            $join[0]['key1'] ="userID";
            $join[0]['key2'] ="userID";
            $numberOfidea100 = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
            $list[$key]->numberOfidea100 = $numberOfidea100[0]->tot;
            if($numberOfidea100[0]->tot > 0){
                $removeRow = false;
            }   

            $wherec = array($vv=> "'".$value->$where."'");
            $join = array();
            $wherec["phaseThreeStatus"] = " = '50'";
            $join[0]['type'] ="LEFT JOIN";
            $join[0]['table']="project_master";
            $join[0]['alias'] ="p";
            $join[0]['key1'] ="userID";
            $join[0]['key2'] ="userID";
            $numberOfideafinal = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
            $list[$key]->numberOfideafinal = $numberOfideafinal[0]->tot;
            if($numberOfideafinal[0]->tot > 0){
                $removeRow = false;
            }
            if($removeRow && $isRemove){
                unset($list[$key]);
            }   
            
        }
        return $list;
    }
    public function pdfexcelReport($report_type,$printDetails1,$allRepType,$reportType){
        $rowArray = array();$printDetails= array();
        //print_r($printDetails1['otherPage']['list']);
        $i=0;
        
        switch ($reportType) {
            case 'list_of_reg':
            {
                foreach($printDetails1['otherPage']['list'] as $key => $value){
                    $printDetails[$i]['name'] = $value->firstname." ".$value->lastName;
                    $printDetails[$i]['email'] = $value->email;
                    $printDetails[$i]['mobile'] = $value->phoneNumber;
                    $printDetails[$i]['country'] = $value->country_name;
                    $printDetails[$i]['state'] = $value->state_name;
                    $printDetails[$i]['city'] = $value->city_name;
                    $printDetails[$i]['othercity'] = $value->otherCity;
                    $printDetails[$i]['college'] = $value->college_name;
                    $printDetails[$i]['gender'] = $value->gender;
                    if($value->is_top_100 == "1") { $printDetails[$i]['clgtop100'] = "Yes";}else{$printDetails[$i]['clgtop100'] = "No";}
                    // $printDetails[$i]['clgtop100'] = $value->numberOfideafinal;
                    if($value->is_premier == "1") {$printDetails[$i]['ispremier'] = "Yes";}else{$printDetails[$i]['ispremier'] = "No";}
                    //$printDetails[$i]['ispremier'] = $value->numberOfideafinal;
                    if($value->phaseOneDataSubmited == "1"){ $printDetails[$i]['ideasubmitted'] = "Yes";}else{$printDetails[$i]['ideasubmitted'] = "No";}
                    //$printDetails[$i]['ideasubmitted'] = $value->numberOfideafinal;
                    $printDetails[$i]['emailVerify'] = $value->verify_email;
                    if($value->phaseTwoDataSubmited == "1"){ $printDetails[$i]['ideaphase2'] = "Yes";}else{ $printDetails[$i]['ideaphase2'] = "No";}
                    //$printDetails[$i]['ideaphase2'] = $value->numberOfideafinal;
                    if($value->phaseTwoStatus == "Approved" && $value->currentPhase =="3"){ $printDetails[$i]['ideatop100'] = "Yes";}else{ $printDetails[$i]['ideatop100'] = "No";}
                    //$printDetails[$i]['ideatop100'] = $value->numberOfideafinal;
                    //$printDetails[$i]['ideafinale'] = $value->numberOfideafinal;
                    if($value->phaseThreeStatus == "50"){ $printDetails[$i]['ideafinale']= "Yes";}
                    $i++;
                }
                $rowArray = array("Name","Email","Mobile","Country","State","City","Other City","College","Gender","College is top 100","College is permier","Email Verified","Idea submitted","Idea in phase 2","Idea in top 100","Idea in Finale");

                break;
            }
            case 'all_report':
            {
                $allrep = $this->input->get('allrep');
                $tot =0;
                switch ($allrep) {
                    case 'state_wise':
                    {
                        foreach($printDetails1['otherPage']['list'] as $key => $value){
                            $printDetails[$i]['state_name'] = $value->state_name;
                            $printDetails[$i]['numberOfreg'] = $value->numberOfreg;
                            $printDetails[$i]['numberOfidea'] = $value->numberOfidea;
                            $printDetails[$i]['numberOfidea2'] = $value->numberOfidea2;
                            $printDetails[$i]['numberOfidea100'] = $value->numberOfidea100;
                            $printDetails[$i]['numberOfideafinal'] = $value->numberOfideafinal;
                            $i++;
                        }
                        
                        $rowArray = array("State Name","Number of Registration","Number of Idea Submission","Number of Idea in Phase 2","Number Of Idea in Top 100","Number Of Idea in Finale");

                        break;
                    }
                    case 'city_wise':
                    {

                        foreach($printDetails1['otherPage']['list'] as $key => $value){
                            $printDetails[$i]['city_name'] = $value->city_name;
                            $printDetails[$i]['numberOfreg'] = $value->numberOfreg;
                            $printDetails[$i]['numberOfidea'] = $value->numberOfidea;
                            $printDetails[$i]['numberOfidea2'] = $value->numberOfidea2;
                            $printDetails[$i]['numberOfidea100'] = $value->numberOfidea100;
                            $printDetails[$i]['numberOfideafinal'] = $value->numberOfideafinal;
                            $i++;
                        }
                        
                        $rowArray = array("City Name","Number of Registration","Number of Idea Submission","Number of Idea in Phase 2","Number Of Idea in Top 100","Number Of Idea in Finale");

                        break;
                    }
                    case 'premier_wise':
                    {
                        foreach($printDetails1['otherPage']['list'] as $key => $value){
                            $printDetails[$i]['college_name'] = $value->college_name;
                            $printDetails[$i]['numberOfreg'] = $value->numberOfreg;
                            $printDetails[$i]['numberOfidea'] = $value->numberOfidea;
                            $printDetails[$i]['numberOfidea2'] = $value->numberOfidea2;
                            $printDetails[$i]['numberOfidea100'] = $value->numberOfidea100;
                            $printDetails[$i]['numberOfideafinal'] = $value->numberOfideafinal;
                            $i++;
                        }
                        
                        $rowArray = array("College Name","Number of Registration","Number of Idea Submission","Number of Idea in Phase 2","Number Of Idea in Top 100","Number Of Idea in Finale");

                        break;
                    }
                    case 'branch_wise':
                    {
                        foreach($printDetails1['otherPage']['list'] as $key => $value){
                            $printDetails[$i]['branch_name'] = $value->branch_name;
                            $printDetails[$i]['numberOfreg'] = $value->numberOfreg;
                            $printDetails[$i]['numberOfidea'] = $value->numberOfidea;
                            $printDetails[$i]['numberOfidea2'] = $value->numberOfidea2;
                            $printDetails[$i]['numberOfidea100'] = $value->numberOfidea100;
                            $printDetails[$i]['numberOfideafinal'] = $value->numberOfideafinal;
                            $i++;
                        }
                        
                        $rowArray = array("Branch","Number of Registration","Number of Idea Submission","Number of Idea in Phase 2","Number Of Idea in Top 100","Number Of Idea in Finale");

                        break;
                    }
                    case 'degree_wise':
                    {
                        //print_r($printDetails1['otherPage']['list']);
                        foreach($printDetails1['otherPage']['list'] as $key => $value){
                            $printDetails[$i]['degree'] = $value->degree_name;
                            $printDetails[$i]['numberOfreg'] = $value->numberOfreg;
                            $printDetails[$i]['numberOfidea'] = $value->numberOfidea;
                            $printDetails[$i]['numberOfidea2'] = $value->numberOfidea2;
                            $printDetails[$i]['numberOfidea100'] = $value->numberOfidea100;
                            $printDetails[$i]['numberOfideafinal'] = $value->numberOfideafinal;
                            $i++;
                        }
                        
                        $rowArray = array("Degree","Number of Registration","Number of Idea Submission","Number of Idea in Phase 2","Number Of Idea in Top 100","Number Of Idea in Finale");

                        break;
                    }
                    case 'year_of_com':
                    {
                        foreach($printDetails1['otherPage']['list'] as $key => $value){
                            $printDetails[$i]['year'] = $value->yearOfCompletion;
                            $printDetails[$i]['numberOfreg'] = $value->numberOfreg;
                            $printDetails[$i]['numberOfidea'] = $value->numberOfidea;
                            $printDetails[$i]['numberOfidea2'] = $value->numberOfidea2;
                            $printDetails[$i]['numberOfidea100'] = $value->numberOfidea100;
                            $printDetails[$i]['numberOfideafinal'] = $value->numberOfideafinal;
                            $i++;
                        }
                        
                        $rowArray = array("Year of Completion","Number of Registration","Number of Idea Submission","Number of Idea in Phase 2","Number Of Idea in Top 100","Number Of Idea in Finale");

                        break;
                    }
                    case 'gender_wise':
                    {
                        foreach($printDetails1['otherPage']['list'] as $key => $value){
                            $printDetails[$i]['gender'] = $value->gender;
                            $printDetails[$i]['numberOfreg'] = $value->numberOfreg;
                            $printDetails[$i]['numberOfidea'] = $value->numberOfidea;
                            $printDetails[$i]['numberOfidea2'] = $value->numberOfidea2;
                            $printDetails[$i]['numberOfidea100'] = $value->numberOfidea100;
                            $printDetails[$i]['numberOfideafinal'] = $value->numberOfideafinal;
                            $i++;
                        }
                        
                        $rowArray = array("Gender","Number of Registration","Number of Idea Submission","Number of Idea in Phase 2","Number Of Idea in Top 100","Number Of Idea in Finale");
                        //$rowArray = array("gender","numberOfreg","numberOfidea","numberOfidea2","numberOfidea100","numberOfideafinal");
                        break;
                    }
                    case 'top_100_clg':
                    {
                        //print_r($printDetails1['otherPage']['list']);exit;
                        foreach($printDetails1['otherPage']['list'] as $key => $value){
                            $printDetails[$i]['college_name'] = $value->college_name;
                            $printDetails[$i]['numberOfreg'] = $value->numberOfreg;
                            $printDetails[$i]['numberOfidea'] = $value->numberOfidea;
                            $printDetails[$i]['numberOfidea2'] = $value->numberOfidea2;
                            $printDetails[$i]['numberOfidea100'] = $value->numberOfidea100;
                            $printDetails[$i]['numberOfideafinal'] = $value->numberOfideafinal;
                            $i++;
                        }

                        
                        $rowArray = array("Top 100 College Name","Number of Registration","Number of Idea Submission","Number of Idea in Phase 2","Number Of Idea in Top 100","Number Of Idea in Finale");
                        break;
                    }
                }
                break;
            }
            case 'statistics':{
                
                $stateList['numberOfreg'] = $numberOfreg[0]->tot;
                $stateList['ideaSubmission'] = $numberOfreg[0]->tot;
                $stateList['numberOfidea2'] = $numberOfidea2[0]->tot;
                $stateList['numberOfidea100'] = $numberOfidea100[0]->tot;
                $stateList['numberOfideafinal'] = $numberOfideafinal[0]->tot;
                $data['statData'] = $stateList;
                break;
            }
            case 'statistics2':{
                
                $printDetails = array();
                foreach ($printDetails1['statDataUser'] as $key => $value) {
                    $printDetails[$i]['week'] =  $printDetails1['dataLabel'][$i];
                    $printDetails[$i]['users'] =  $printDetails1['statDataUser'][$key];
                    $printDetails[$i]['projects'] =  $printDetails1['dataProject'][$key];
                    $i++;
                }
                $rowArray = array("Week","Total User Register","Total Project submit");
                //print_r($printDetails);exit;
                break;
            }

            case 'evaluators':{
                
                break;
            }
            case 'voting_graph':{
                
                break;
            }

            
        }
         //print "<pre>";
        // print_r($rowArray);
        // print_r($printDetails);
        // exit;
        //$rowArray = array("scheme","trainneCode","traineeName","email","companyTokenNo","traineeSource","neenRegtNo","trainingStartDate","trainingEndDate","stipendRate","stipendRateType","monthDayFactor","extraTimeType","extraRatio","extraFixRate","extraMonthDayFactor","shiftHours","shoes","uniform","bankAcNo","bankName","bankBranch","bankIFSC","aadhaarNo","mobile","panNo","casteCategory","skill","presentAddress","presentState","permanentAddress","permanentState","gender","dateOfBirth","marriageStatus","bloodGroup","height","weight","nsqfLevel","specialization","courseCurrentlyEnrolled","placeOfTraining","lastExamPass","jobRole","wcPolicy","acidentPolicy","certificate","certificateNo","leftDate","status");
        if($report_type == "pdf"){

            $data['list'] = $printDetails;
            $data['headerList'] = $rowArray;
            //print_r($companyDetails);exit;
            $pdfFilePath = $this->load->view("admin/datapdf",$data,true);
            //load mPDF library
            $this->load->library('MPDFCI');
            $this->mpdfci->SetHTMLFooter('<div style="text-align: center">{PAGENO} of {nbpg}</div>');
            //$this->mpdfci->setFooter('{PAGENO}');
            //generate the PDF from the given html
            $this->mpdfci->WriteHTML($pdfFilePath);
            //download it.
            $this->mpdfci->Output();
        }
        if($report_type == "excel"){

            $spreadsheet = new Spreadsheet();
                $Excel_writer = new Xls($spreadsheet);
                $spreadsheet->setActiveSheetIndex(0);
                $spreadsheet->getActiveSheet()->setTitle("Sheet1");
                $styleArray = array(
                'borders' => array(
                    'outline' => array(
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => array('argb' => '00999999'),
                    ),
                ),
            );

            $spreadsheet->getActiveSheet()
                ->fromArray(
                    $rowArray,   // The data to set
                    NULL,        // Array values with this value will not be set
                    'A1'         // Top left coordinate of the worksheet range where
                                //    we want to set these values (default is A1)
                );
            $spreadsheet->getActiveSheet()
                ->fromArray(
                    $printDetails,  // The data to set
                    NULL,        // Array values with this value will not be set
                    'A2'         // Top left coordinate of the worksheet range where
                                //    we want to set these values (default is A1)
                );
                for ($i=0; $i <= count($printDetails); $i++) { 
                    for ($j=0; $j < count($rowArray); $j++) { 
                        $spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+2)->getStyle()->applyFromArray($styleArray)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setWrapText(true);
                            
                    }
                }
            print "<pre>";
            // print_r($rowArray);
            // print_r($printDetails);
            // exit;
            header('Content-Type: application/vnd.ms-excel');
            $filename = "Report".".xls";
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            if (ob_get_contents()) ob_end_clean();
            
            $Excel_writer->save('php://output');
            if (ob_get_contents()) ob_end_clean();
        }
        //exit;
    }
    
}