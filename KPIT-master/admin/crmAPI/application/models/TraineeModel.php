<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class TraineeModel extends CI_Model{
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }
        public function insertTraineeInfo($excelData,$companyID,$SadminID){
            $this->db->trans_begin();
            foreach ($excelData as $key => $value) {
                $sqlinsert ="";
                $updateDate = date("Y-m-d H:i:s");
                $year = date("Y");
                $timeStamp = microtime();
                
                //$sqlinsert1 = "".$this->db->dbprefix."traineeMaster SET companyID='".$companyID."',traineeName='".$value->traineeName."',companyTokenNo='".$value->companyTokenNo."',traineeSource='".$value->traineeSource."',neenRegtNo='".$value->neenRegtNo."',trainingStartDate='".$value->trainingStartDate."',trainingEndDate='".$value->trainingEndDate."',stipendRate='".$value->stipendRate."',stipendRateType='".$value->stipendRateType."',monthDayFactor='".$value->monthDayFactor."',extraMonthDayFactor='".$value->extraMonthDayFactor."',extraTimeType='".$value->extraTimeType."',extraRatio='".$value->extraRatio."',extraFixRate='".$value->extraFixRate."',shiftHours='".$value->shiftHours."',shoes='".$value->shoes."',uniform='".$value->uniform."',bankAcNo='".$value->bankAcNo."',bankName='".$value->bankName."',bankIFSC='".$value->bankIFSC."',bankBranch='".$value->bankBranch."',mobile='".$value->mobile."',panNo='".$value->panNo."',aadhaarNo='".$value->aadhaarNo."',presentAddress='".$value->presentAddress."',stateID='".$value->presentState."',skillID='".$value->skill."',casteCatID='".$value->casteCategory."',permanentAddress='".$value->permanentAddress."',permanentStateID='".$value->permanentState."',gender='".$value->gender."',dateOfBirth='".$value->dateOfBirth."',marriageStatus='".$value->marriageStatus."',bloodGroup='".$value->bloodGroup."',height='".$value->height."',weight='".$value->weight."',nsqfLevel='".$value->nsqfLevel."',specialization='".$value->specialization."',courseCurrentlyEnrolled='".$value->courseCurrentlyEnrolled."',placeOfTraining='".$value->placeOfTraining."',lastExamPass='".$value->lastExamPass."',jobRole='".$value->jobRole."',wcPolicy='".$value->wcPolicy."',acidentPolicy='".$value->acidentPolicy."',email='".$value->email."',certificate='".$value->certificate."',certificateNo='".$value->certificateNo."',leftDate='".$value->leftDate."',status='".$value->status."'";

                $sqlinsert1 = "".$this->db->dbprefix."traineeMaster SET companyID='".$companyID."',traineeName='".$value->traineeName."', regType='".$value->scheme."',companyTokenNo='".$value->companyTokenNo."',traineeSource='".$value->traineeSource."',neenRegtNo='".$value->neenRegtNo."',trainingStartDate='".$value->trainingStartDate."',trainingEndDate='".$value->trainingEndDate."',stipendRate='".$value->stipendRate."',stipendRateType='".$value->stipendRateType."',extraTimeType='".$value->extraTimeType."',extraRatio='".$value->extraRatio."',extraFixRate='".$value->extraFixRate."',shiftHours='".$value->shiftHours."',bankAcNo='".$value->bankAcNo."',bankName='".$value->bankName."',bankIFSC='".$value->bankIFSC."',bankBranch='".$value->bankBranch."',mobile='".$value->mobile."',aadhaarNo='".$value->aadhaarNo."',presentAddress='".$value->presentAddress."',stateID='".$value->presentState."',skillID='".$value->skill."',casteCatID='".$value->casteCategory."',permanentAddress='".$value->permanentAddress."',permanentStateID='".$value->permanentState."',gender='".$value->gender."',dateOfBirth='".$value->dateOfBirth."',marriageStatus='".$value->marriageStatus."',bloodGroup='".$value->bloodGroup."',height='".$value->height."',weight='".$value->weight."',nsqfLevel='".$value->nsqfLevel."',specialization='".$value->specialization."',courseCurrentlyEnrolled='".$value->courseCurrentlyEnrolled."',placeOfTraining='".$value->placeOfTraining."',lastExamPass='".$value->lastExamPass."',jobRole='".$value->jobRole."',email='".$value->email."',wcPolicy='".$value->wcPolicy."',acidentPolicy='".$value->acidentPolicy."',panNo='".$value->panNo."'";
                
                if(trim($value->trainneCode) !='' && $value->createNew =="Y"){
                    
                    $sqlinsert = "INSERT INTO ".$sqlinsert1.",createdDate='".$updateDate."',createdBy='".$SadminID."',ysfCode='".$value->trainneCode."'";
                    
                }else if(trim($value->trainneCode) !='' && $value->createNew =="N"){
                    $sqlinsert = "UPDATE ".$sqlinsert1.",modifiedDate='".$updateDate."',modifiedBy='".$SadminID."' where traineeID='".trim($value->traineeID)."'";
                }else /*if(trim($value->trainneCode) =='' && $value->createNew =="Y"){
                    $sqlinsert = "INSERT INTO ".$sqlinsert1.",createdDate='".$updateDate."',createdBy='".$SadminID."',ysfCode='PEN_".$year."-".$timeStamp."'";
                }else*/{
                    $sqlinsert = "UPDATE ".$sqlinsert1.",modifiedDate='".$updateDate."',modifiedBy='".$SadminID."' where traineeID='".trim($value->traineeID)."'";
                    
                }
                
                $res = $this->db->query($sqlinsert);
            }
            if($this->db->trans_status() === FALSE)
            {
                $sqlerror = $this->db->error();
                $this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
                $this->db->trans_rollback();
                return false;
                
            }else{
                return $this->db->trans_commit();
            }
        }
        
        public function gettempTraineeCode()
        {
            $sql = "SELECT traineeID,ysfCode from ".$this->db->dbprefix."traineeMaster where  ysfCode LIKE 'PEN_%'";
            $query = $this->db->query($sql);
            $sqlerror = $this->db->error();
            $this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
            $result = $query->result();
            return $result;
        }
        
        public function getTraineeDetails($select="*",$where=array())
        {
            if(!isset($where) || empty($where))
            {
                return false;
            }
            
            $this->db->select($select);
            $this->db->from('traineeMaster');
            $this->db->where($where);
            $query = $this->db->get();
            $sqlerror = $this->db->error();
            $this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
            $result = $query->result();
            return $result;
        }
        
    }
    
    
