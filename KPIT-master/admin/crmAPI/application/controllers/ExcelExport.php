<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
class ExcelExport extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library("Excel");
		$this->load->model("ExcelExportModel");
		$this->load->model("CommonModel");
		
	}
	public function index()
	{
		$data["traineeData"] = $this->ExcelExportModel->fetch_data();
	}

 	public function traineeReport($companyID){
 		
 		$join = array();
		$join[0]['type'] ="LEFT JOIN";
		$join[0]['table']="stateMaster";
		$join[0]['alias'] ="s";
		$join[0]['key1'] ="stateID";
		$join[0]['key2'] ="stateID";
		//$join = array();
		$join[1]['type'] ="LEFT JOIN";
		$join[1]['table']="stateMaster";
		$join[1]['alias'] ="ps";
		$join[1]['key1'] ="permanentStateID";
		$join[1]['key2'] ="stateID";

		$join[2]['type'] ="LEFT JOIN";
		$join[2]['table']="casteCategoryMaster";
		$join[2]['alias'] ="cc";
		$join[2]['key1'] ="casteCatID";
		$join[2]['key2'] ="casteCategoryID";

		$join[3]['type'] ="LEFT JOIN";
		$join[3]['table']="traineeSkillMaster";
		$join[3]['alias'] ="ts";
		$join[3]['key1'] ="skillID";
		$join[3]['key2'] ="traineeSkillID"; 

		$other = array();
		$wherec = array("t.companyID = "=>$companyID);
		//$wherec = array("t.status= "==='active');
			// get comapny access list
		/**//*$adminID = $this->input->post('SadminID');
		$where = array("adminID ="=>"'".$adminID."'");
		$companyAccess = $this->CommonModel->GetMasterListDetails('*','companyAccess',$where,'','',array(),array());
		if(isset($companyAccess) && !empty($companyAccess)){
				//$wherec["cm.companyID IN "] = "(".$companyAccess[0]->companyList.")";
		}else{
			$status['msg'] = $this->systemmsg->getErrorCode(263);
			$status['statusCode'] = 263;
			$status['flag'] = 'F';
			$this->response->output($status,200);
		}*/
		
		// Check is data process already
		/*$other['whereIn'] = "companyID";
		$other["whereData"]=$companyAccess[0]->companyList;*/

		$selectC = "t.*,s.stateName as presentState ,ps.stateName as permanentState,cc.casteName as casteCategory,ts.skillDesc as skill";
		$processDetails = $this->CommonModel->GetMasterListDetails($selectC,'traineeMaster',$wherec,'','',$join,$other);
 	
 		if(!isset($processDetails) || empty($processDetails)){
 			
 			$status['msg'] = $this->systemmsg->getErrorCode(273);
			$status['statusCode'] = 273;
			$status['flag'] = 'F';
			$this->load->view("error_message",$status);
			exit();

 		}
 		$printDetails = array();
 		$i=0;
 		foreach ($processDetails as $key => $value) {
 			
  			$printDetails[$i]["regType"] = 	$value->regType;
  			$printDetails[$i]["ysfCode"] = 	$value->ysfCode;
 			$printDetails[$i]["traineeName"] = 	$value->traineeName;
 			$printDetails[$i]["email"] = 	$value->email;
 			$printDetails[$i]["companyTokenNo"] = 	$value->companyTokenNo;
 			$printDetails[$i]["traineeSource"] = 	$value->traineeSource;
 			$printDetails[$i]["neenRegtNo"] = 	$value->neenRegtNo;
 			$printDetails[$i]["trainingStartDate"] = 	dateFormat($value->trainingStartDate,'d-m-Y');
 			$printDetails[$i]["trainingEndDate"] = 	dateFormat($value->trainingEndDate,'d-m-Y');
 			$printDetails[$i]["stipendRate"] = 	$value->stipendRate;
 			$printDetails[$i]["stipendRateType"] = 	$value->stipendRateType;
 			$printDetails[$i]["monthDayFactor"] = 	$value->monthDayFactor;
 			$printDetails[$i]["extraTimeType"] = 	$value->extraTimeType;
 			$printDetails[$i]["extraRatio"] = 	$value->extraRatio;
 			$printDetails[$i]["extraFixRate"] = 	$value->extraFixRate;
 			$printDetails[$i]["extraMonthDayFactor"] = 	$value->extraMonthDayFactor;
 			$printDetails[$i]["shiftHours"] = 	$value->shiftHours;
 			$printDetails[$i]["shoes"] = 	$value->shoes;
 			$printDetails[$i]["uniform"] = $value->uniform;
 			$printDetails[$i]["bankAcNo"]   = $value->bankAcNo;
 			$printDetails[$i]["bankName"] = $value->bankName;
 			$printDetails[$i]["bankBranch"]      = $value->bankBranch;
 			$printDetails[$i]["bankIFSC"]   = $value->bankIFSC;
 			$printDetails[$i]["aadhaarNo "] = 	$value->aadhaarNo;
 			$printDetails[$i]["mobile"] = 	$value->mobile;
 			$printDetails[$i]["panNo"]   = $value->panNo;
 			$printDetails[$i]["casteCatID"] = 	$value->casteCategory;
 			$printDetails[$i]["skillID"] = 	$value->skill;
 			$printDetails[$i]["presentAddress"] = 	$value->presentAddress;
 			$printDetails[$i]["stateID"] = 	$value->presentState;
 			$printDetails[$i]["permanentAddress"] = 	$value->permanentAddress;
 			$printDetails[$i]["permanentStateID"] = 	$value->permanentState;
 			$printDetails[$i]["gender"]  = $value->gender;
 			$printDetails[$i]["dateOfBirth"]   = dateFormat($value->dateOfBirth,'d-m-Y');
 			$printDetails[$i]["marriageStatus"] = 	$value->marriageStatus;
 			$printDetails[$i]["bloodGroup"] = 	$value->bloodGroup;
 			$printDetails[$i]["height"] = 	$value->height;
 			$printDetails[$i]["weight"] = 	$value->weight;
 			$printDetails[$i]["nsqfLevel"] = 	$value->nsqfLevel;
 			$printDetails[$i]["specialization"] = $value->specialization;
 			$printDetails[$i]["courseCurrentlyEnrolled"]      = $value->courseCurrentlyEnrolled;
 			$printDetails[$i]["placeOfTraining"] = 	$value->placeOfTraining;
 			$printDetails[$i]["lastExamPass"] = $value->lastExamPass;
 			$printDetails[$i]["jobRole"] = 	$value->jobRole;
 			$printDetails[$i]["wcPolicy "] = 	$value->wcPolicy;
 			$printDetails[$i]["acidentPolicy"] = 	$value->acidentPolicy;
 			$printDetails[$i]["certificate"] = 	$value->certificate;
 			$printDetails[$i]["certificateNo"] = 	$value->certificateNo;
 			$printDetails[$i]["leftDate"] = 	dateFormat($value->leftDate,'d-m-Y');
 			$printDetails[$i]["status"] = 	$value->status;
 			$i++;
 		}
	    $rowArray = array("scheme","trainneCode","traineeName","email","companyTokenNo","traineeSource","neenRegtNo","trainingStartDate","trainingEndDate","stipendRate","stipendRateType","monthDayFactor","extraTimeType","extraRatio","extraFixRate","extraMonthDayFactor","shiftHours","shoes","uniform","bankAcNo","bankName","bankBranch","bankIFSC","aadhaarNo","mobile","panNo","casteCategory","skill","presentAddress","presentState","permanentAddress","permanentState","gender","dateOfBirth","marriageStatus","bloodGroup","height","weight","nsqfLevel","specialization","courseCurrentlyEnrolled","placeOfTraining","lastExamPass","jobRole","wcPolicy","acidentPolicy","certificate","certificateNo","leftDate","status");

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
		
		header('Content-Type: application/vnd.ms-excel');
		$filename = "Trainee_Report".".xls";
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		if (ob_get_contents()) ob_end_clean();
		
		$Excel_writer->save('php://output');
		if (ob_get_contents()) ob_end_clean();
		 
 	}
 	public function paysheetReport($month,$year,$companyID,$reportType)
 	{
 		$isFor = "Company";
 		$this->load->model("EmployeeModel");
 		
 		// get comapny access list
		/*$adminID = $this->input->post('SadminID');
		$where = array("adminID ="=>"'".$adminID."'");
		$companyAccess = $this->CommonModel->GetMasterListDetails('*','companyAccess',$where,'','',array(),array());
		if(isset($companyAccess) && !empty($companyAccess)){
				//$wherec["cm.companyID IN "] = "(".$companyAccess[0]->companyList.")";
		}else{
			$status['msg'] = $this->systemmsg->getErrorCode(263);
			$status['statusCode'] = 263;
			$status['flag'] = 'F';
			//print_r($status); exit;
			$this->load->view("error_message",$status);
			exit();
		}*/

		//$other = array('whereIn' =>"companyID","whereData"=>$companyAccess[0]->companyList);
		$other = array();
 		$where = array("mu.companyID = "=>$companyID,"uploadMonth = "=>$month,"uploadYear = "=>$year);
 		$processDetails = $this->EmployeeModel->getPaysheetData('',$where,$other);
 		if(!isset($processDetails) || empty($processDetails)){
 			
 			$status['msg'] = $this->systemmsg->getErrorCode(273);
			$status['statusCode'] = 273;
			$status['flag'] = 'F';
			$this->load->view("error_message",$status);
			exit();

 		}
 		$printDetails = array();
 		$i=0;
 		foreach ($processDetails as $key => $value) {
 				
 			$stDetails = json_decode($value->traineeStipends);
 			$printDetails[$i]["traineeCode"] = 	$value->traineeCode;
 			$printDetails[$i]["name"] = 	$value->name;
 			$printDetails[$i]["totaldays"] = 	$value->totalDays;
 			$printDetails[$i]["present"] = 	$value->present;
 			$printDetails[$i]["presentHoliday"] = 	$value->presentHoliday;
 			$printDetails[$i]["halfDay"] = 	$value->halfDay;
 			$printDetails[$i]["weekOff"] = 	$value->weekOff;
 			$printDetails[$i]["absent"] = 	$value->absent;
 			$printDetails[$i]["compOff"] = 	$value->compOff;
 			$printDetails[$i]["leave"] = 	$value->leaveDays;
 			$printDetails[$i]["sickLeave"] = 	$value->sickLeave;
 			$printDetails[$i]["arrears"] = 	$value->arrears;
 			$printDetails[$i]["paidDays"] = 	$value->paidDays;
 			$printDetails[$i]["stipend_rate"] = 	$stDetails->stipendRate;
 			$printDetails[$i]["stipend_per_Day"] = 	$value->perDayRate;
 			$printDetails[$i]["total_stipend"] = $value->stipendPayable;
 			$printDetails[$i]["totalExtraHrs"] = 	$value->totalExtraHours;
 			$printDetails[$i]["extraTraningHrsRate"] = 	$value->extraHrsRate;
 			$printDetails[$i]["totalExtraHrsAmt"] = 	$value->stipendPayableExtra;
 			$printDetails[$i]["attndAllownc"] = 	$value->attendAllowance;
 			$printDetails[$i]["productionAllownc"] = 	$value->productionAllownc;
 			$printDetails[$i]["otherAllwnc1"] = 	$value->otherAllowance1;
 			$printDetails[$i]["otherAllwnc2"] = 	$value->otherAllowance2;
 			$printDetails[$i]["otherAllwnc3"] = 	$value->otherAllowance3;
 			$printDetails[$i]["GrossTotalStipend "] = 	number_format( ($printDetails[$i]["total_stipend"] + $value->stipendPayableExtra + $value->attendAllowance + $value->productionAllownc + $value->otherAllowance1 + $value->otherAllowance2 + $value->otherAllowance3 ) ,2, '.', '');
 			if($reportType == "YSF"){
 				$printDetails[$i]["canteenDed"]   = $value->canteenDeduction + $value->ysfCanteen;
	 			$printDetails[$i]["transportDed"] = $value->transportDeduction  + $value->ysfTransport;
	 			$printDetails[$i]["shoeDed"] 	  = $value->shoeDeduction + $value->ysfShoes;
	 			$printDetails[$i]["uniformDed"]   =	$value->uniformDeduction + $value->ysfUniform;
	 			$printDetails[$i]["trainingDed"]  =	$value->trainingDeduction + $value->ysfTraining;
	 			$printDetails[$i]["advancesDed"]  =	$value->advanceDeduction + $value->ysfAdvance;
	 			$printDetails[$i]["other1Ded"]    =	$value->other1Deduction + $value->ysfOther1Deduction;
	 			$printDetails[$i]["other2Ded"]    =	$value->other2Deduction + $value->ysfOther2Deduction;
	 			$printDetails[$i]["other3Ded"]    =	$value->other3Deduction + $value->ysfOther3Deduction;
 				
 			}else{

 				$printDetails[$i]["canteenDed"]   = $value->canteenDeduction;
	 			$printDetails[$i]["transportDed"] = $value->transportDeduction;
	 			$printDetails[$i]["shoeDed"]      = $value->shoeDeduction;
	 			$printDetails[$i]["uniformDed"]   = $value->uniformDeduction;
	 			$printDetails[$i]["trainingDed"]  = $value->trainingDeduction;
	 			$printDetails[$i]["advancesDed"]  = $value->advanceDeduction;
	 			$printDetails[$i]["other1Ded"] = 	$value->other1Deduction;
	 			$printDetails[$i]["other2Ded"] = 	$value->other2Deduction;
	 			$printDetails[$i]["other3Ded"] = 	$value->other3Deduction;

 			}
 			$printDetails[$i]["totalDeductions"] = ($printDetails[$i]["canteenDed"]+$printDetails[$i]["transportDed"]+$printDetails[$i]["shoeDed"]+$printDetails[$i]["uniformDed"]+$printDetails[$i]["trainingDed"]+$printDetails[$i]["advancesDed"]+$printDetails[$i]["other1Ded"]+$printDetails[$i]["other2Ded"]+$printDetails[$i]["other3Ded"]);
 			$printDetails[$i]["netStipendPayable"] = $printDetails[$i]["GrossTotalStipend "] - $printDetails[$i]["totalDeductions"];

 			$i++;
 		}
	    $rowArray = array("Trainee Code","name","Total Days","Present Days","Paid Holiday","Half Day","Week Off","Absent","Compensatory Leave","Leave","Sick Leave","arrears","Paid Days","Stipend Rate","Stipend Per Day","Total Stipend","Total Extra Hrs","Extra training hrs Rate","Total Extra hrs Amount","Attendance Allowance","Production Allowance","Other Allowance 1","Other Allowance 2","Other Allowance 3","Gross Total","Canteen Dedication","Transport Dedication","Shoe Dedication","uniform Dedication","Training Dedication","Advances Dedication","Other Dedication 1","Other Dedication 2","Other Dedication 3","Total Deductions","Net Stipend Payable");

	    $spreadsheet = new Spreadsheet();
			$Excel_writer = new Xls($spreadsheet);
			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle("Pay Sheet Report ".$month." ".$year);
			$styleArray = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '00999999'),
		        ),
		    ),
		);

		$spreadsheet->getActiveSheet()->getStyle('A2:AJ2')->applyFromArray(
				array(
					'font'=>array(
						'size'=>14,
					)
				)
			);		

		$spreadsheet->getActiveSheet()
		    ->fromArray(
		        $rowArray,   // The data to set
		        NULL,        // Array values with this value will not be set
		        'A2'         // Top left coordinate of the worksheet range where
		                     //    we want to set these values (default is A1)
		    );
		   $spreadsheet->getActiveSheet()
			->fromArray(
			    $printDetails,  // The data to set
			    NULL,        // Array values with this value will not be set
			    'A3'         // Top left coordinate of the worksheet range where
			                 //    we want to set these values (default is A1)
			);
			for ($i=0; $i <= count($printDetails); $i++) { 
				for ($j=0; $j < count($rowArray); $j++) { 
					$spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+2)->getStyle()->applyFromArray($styleArray)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setWrapText(true);
						
				}
			}
		
		header('Content-Type: application/vnd.ms-excel');
		$cname = str_replace(".","",$processDetails[0]->companyName);
		$cname = str_replace(" ","_",$cname);
		$filename = "Paysheet_Report_".$cname."_".$month."_".$year.".xls";
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		if (ob_get_contents()) ob_end_clean();
		
		$Excel_writer->save('php://output');
		if (ob_get_contents()) ob_end_clean();
		
 	}
 	
 	
 	public function payadviceReport($month,$year,$companyID)
 	{
 		
 		$this->load->model("EmployeeModel");
 		$where = array("mu.companyID = "=>$companyID,"uploadMonth = "=>$month,"uploadYear = "=>$year);
 		$processDetails = $this->EmployeeModel->getPayAdviceData('',$where,array());
 		if(!isset($processDetails) || empty($processDetails)){
 			
 			$status['msg'] = $this->systemmsg->getErrorCode(273);
			$status['statusCode'] = 273;
			$status['flag'] = 'F';
			$this->load->view("error_message",$status);
			exit();
 		}
 		$printDetails = array();
 		$i=0;
 		$total = 0;
 		foreach ($processDetails as $key => $value) {
 			if(isset($value->bankAcNo) && !empty($value->bankAcNo)){

	 			$stDetails = json_decode($value->traineeStipends);
	 			$printDetails[$i]["srno"] = $i+1; 
	 			$printDetails[$i]["name"] = 	$value->name;
	 			$GrossTotalStipend = 	number_format( ($value->stipendPayable + $value->stipendPayableExtra + $value->attendAllowance + $value->productionAllownc + $value->otherAllowance1 + $value->otherAllowance2 + $value->otherAllowance3 ) ,2, '.', '');
	 			
				$canteenDed   = $value->canteenDeduction + $value->ysfCanteen;
	 			$transportDed = $value->transportDeduction  + $value->ysfTransport;
	 			$shoeDed 	  = $value->shoeDeduction + $value->ysfShoes;
	 			$uniformDed   =	$value->uniformDeduction + $value->ysfUniform;
	 			$trainingDed  =	$value->trainingDeduction + $value->ysfTraining;
	 			$advancesDed  =	$value->advanceDeduction + $value->ysfAdvance;
	 			$other1Ded    =	$value->other1Deduction + $value->ysfOther1Deduction;
	 			$other2Ded    =	$value->other2Deduction + $value->ysfOther2Deduction;
	 			$other3Ded    =	$value->other3Deduction + $value->ysfOther3Deduction;
					
	 			$totalDeductions = ($canteenDed+$transportDed+$shoeDed+$uniformDed+$trainingDed+$advancesDed+$other1Ded+$other2Ded+$other3Ded);
	 			$printDetails[$i]["netStipendPayable"] = $GrossTotalStipend - $totalDeductions;
				$printDetails[$i]["bankAcNo"] = sprintf($value->bankAcNo);
				$printDetails[$i]["bankIFSC"] = sprintf($value->bankIFSC);
				$total = $total + $printDetails[$i]["netStipendPayable"];
	 			$i++;
 			}
 		}
 		$printDetails[$i]["srno"] ="";
 		$printDetails[$i]["name"] = "TOTAL";
 		$printDetails[$i]["bankAcNo"] = $total;
 		$printDetails[$i]["bankIFSC"] = "";

	    $rowArray = array("SR NO.","Trainee Name","Amount","Bank A/C No.","IFSC Code");

	    $spreadsheet = new Spreadsheet();
			$Excel_writer = new Xls($spreadsheet);
			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle("Payment Advice Report ".$month." ".$year);
			$styleArray = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '00999999'),
		        ),
		    ),
		);

		$spreadsheet->getActiveSheet()->fromArray(
		        $rowArray,   // The data to set
		        NULL,        // Array values with this value will not be set
		        'A2'         // Top left coordinate of the worksheet range where
		                     //    we want to set these values (default is A1)
		    );
	   $spreadsheet->getActiveSheet()->fromArray(
		    $printDetails,  // The data to set
		    NULL,        // Array values with this value will not be set
		    'A3'         // Top left coordinate of the worksheet range where
				//    we want to set these values (default is A1)
		);
		
		for ($i=0; $i <= count($printDetails); $i++) { 
			for ($j=0; $j < count($rowArray); $j++) { 
				$spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+2)->getStyle()->applyFromArray($styleArray)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setWrapText(true);
			}
		}
		//print_r($processDetails[0]->companyID);exit;
		header('Content-Type: application/vnd.ms-excel');
		//$cname = str_replace(".","",'Payment_Advice_Report');
		//$cname = str_replace(" ","_",$cname);
		$filename = "Payment_Advice_Report_".$month."_".$year.".xls";
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		$Excel_writer->save('php://output');
		//if (ob_get_contents()) ob_end_clean();
		
 	}

 	public function trainingReportDetails()
 	{
 		$wherec = $join = $other = array();
 		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$companyID = $this->input->post('companyID');
		$reportType = $this->input->post('reportType');
		$branchID = $this->input->post('branchID');
		$createdBy = $this->input->post('createdBy');
		
		if(isset($companyID) && !empty($companyID)){
			$wherec["t.companyID "] = "='".$companyID."'";
		}
		if(isset($branchID) && !empty($branchID)){
			$wherec["t.branchID "] = "='".$branchID."'";
		}
		if(isset($createdBy) && !empty($createdBy)){
			$wherec["t.createdBy "] = "='".$createdBy."'";
		}
		$wherec["t.status "] = "!='delete'";
		
		if(isset($fromDate) && !empty($fromDate)){
			if(!isset($fromDate) || empty($fromDate)){
				$toDate = date("Y-m-d");
			}
			$wherec["date(t.createdDate) >= "] = "'".dateFormat($fromDate,"Y-m-d")."'";
			$wherec["date(t.createdDate) <= "] = "'".dateFormat($toDate,"Y-m-d")."'";
		}

 		$join[0]['type'] ="LEFT JOIN";
		$join[0]['table']="branchMaster";
		$join[0]['alias'] ="b";
		$join[0]['key1'] ="branchID";
		$join[0]['key2'] ="branchID";

		$join[1]['type'] ="LEFT JOIN";
		$join[1]['table']="companyMaster";
		$join[1]['alias'] ="c";
		$join[1]['key1'] ="companyID";
		$join[1]['key2'] ="companyID";

		$join[2]['type'] ="LEFT JOIN";
		$join[2]['table']="admin";
		$join[2]['alias'] ="a";
		$join[2]['key1'] ="createdBy";
		$join[2]['key2'] ="adminID";
		$selectC= "t.*,b.branchName,c.companyName,a.name";
 		$processDetails = $this->CommonModel->GetMasterListDetails($selectC,'trainingRecords',$wherec,'','',$join,$other);	

 		if(!isset($processDetails) || empty($processDetails)){
 			
 			$status['msg'] = $this->systemmsg->getErrorCode(273);
			$status['statusCode'] = 998;
			$status['flag'] = 'F';
			$this->load->view("error_message",$status);
			exit();
 		}
 		$printDetails = array();
 		$i=0;
 		$total = 0;
 		$printDetails = array();
 		foreach ($processDetails as $key => $value) {
			$printDetails[$i]["srno"] = $i+1; 
 			$printDetails[$i]["date"] = dateFormat($value->date,"d-m-Y");
 			$printDetails[$i]["name"] = 	$value->name;
 			$printDetails[$i]["branchName"] = 	$value->branchName;
 			$printDetails[$i]["companyName"] = 	$value->companyName;
 			$printDetails[$i]["location"] = 	$value->location;
 			$printDetails[$i]["jobRoll"] = 	$value->jobRoll;
 			$printDetails[$i]["topicCovered"] = 	$value->topicCovered;
 			$printDetails[$i]["traineePresent"] = 	$value->traineePresent;
 			$printDetails[$i]["trainingDuration"] = 	$value->trainingDuration;
 			$i++;
 		}
 		$rowArray = array("SR NO.","Training Date","Trainer Name","Branch Name","Company Name","Location","Job Role","Topic Covered","Trainees Present","Training Duration");

	    $spreadsheet = new Spreadsheet();
			$Excel_writer = new Xls($spreadsheet);
			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle("Training Report");

			$spreadsheet->getActiveSheet()->mergeCells('A1:J1');
			$spreadsheet->getActiveSheet()->setCellValue('A1','Training Report');
			$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');

			$description = "From Date:-"." "." ".$fromDate." "." "." "."To Date:-"." "." ".$toDate;
			$spreadsheet->getActiveSheet()->mergeCells('A2:J2');
			$spreadsheet->getActiveSheet()->setCellValue('A2',$description);
			$spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal('center');

			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setwidth(8);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setwidth(14);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setwidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setwidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setwidth(18);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setwidth(20);

			$styleArray = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '00999999'),
		        ),
		    ),
		);

		$spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray(
				array(
					'font'=>array(
						'size'=>24,
					)
				)
			);
			$spreadsheet->getActiveSheet()->getStyle('A2:J2')->applyFromArray(
				array(
					'font'=>array(
						'size'=>14,
					)
				)
			);

			$spreadsheet->getActiveSheet()->getStyle('A3:J3')->applyFromArray(
				array(
					'font'=>array(
						'size'=>12,
						'bold'=>true,
					)
				)
			);	

		$spreadsheet->getActiveSheet()->fromArray(
		        $rowArray,   // The data to set
		        NULL,        // Array values with this value will not be set
		        'A3'         // Top left coordinate of the worksheet range where
		                     //    we want to set these values (default is A1)
		    );
	   $spreadsheet->getActiveSheet()->fromArray(
		    $printDetails,  // The data to set
		    NULL,        // Array values with this value will not be set
		    'A5'         // Top left coordinate of the worksheet range where
				//    we want to set these values (default is A1)
		);
		
		for ($i=0; $i <= count($printDetails)+1; $i++) { 
			for ($j=0; $j < count($rowArray); $j++) { 
				$spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+3)->getStyle()->applyFromArray($styleArray)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setWrapText(true);
				//$spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+2)->getStyle()
					
			}
		}
	
		header('Content-Type: application/vnd.ms-excel');
		$cname = str_replace(".","","Training_Record");
		$cname = str_replace(" ","_",$cname);
		$filename = $cname."_".".xls";
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		//ob_start();
		$Excel_writer->save('php://output');
		//ob_end_clean();
		
 	}

 	public function assessmentRptDetails()
 	{
 		$wherec = $join = $other = array();
 		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$companyID = $this->input->post('companyID');
		$reportType = $this->input->post('reportType');
		$branchID = $this->input->post('branchID');
		$createdBy = $this->input->post('createdBy');
		
		if(isset($companyID) && !empty($companyID)){
			$wherec["t.companyID "] = "='".$companyID."'";
		}
		if(isset($branchID) && !empty($branchID)){
			$wherec["t.branchID "] = "='".$branchID."'";
		}
		if(isset($createdBy) && !empty($createdBy)){
			$wherec["t.createdBy "] = "='".$createdBy."'";
		}
		$wherec["t.status "] = "!='delete'";
		
		if(isset($fromDate) && !empty($fromDate)){
			if(!isset($fromDate) || empty($fromDate)){
				$toDate = date("Y-m-d");
			}
			$wherec["date(t.date) >= "] = "'".dateFormat($fromDate,"Y-m-d")."'";
			$wherec["date(t.date) <= "] = "'".dateFormat($toDate,"Y-m-d")."'";
		}

 		$join[0]['type'] ="LEFT JOIN";
		$join[0]['table']="branchMaster";
		$join[0]['alias'] ="b";
		$join[0]['key1'] ="branchID";
		$join[0]['key2'] ="branchID";

		$join[1]['type'] ="LEFT JOIN";
		$join[1]['table']="companyMaster";
		$join[1]['alias'] ="c";
		$join[1]['key1'] ="companyID";
		$join[1]['key2'] ="companyID";

		$join[2]['type'] ="LEFT JOIN";
		$join[2]['table']="admin";
		$join[2]['alias'] ="a";
		$join[2]['key1'] ="createdBy";
		$join[2]['key2'] ="adminID";
		$selectC= "t.*,b.branchName,c.companyName,a.name";
 		$processDetails = $this->CommonModel->GetMasterListDetails($selectC,'assessment',$wherec,'','',$join,$other);	
 		
 		if(!isset($processDetails) || empty($processDetails)){
 			
 			$status['msg'] =  $this->systemmsg->getErrorCode(273);
			$status['statusCode'] = 998;
			$status['flag'] = 'F';
			$this->load->view("error_message",$status);
			exit();
 		}
 		$printDetails = array();
 		$i=0;
 		$total = 0;
 		$printDetails = array();
 		foreach ($processDetails as $key => $value) {
			$printDetails[$i]["srno"] = $i+1; 
 			$printDetails[$i]["date"] = dateFormat($value->date,"d-m-Y");
 			$printDetails[$i]["name"] = 	$value->name;
 			$printDetails[$i]["branchName"] = 	$value->branchName;
 			$printDetails[$i]["companyName"] = 	$value->companyName;
 			$printDetails[$i]["location"] = 	$value->location;
 			$printDetails[$i]["jobRole"] = 	$value->jobRole;
 			$printDetails[$i]["presentTrainees"] = 	$value->presentTrainees;
 			$i++;
 		}
 		$rowArray = array("SR NO.","Training Date","Trainer Name","Branch Name","Company Name","Location","Job Role","Trainees Present");

	    $spreadsheet = new Spreadsheet();
			$Excel_writer = new Xls($spreadsheet);
			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle("Assessment Report");

			$spreadsheet->getActiveSheet()->mergeCells('A1:H1');
			$spreadsheet->getActiveSheet()->setCellValue('A1','Assessment Report');
			$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');

			$description = "From Date:-"." "." ".$fromDate." "." "." "."To Date:-"." "." ".$toDate;
			$spreadsheet->getActiveSheet()->mergeCells('A2:H2');
			$spreadsheet->getActiveSheet()->setCellValue('A2',$description);
			$spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal('center');

			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setwidth(8);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setwidth(14);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setwidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setwidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setwidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setwidth(18);

			$styleArray = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '00999999'),
		        ),
		    ),
		);

		$spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray(
				array(
					'font'=>array(
						'size'=>24,
					)
				)
			);
			$spreadsheet->getActiveSheet()->getStyle('A2:H2')->applyFromArray(
				array(
					'font'=>array(
						'size'=>14,
					)
				)
			);

			$spreadsheet->getActiveSheet()->getStyle('A3:H3')->applyFromArray(
				array(
					'font'=>array(
						'size'=>12,
						'bold'=>true,
					)
				)
			);	


			$styleArray = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '00999999'),
		        ),
		    ),
		);

		$spreadsheet->getActiveSheet()->fromArray(
		        $rowArray,   // The data to set
		        NULL,        // Array values with this value will not be set
		        'A3'         // Top left coordinate of the worksheet range where
		                     //    we want to set these values (default is A1)
		    );
	   $spreadsheet->getActiveSheet()->fromArray(
		    $printDetails,  // The data to set
		    NULL,        // Array values with this value will not be set
		    'A5'         // Top left coordinate of the worksheet range where
				//    we want to set these values (default is A1)
		);
		
		for ($i=0; $i <= count($printDetails)+1; $i++) { 
			for ($j=0; $j < count($rowArray); $j++) { 
				$spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+3)->getStyle()->applyFromArray($styleArray)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setWrapText(true);		
			}
		}
	
		header('Content-Type: application/vnd.ms-excel');
		$cname = str_replace(".","","Assessment_Report");
		$cname = str_replace(" ","_",$cname);
		$filename = $cname."_".".xls";
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		ob_end_clean();
		
		$Excel_writer->save('php://output');
		ob_end_clean();
		
 	}	
 	public function traineeReportDetails(){

 		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$reportType = $this->input->post('reportType');
		
		if(!isset($fromDate) || empty($fromDate)){
			$status['msg'] =  "From date Required.";
			$status['statusCode'] = 998;
			$status['flag'] = 'F';
			$this->load->view("error_message",$status);
			exit();
		}
		if(!isset($toDate) || empty($toDate)){
			$status['msg'] =  "To date Required.";
			$status['statusCode'] = 998;
			$status['flag'] = 'F';
			$this->load->view("error_message",$status);
			exit();
		}
		if(!isset($reportType) || empty($reportType)){
			$status['msg'] =  "Report Type Required.";
			$status['statusCode'] = 998;
			$status['flag'] = 'F';
			$this->load->view("error_message",$status);
			exit();
		}
		switch ($reportType) {
			case 'left':
				$this->leftTraineeReport();
				break;
			case 'placement':
				$this->placementTraineeReport();
				break;
			case 'traning':
				$this->trainingTraineeReport();
				break;
			
			default:
				# code...
				break;
		}

 	}
 	public function leftTraineeReport()
 	{
 		$wherec = $join = $other = array();
 		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$reportType = $this->input->post('reportType');
		
		
		if(isset($fromDate) && !empty($fromDate)){
			if(!isset($fromDate) || empty($fromDate)){
				$toDate = date("Y-m-d");
			}
			$wherec["date(t.leftDate) >= "] = "'".dateFormat($fromDate,"Y-m-d")."'";
			$wherec["date(t.leftDate) <= "] = "'".dateFormat($toDate,"Y-m-d")."'";
		}

		$join = array();
		$join[0]['type'] ="LEFT JOIN";
		$join[0]['table']="companyMaster";
		$join[0]['alias'] ="cm";
		$join[0]['key1'] ="companyID";
		$join[0]['key2'] ="companyID";

    	//$where = array("t.ysfCode = "=>"'".trim($id)."'");
		$select = "t.traineeName,t.ysfCode,t.mobile,t.email,t.neemID,t.traineeID,t.leftReason,DATE_FORMAT(t.leftDate,'%d-%m-%Y') as leftDate,cm.companyName,cm.companyAddress";
		$processDetails = $this->CommonModel->GetMasterListDetails($select,'traineeMaster',$wherec,'','',$join,$other=array());

 		if(!isset($processDetails) || empty($processDetails)){
 			
 			$status['msg'] = $this->systemmsg->getErrorCode(273);
			$status['statusCode'] = 998;
			$status['flag'] = 'F';
			$this->load->view("error_message",$status);
			exit();
 		}
 		$printDetails = array();
 		$i=0;
 		$total = 0;
 		$printDetails = array();
 		foreach ($processDetails as $key => $value) {
			$printDetails[$i]["srno"] = $i+1; 
 			$printDetails[$i]["traineeName"] = 	$value->traineeName;
 			$printDetails[$i]["ysfCode"] = 	$value->ysfCode;
 			$printDetails[$i]["mobile"] = 	$value->mobile;
 			$printDetails[$i]["email"] = 	$value->email;
 			$printDetails[$i]["neemID"] = 	$value->neemID;
 			$printDetails[$i]["leftDate"] = $value->leftDate;
 			$printDetails[$i]["leftReason"] = 	$value->leftReason;
 			$printDetails[$i]["companyName"] = 	$value->companyName;
 			$printDetails[$i]["companyAddress"] = 	$value->companyAddress;
 			$i++;
 		}
 		$rowArray = array("SR NO.","Trainee Name","YSF Code","Mobile No.","Email","Neem ID","Left Date","Left Reason","Company Name","Company Address");

	    $spreadsheet = new Spreadsheet();
			$Excel_writer = new Xls($spreadsheet);
			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle("Left Trainee Report");

			$spreadsheet->getActiveSheet()->mergeCells('A1:J1');
			$spreadsheet->getActiveSheet()->setCellValue('A1','Left Trainee Report');
			$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');

			$description = "From Date:-"." "." ".$fromDate." "." "." "."To Date:-"." "." ".$toDate;
			$spreadsheet->getActiveSheet()->mergeCells('A2:J2');
			$spreadsheet->getActiveSheet()->setCellValue('A2',$description);
			$spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal('center');

			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setwidth(8);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setwidth(14);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setwidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setwidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setwidth(18);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setwidth(20);

			$styleArray = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '00999999'),
		        ),
		    ),
		);

		$spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray(
				array(
					'font'=>array(
						'size'=>24,
					)
				)
			);
			$spreadsheet->getActiveSheet()->getStyle('A2:J2')->applyFromArray(
				array(
					'font'=>array(
						'size'=>14,
					)
				)
			);

			$spreadsheet->getActiveSheet()->getStyle('A3:J3')->applyFromArray(
				array(
					'font'=>array(
						'size'=>12,
						'bold'=>true,
					)
				)
			);	

		$spreadsheet->getActiveSheet()->fromArray(
		        $rowArray,   // The data to set
		        NULL,        // Array values with this value will not be set
		        'A3'         // Top left coordinate of the worksheet range where
		                     //    we want to set these values (default is A1)
		    );
	   $spreadsheet->getActiveSheet()->fromArray(
		    $printDetails,  // The data to set
		    NULL,        // Array values with this value will not be set
		    'A5'         // Top left coordinate of the worksheet range where
				//    we want to set these values (default is A1)
		);
		
		for ($i=0; $i <= count($printDetails)+1; $i++) { 
			for ($j=0; $j < count($rowArray); $j++) { 
				$spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+3)->getStyle()->applyFromArray($styleArray)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setWrapText(true);
				//$spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+2)->getStyle()
					
			}
		}
	
		header('Content-Type: application/vnd.ms-excel');
		$cname = str_replace(".","","Left_Trainee_Record");
		$cname = str_replace(" ","_",$cname);
		$filename = $cname."_".".xls";
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		//ob_start();
		$Excel_writer->save('php://output');
		//ob_end_clean();
		
 	}
 	public function placementTraineeReport()
 	{
 		$wherec = $join = $other = array();
 		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$reportType = $this->input->post('reportType');
		
		
		if(isset($fromDate) && !empty($fromDate)){
			if(!isset($fromDate) || empty($fromDate)){
				$toDate = date("Y-m-d");
			}
			$wherec["date(tod.joinDate) >= "] = "'".dateFormat($fromDate,"Y-m-d")."'";
			$wherec["date(tod.joinDate) <= "] = "'".dateFormat($toDate,"Y-m-d")."'";
		}

		$join = array();
		$join[0]['type'] ="LEFT JOIN";
		$join[0]['table']="companyMaster";
		$join[0]['alias'] ="cm";
		$join[0]['key1'] ="companyID";
		$join[0]['key2'] ="companyID";

		$join[1]['type'] ="LEFT JOIN";
		$join[1]['table']="traineeOtherDetails";
		$join[1]['alias'] ="tod";
		$join[1]['key1'] ="traineeID";
		$join[1]['key2'] ="traineeID";

    	$select = "t.traineeName,t.ysfCode,t.mobile,t.email,t.neemID,cm.companyName,cm.companyAddress,tod.*,DATE_FORMAT(tod.joinDate,'%d-%m-%Y') as joinDate,t.traineeID";
		$processDetails = $this->CommonModel->GetMasterListDetails($select,'traineeMaster',$wherec,'','',$join,$other=array());

 		if(!isset($processDetails) || empty($processDetails)){
 			
 			$status['msg'] = $this->systemmsg->getErrorCode(273);
			$status['statusCode'] = 998;
			$status['flag'] = 'F';
			$this->load->view("error_message",$status);
			exit();
 		}
 		$printDetails = array();
 		$i=0;
 		$total = 0;
 		$printDetails = array();
 		foreach ($processDetails as $key => $value) {
			$printDetails[$i]["srno"] = $i+1; 
 			$printDetails[$i]["traineeName"] = 	$value->traineeName;
 			$printDetails[$i]["ysfCode"] = 	$value->ysfCode;
 			$printDetails[$i]["mobile"] = 	$value->mobile;
 			$printDetails[$i]["email"] = 	$value->email;
 			$printDetails[$i]["neemID"] = 	$value->neemID;
 			$printDetails[$i]["companyName"] = 	$value->companyName;
 			$printDetails[$i]["companyAddress"] = 	$value->companyAddress;

 			$printDetails[$i]["placementCompany"] = $value->placementCompany;
 			$printDetails[$i]["placementCompanyAddress"] = 	$value->placementCompanyAddress;
 			$printDetails[$i]["designation"] = 	$value->designation;
 			$printDetails[$i]["empProof"] = 	$value->empProof;
 			$printDetails[$i]["salary"] = 	$value->salary;
 			$printDetails[$i]["joinDate"] = 	$value->joinDate;
 			$i++;
 		}
 		$rowArray = array("SR NO.","Trainee Name","YSF Code","Mobile No.","Email","Neem ID","Company Name","Company Address","Placement Company","Placement Company Address","Desigantion","Employment Proof","Salary","Join Date");

	    $spreadsheet = new Spreadsheet();
			$Excel_writer = new Xls($spreadsheet);
			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle("Placement Trainee Report");

			$spreadsheet->getActiveSheet()->mergeCells('A1:J1');
			$spreadsheet->getActiveSheet()->setCellValue('A1','Placement Trainee Report');
			$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');

			$description = "From Date:-"." "." ".$fromDate." "." "." "."To Date:-"." "." ".$toDate;
			$spreadsheet->getActiveSheet()->mergeCells('A2:J2');
			$spreadsheet->getActiveSheet()->setCellValue('A2',$description);
			$spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal('center');

			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setwidth(8);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setwidth(14);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setwidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setwidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setwidth(18);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setwidth(20);

			$styleArray = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '00999999'),
		        ),
		    ),
		);

		$spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray(
				array(
					'font'=>array(
						'size'=>24,
					)
				)
			);
			$spreadsheet->getActiveSheet()->getStyle('A2:J2')->applyFromArray(
				array(
					'font'=>array(
						'size'=>14,
					)
				)
			);

			$spreadsheet->getActiveSheet()->getStyle('A3:J3')->applyFromArray(
				array(
					'font'=>array(
						'size'=>12,
						'bold'=>true,
					)
				)
			);	

		$spreadsheet->getActiveSheet()->fromArray(
		        $rowArray,   // The data to set
		        NULL,        // Array values with this value will not be set
		        'A3'         // Top left coordinate of the worksheet range where
		                     //    we want to set these values (default is A1)
		    );
	   $spreadsheet->getActiveSheet()->fromArray(
		    $printDetails,  // The data to set
		    NULL,        // Array values with this value will not be set
		    'A5'         // Top left coordinate of the worksheet range where
				//    we want to set these values (default is A1)
		);
		
		for ($i=0; $i <= count($printDetails)+1; $i++) { 
			for ($j=0; $j < count($rowArray); $j++) { 
				$spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+3)->getStyle()->applyFromArray($styleArray)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setWrapText(true);
				//$spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+2)->getStyle()
					
			}
		}
	
		header('Content-Type: application/vnd.ms-excel');
		$cname = str_replace(".","","Placement_Trainee_Record");
		$cname = str_replace(" ","_",$cname);
		$filename = $cname."_".".xls";
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		//ob_start();
		$Excel_writer->save('php://output');
		//ob_end_clean();
		
 	}
 	public function trainingTraineeReport()
 	{
 		$wherec = $join = $other = array();
 		$fromDate = $this->input->post('fromDate');
		$toDate = $this->input->post('toDate');
		$reportType = $this->input->post('reportType');
		
		
		if(isset($fromDate) && !empty($fromDate)){
			if(!isset($fromDate) || empty($fromDate)){
				$toDate = date("Y-m-d");
			}
			$wherec["date(tod.traningDate) >= "] = "'".dateFormat($fromDate,"Y-m-d")."'";
			$wherec["date(tod.traningDate) <= "] = "'".dateFormat($toDate,"Y-m-d")."'";
		}

		$join = array();
		$join[0]['type'] ="LEFT JOIN";
		$join[0]['table']="companyMaster";
		$join[0]['alias'] ="cm";
		$join[0]['key1'] ="companyID";
		$join[0]['key2'] ="companyID";

		$join[1]['type'] ="LEFT JOIN";
		$join[1]['table']="traineeOtherDetails";
		$join[1]['alias'] ="tod";
		$join[1]['key1'] ="traineeID";
		$join[1]['key2'] ="traineeID";

    	$select = "t.traineeName,t.ysfCode,t.mobile,t.email,t.neemID,cm.companyName,cm.companyAddress,tod.*,DATE_FORMAT(tod.traningDate,'%d-%m-%Y') as traningDate,DATE_FORMAT(tod.vivaDate,'%d-%m-%Y') as vivaDate,DATE_FORMAT(tod.dateExamMobileApp,'%d-%m-%Y') as dateExamMobileApp,DATE_FORMAT(tod.dateBookletIssued,'%d-%m-%Y') as dateBookletIssued,DATE_FORMAT(tod.bookletDate,'%d-%m-%Y') as bookletDate,t.traineeID";
		$processDetails = $this->CommonModel->GetMasterListDetails($select,'traineeMaster',$wherec,'','',$join,$other=array());

 		if(!isset($processDetails) || empty($processDetails)){
 			
 			$status['msg'] = $this->systemmsg->getErrorCode(273);
			$status['statusCode'] = 998;
			$status['flag'] = 'F';
			$this->load->view("error_message",$status);
			exit();
 		}
 		$printDetails = array();
 		$i=0;
 		$total = 0;
 		$printDetails = array();
 		foreach ($processDetails as $key => $value) {
			$printDetails[$i]["srno"] = $i+1; 
 			$printDetails[$i]["traineeName"] = 	$value->traineeName;
 			$printDetails[$i]["ysfCode"] = 	$value->ysfCode;
 			$printDetails[$i]["mobile"] = 	$value->mobile;
 			$printDetails[$i]["email"] = 	$value->email;
 			$printDetails[$i]["neemID"] = 	$value->neemID;
 			$printDetails[$i]["companyName"] = 	$value->companyName;
 			$printDetails[$i]["companyAddress"] = 	$value->companyAddress;

 			$printDetails[$i]["traningDate"] = $value->traningDate;
 			$printDetails[$i]["topicCovered"] = 	$value->topicCovered;
 			$printDetails[$i]["testConduct"] = 	$value->testConduct;
 			$printDetails[$i]["vivaDate"] = 	$value->vivaDate;
 			$printDetails[$i]["isAppInstall"] = 	$value->isAppInstall;
 			$printDetails[$i]["dateExamMobileApp"] = 	$value->dateExamMobileApp;
 			$printDetails[$i]["dateBookletIssued"] = 	$value->dateBookletIssued;
 			$printDetails[$i]["bookletDate"] = 	$value->bookletDate;
 			$printDetails[$i]["tpa"] = 	$value->tpa;
 			$printDetails[$i]["remark"] = 	$value->remark;
 			$printDetails[$i]["certification"] = 	$value->certification;
 			$i++;
 		}
 		$rowArray = array("SR NO.","Trainee Name","YSF Code","Mobile No.","Email","Neem ID","Company Name","Company Address","Training Date","Topic Covered","Per Training Test Conducted","Date of Viva Conducted","Mobile App Installaton","Date of exam conducted through mobile app","Date of Booklet Issued","Booklet Check Date","TPA","Remark","Certification");

	    $spreadsheet = new Spreadsheet();
			$Excel_writer = new Xls($spreadsheet);
			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle("Placement Trainee Report");

			$spreadsheet->getActiveSheet()->mergeCells('A1:J1');
			$spreadsheet->getActiveSheet()->setCellValue('A1','Placement Trainee Report');
			$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');

			$description = "From Date:-"." "." ".$fromDate." "." "." "."To Date:-"." "." ".$toDate;
			$spreadsheet->getActiveSheet()->mergeCells('A2:J2');
			$spreadsheet->getActiveSheet()->setCellValue('A2',$description);
			$spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal('center');

			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setwidth(8);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setwidth(14);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setwidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setwidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setwidth(40);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setwidth(18);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setwidth(20);

			$styleArray = array(
		    'borders' => array(
		        'outline' => array(
		            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
		            'color' => array('argb' => '00999999'),
		        ),
		    ),
		);

		$spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray(
				array(
					'font'=>array(
						'size'=>24,
					)
				)
			);
			$spreadsheet->getActiveSheet()->getStyle('A2:J2')->applyFromArray(
				array(
					'font'=>array(
						'size'=>14,
					)
				)
			);

			$spreadsheet->getActiveSheet()->getStyle('A3:J3')->applyFromArray(
				array(
					'font'=>array(
						'size'=>12,
						'bold'=>true,
					)
				)
			);	

		$spreadsheet->getActiveSheet()->fromArray(
		        $rowArray,   // The data to set
		        NULL,        // Array values with this value will not be set
		        'A3'         // Top left coordinate of the worksheet range where
		                     //    we want to set these values (default is A1)
		    );
	   $spreadsheet->getActiveSheet()->fromArray(
		    $printDetails,  // The data to set
		    NULL,        // Array values with this value will not be set
		    'A5'         // Top left coordinate of the worksheet range where
				//    we want to set these values (default is A1)
		);
		
		for ($i=0; $i <= count($printDetails)+1; $i++) { 
			for ($j=0; $j < count($rowArray); $j++) { 
				$spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+3)->getStyle()->applyFromArray($styleArray)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER)->setWrapText(true);
				//$spreadsheet->getActiveSheet()->getCellByColumnAndRow($j+1,$i+2)->getStyle()
					
			}
		}
	
		header('Content-Type: application/vnd.ms-excel');
		$cname = str_replace(".","","Placement_Trainee_Record");
		$cname = str_replace(" ","_",$cname);
		$filename = $cname."_".".xls";
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		//ob_start();
		$Excel_writer->save('php://output');
		//ob_end_clean();
		
 	}
}