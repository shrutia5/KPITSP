<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'../../admin/crmAPI/vendor/autoload.php';
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

 	public function reports(){
 		
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
 	
}