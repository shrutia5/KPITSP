<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

        
        if(!isset($country_id) || empty($country_id)){
            $country_id = "101";
        }
        $other = array("orderBy"=>$orderBy,"order"=>$order);
		$wherec = $join = array();

        if(isset($statuscode) && !empty($statuscode)){
		$statusStr = str_replace(",",'","',$statuscode);
		$wherec["t.status"] = 'IN ("'.$statusStr.'")';
	
		}
        $data['otherPage']['list'] = "";
        $data['otherPage']['allrep'] = "";
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

                $isAll = $this->input->post('getAll');
                $selectC="t.*,c.college_name,c.is_top_100,c.is_premier,p.projectStatus,p.phaseTwoStatus,p.phaseThreeStatus,p.phaseOneDataSubmited,p.phaseTwoDataSubmited,p.currentPhase,p.phaseThreeStatus";
                $registerUsers = $this->CommonModel->GetMasterListDetails($selectC,'userregistration',$wherec,'','',$join,$other);
                $data['otherPage']['list'] = $registerUsers;
                break;
            }
            case 'all_report':
            {
                // get country list
                $other = array();
                $wherec = array("is_active"=> " = 1");
                $countryList = $this->CommonModel->GetMasterListDetails("*",'master_country',$wherec,'','',array(),array());
                $tes = array_column($countryList,"country_id");
                // get state list
                $other = array();
                $wherec = array("is_del"=> " = 0");
                if(isset($country_id) && !empty($country_id)){
                    $wherec ["country_id ="] = $country_id;
                }
                
                $stateList = $this->CommonModel->GetMasterListDetails("*",'master_states',$wherec,'','',array(),$other);
                // get city list
                $other = array();
                $wherec = array("is_del"=> " = 0");
                if(isset($state_id) && !empty($state_id)){
                    $wherec["state_id ="] = $state_id;
                }else{
                    $other['whereIn'] = "state_id";
                    $other['whereData'] = implode(",",array_column($stateList,"state_id"));
                }
                $cityList = $this->CommonModel->GetMasterListDetails("*",'master_cities',$wherec,'','',array(),$other);

                $data['countryList'] = $countryList;
                $data['stateList'] = $stateList;
                $data['cityList'] = $cityList;
                $data['country_id'] = $country_id;
                $allrep = $this->input->get('allrep');
                $tot =0;
                switch ($allrep) {
                    case 'state_wise':
                    {

                        $selectC="t.state_name,t.state_id";
                        
                        $wherec = array("is_del"=> " = 0");
                        $stateList = $this->CommonModel->GetMasterListDetails($selectC,'master_states',$wherec,'','',$join,$other);
                        foreach ($stateList as $key => $value) {
                            $join = array();
                            $other= array();
                            $wherec = array();

                            $wherec = array("state_id = "=> $value->state_id);
                            $numberOfreg = $this->CommonModel->GetMasterListDetails("count(userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                            $stateList[$key]->numberOfreg = $numberOfreg[0]->tot;
                            //$tot += $numberOfreg[0]->tot;

                            $wherec["phaseOneDataSubmited"] = " = '1'";
                            $join[0]['type'] ="LEFT JOIN";
                            $join[0]['table']="project_master";
                            $join[0]['alias'] ="p";
                            $join[0]['key1'] ="userID";
                            $join[0]['key2'] ="userID";
                            $numberOfidea = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
                            $stateList[$key]->numberOfidea = $numberOfidea[0]->tot;
                            //$tot += $numberOfidea[0]->tot;
                            
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
                            //$tot += $numberOfidea[0]->tot;
                            //print "<br>";
                            //print_r($numberOfidea2);
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
                            
                        }
                        $data['otherPage']['list'] = $stateList;
                        $data['otherPage']['allrep'] = $allrep;
                        break;
                    }
                    case 'city_wise':
                        {
    
                            $selectC="t.city_name,t.city_id";
                            $wherec = array("is_del"=> " = 0");
                            if(isset($city_id) && !empty($city_id)){
                                $wherec["city_id ="] = $city_id;
                            }else{
                                $other['whereIn'] = "state_id";
                                $other['whereData'] = implode(",",array_column($stateList,"state_id"));
                            }
                            //print_r($other);exit;
                            $cityList = $this->CommonModel->GetMasterListDetails($selectC,'master_cities',$wherec,'','',$join,$other);
                            //print_r($cityList);exit;
                             

                            // needd t 
                            $cityList = $this->getListDetails($cityList,"city_id");
                            
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
                            $clgList = $this->getListDetails($clgList,"college_id");
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
                            $clgList = $this->getListDetails($clgList,"branch_id");
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
                            $clgList = $this->getListDetails($clgList,"degree_id");
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
                            $clgList = $this->getListDetails($listData,"yearOfCompletion");
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
                                $clgList = $this->getListDetails($listData,"gender");
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
                                    $clgList = $this->getListDetails($clgList,"college_id");
                                    $data['otherPage']['list'] = $clgList;
                                    $data['otherPage']['allrep'] = $allrep;
                                    break;
                                }
                            
                            
                }
            }
            case 'statistics':{
                
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
                $UserRecord = $this->CommonModel->getUserstatRecord('2022-2-01',$today);
                $weekRecord = $this->CommonModel->getProjectstatRecord('2022-2-01',$today);
                $datan = array();
                if(count($UserRecord) > count($weekRecord)){
                    
                    foreach ($UserRecord as $key => $value) {
                        $datan[$key][0] = $value->tot;
                        if(isset($weekRecord[$key]->tot)){
                            $datan[$key][1] = $weekRecord[$key]->tot;
                        }else{
                            $datan[$key][1] = 0;
                        }
                    }

                }else{
                    foreach ($weekRecord as $key => $value) {
                        if(isset($UserRecord[$key]->tot)){
                            $datan[$key][0] = $UserRecord[$key]->tot;
                        }else{
                            $datan[$key][0] = 0;
                        }
                        $datan[$key][1] = $value->tot;
                    }
                }
                
                
                // print "<pre>";
                // print_r($datan); 
                // print_r($UserRecord); 
                // print_r($weekRecord); exit;
                $data['statData'] = $stateList;
                break;
            }

            case 'evaluators':{
                
                break;
            }
            case 'voting_graph':{
                
                break;
            }

            default:{ // Abhay : Added this default case in order to show Statistics reports by default on reports page. Same code as case 'statistics' above.
                
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
        //  print "<pre>";
        //  print_r($stateList); exit;

        	
		//print $tot;

		
		


        $data['filter']['reportType'] = $reportType;
        $data['menuName'] = "reports";
        $data['pageTitle']="KPIT sparkle | Admin Reports";
        $data['metaDescription']="Admin Reports";
        $data['metakeywords']="KPIT sparkle Admin Reports";
        $this->load->view('admin/header',$data);
        $this->load->view('admin/reports',$data);
        $this->load->view('admin/footer');
    }

    public function getListDetails($list,$where){
        foreach ($list as $key => $value) {
            $join = array();
            $other= array();
            $wherec = array();
            $vv = $where."=";
            $wherec = array($vv => "'".$value->$where."'");
            $numberOfreg = $this->CommonModel->GetMasterListDetails("count(userID) as tot",'userregistration',$wherec,'','',$join,$other);    
            $list[$key]->numberOfreg = $numberOfreg[0]->tot;
            //$tot += $numberOfreg[0]->tot;

            $wherec["phaseOneDataSubmited"] = " = '1'";
            $join[0]['type'] ="LEFT JOIN";
            $join[0]['table']="project_master";
            $join[0]['alias'] ="p";
            $join[0]['key1'] ="userID";
            $join[0]['key2'] ="userID";
            $numberOfidea = $this->CommonModel->GetMasterListDetails("count(t.userID) as tot",'userregistration',$wherec,'','',$join,$other);    
            $list[$key]->numberOfidea = $numberOfidea[0]->tot;
                                            
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
            
        }
        return $list;
    }
}