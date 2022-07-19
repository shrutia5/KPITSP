<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CommonModel extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getCountByParameter($select, $table, $where = array(), $other = array(), $join = array()) {
        $whereStr = "";
        $limitstr = "";
        foreach ($where as $key => $value) {
            if ($whereStr == "")
                $whereStr .= $key . " " . $value . " ";
            else
                $whereStr .= " AND " . $key . " " . $value . " ";
        }
        $joinsql = '';
        if (isset($join) && !empty($join)) {
            foreach ($join as $key => $value) {
                $joinsql .= " " . $value['type'] . " " . $this->db->dbprefix . $value['table'] . " as " . $value['alias'] . " ON t." . $value['key1'] . " = " . $value['alias'] . "." . $value['key2'];
            }
        } else {
            $joinsql = "";
        }
        if (trim($whereStr) != '') {
            $whereStr = " WHERE " . $whereStr;
        } else {
            $whereStr = "";
        }
        if (isset($other['whereIn']) && !empty($other['whereIn'])) {

            if (trim($whereStr) == "")
                $whereStr .= " WHERE " . $other['whereIn'] . " IN (" . $other['whereData'] . ") ";
            else
                $whereStr .= " AND " . $other['whereIn'] . " IN (" . $other['whereData'] . ") ";
        }

        $sql = "SELECT " . $select . " FROM " . $this->db->dbprefix . $table . " as t " . $joinsql . $whereStr . "";

        //$sql = "SELECT ".$select." FROM ".$this->db->dbprefix."{$table} as t ".$joinsql.$whereStr." ".$orderBy." ".$limitstr;
        $query = $this->db->query($sql);
        $rowcount = $query->num_rows();
        return $rowcount;
    }

    public function GetMasterListDetails($select = '', $table, $where = array(), $limit = '', $start = '', $join = array(), $other = array()) {
        if ($select == '') {
            $select = "*";
        }
        $whereStr = "";
        $limitstr = "";
        foreach ($where as $key => $value) {
            if ($whereStr == "")
                $whereStr .= $key . "" . $value . " ";
            else
                $whereStr .= " AND " . $key . "" . $value . " ";
        }
        // change for all record. For linking to other form need all records. so skip pagination.
        if ($start != '' && $limit != '') {
            $limitstr = "LIMIT " . $start . "," . $limit;
        } else {
            if (isset($limit) && !empty($limit)) {
                $limitstr = "LIMIT 0," . $limit;
            } else {
                $limitstr = "";
            }
        }

        if (trim($whereStr) != '') {
            $whereStr = " WHERE " . $whereStr;
        } else {
            $whereStr = "";
        }

        if (isset($other['whereIn']) && !empty($other['whereIn'])) {

            if (trim($whereStr) == "")
                $whereStr .= " WHERE " . $other['whereIn'] . " IN (" . $other['whereData'] . ") ";
            else
                $whereStr .= " AND " . $other['whereIn'] . " IN (" . $other['whereData'] . ") ";
        }

        if (isset($other['orderBy']) && !empty($other['orderBy'])) {
            $orderBy = "ORDER BY " . $other['orderBy'] . " " . $other['order'];
        } else {
            $orderBy = "";
        }
        $joinsql = '';
        if (isset($join) && !empty($join)) {
            foreach ($join as $key => $value) {
                $t_table = "t";
                if (isset($value['t1alias'])) {
                    $t_table = $value['t1alias'];
                }
                $joinsql .= " " . $value['type'] . " " . $this->db->dbprefix . $value['table'] . " as " . $value['alias'] . " ON " . $t_table . "." . $value['key1'] . " = " . $value['alias'] . "." . $value['key2'];
            }
        } else {
            $joinsql = "";
        }

        $sql = "SELECT " . $select . " FROM " . $this->db->dbprefix . "{$table} as t " . $joinsql . $whereStr . " " . $orderBy . " " . $limitstr;
        //print ($sql); //exit;

        $query = $this->db->query($sql);


        if (isset($other["resultType"]) && !empty($other["resultType"])) {
            $result = $query->result_array();
        } else {
            $result = $query->result();
        }
        //print $this->db->last_query();
        return $result;
    }

    public function saveContactDetails($data) {
        $res = $this->db->insert("contactus", $data);
        $sqlerror = $this->db->error();
        $this->errorlogs->checkDBError($sqlerror, dirname(__FILE__), __LINE__, __METHOD__);
        return $res;
    }

    public function isSubscribed($email) {
        $this->db->select("*");
        $this->db->from("subscribe");
        $this->db->where('email', $email);
        $query = $this->db->get();
        $sqlerror = $this->db->error();
        $result = $query->result();
        $this->errorlogs->checkDBError($sqlerror, dirname(__FILE__), __LINE__, __METHOD__);
        return $result;
    }

    public function countFiltered($table) {
        $this->db->select("*");
        $this->db->from($table);
        $query = $this->db->get();
        $sqlerror = $this->db->error();
        $result = $query->num_rows();
        $this->errorlogs->checkDBError($sqlerror, dirname(__FILE__), __LINE__, __METHOD__);
        return $result;
    }

    public function getUniqueCode($length = 6) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; $i++) {
            $randomNumber = rand(0, $max - 1);
            $token .= substr($codeAlphabet, $randomNumber, 1);
        }
        return $token;
    }

    public function getMasterDetails($master = '', $select = "*", $where = array()) {
        if (!isset($select) || empty($select)) {
            $select = "*";
        }
        if (!isset($master) || empty($master)) {
            return false;
        }

        $this->db->select($select);
        $this->db->from($master);
        if (isset($where) && !empty($where)) {
            $this->db->where($where);
        }

        $query = $this->db->get();

        $sqlerror = $this->db->error();
        $this->errorlogs->checkDBError($sqlerror, dirname(__FILE__), __LINE__, __METHOD__);
        $result = $query->result();
        return $result;
    }

    public function getMobileDetails($where) {
        $this->db->select('*');
        $this->db->from('traineeMaster');
        if (isset($where) && !empty($where)) {
            $this->db->where('mobile', $where);
        }
        $query = $this->db->get();

        $sqlerror = $this->db->error();
        $this->errorlogs->checkDBError($sqlerror, dirname(__FILE__), __LINE__, __METHOD__);
        $result = $query->result();
        return $result;
    }

    public function getAadhaarDetails($where) {
        $this->db->select('*');
        $this->db->from('traineeMaster');
        if (isset($where) && !empty($where)) {
            $this->db->where('aadhaarNo', $where);
        }
        $query = $this->db->get();

        $sqlerror = $this->db->error();
        $this->errorlogs->checkDBError($sqlerror, dirname(__FILE__), __LINE__, __METHOD__);
        $result = $query->result();
        return $result;
    }

    public function saveMasterDetails($tableName, $data) {

        if (!isset($tableName) || empty($tableName)) {
            return false;
        }

        if (!isset($data) || empty($data)) {
            return false;
        }
        $res = $this->db->insert($tableName, $data);
        $sqlerror = $this->db->error();
        $this->errorlogs->checkDBError($sqlerror, dirname(__FILE__), __LINE__, __METHOD__);
        return $res;
    }

    public function updateMasterDetails($tableName, $data, $where) {

        if (!isset($tableName) || empty($tableName)) {
            return false;
        }
        if (!isset($data) || empty($data)) {
            return false;
        }
        if (!isset($where) || empty($where)) {
            return false;
        }
        $this->db->where($where);
        $res = $this->db->update($tableName, $data);
        $sqlerror = $this->db->error();
        $this->errorlogs->checkDBError($sqlerror, dirname(__FILE__), __LINE__, __METHOD__);
        return $res;
    }

    public function deleteMasterDetails($tableName, $where, $whereIn = array()) {
        if (!isset($tableName) || empty($tableName)) {
            return false;
        }
        if (!isset($where) || empty($where)) {
            return false;
        }


        $this->db->where($where);
        if (isset($whereIn) && !empty($whereIn)) {

            foreach ($whereIn as $key => $value) {
                $idlist = explode(",", $value);
                $this->db->where_in($key, $idlist);
            }
        }
        $res = $this->db->delete($tableName);
        //print $this->db->last_query();
        $sqlerror = $this->db->error();
        $this->errorlogs->checkDBError($sqlerror, dirname(__FILE__), __LINE__, __METHOD__);
        return $res;
    }

    public function changeMasterStatus($tableName, $statusCode, $ids, $primaryID) {

        if (!isset($tableName) || empty($tableName)) {
            return false;
        }
        if (!isset($ids) || empty($ids)) {
            return false;
        }

        if (!isset($primaryID) || empty($primaryID)) {
            return false;
        }

        $idlist = explode(",", $ids);
        $modifyBy = $this->input->post("SadminID");
        $data = array("status" => $statusCode, "modifiedDate" => date("Y/m/d H:i:s"), "modifiedBy" => $modifyBy);
        $this->db->where_in($primaryID, $idlist);
        $res = $this->db->update($tableName, $data);
        $sqlerror = $this->db->error();
        $this->errorlogs->checkDBError($sqlerror, dirname(__FILE__), __LINE__, __METHOD__);
        return $res;
    }

    public function getMonthByID($id) {
        $months = array("1" => "january", "2" => "february", "3" => "march", "4" => "april", "5" => "may", "6" => "june", "7" => "july", "8" => "august", "9" => "september", "10" => "october", "11" => "november", "12" => "december");
        return $months[$id];
    }

    public function num2words($num, $currency) {

        $ZERO = "zero";
        $MINUS = "minus";
        /* zero is shown as "" since it is never used in combined forms */ /* 0 .. 19 */
        $lowName = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen");
        $tys = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety");
        /* 0, 10, 20, 30 ... 90 */

        switch ($currency) {

            case 'INR':  //$groupName = array( "", "Hundred", "Thousand", "Lakh", "Crore","Arab", "Kharab"); 
                $groupName = array("", "Hundred", "Thousand", "Lakh", "Crore", "Hundred", "Thousand", "Lakh", "");

                // How many of this group is needed to form one of the succeeding group. 					
                // Indian: unit, hundred, thousand, lakh, crore 				
                //	$divisor = array( 100, 10, 100, 100,100000,100000000000) ;

                $divisor = array(100, 10, 100, 100, 100, 10, 100, 100, 10);
                break;
            case 'USD':  //$groupName = array( "", "Hundred", "Thousand", "Lakh", "Crore","Arab", "Kharab"); 
                $groupName = array("", "Hundred", "Thousand", "Million", "Billion", "Trillion", "");

                // How many of this group is needed to form one of the succeeding group. 					
                // Indian: unit, hundred, thousand, lakh, crore 				
                //	$divisor = array( 100, 10, 100, 100,100000,100000000000) ;

                $divisor = array(100, 10, 1000, 100000, 1000000000);
                break;

            case 'Paise': $groupName = array();
                $divisor = array(100);
                break;
        }
        $num = str_replace(",", "", $num);
        $num = number_format($num, 2, '.', '');
        $cents = substr($num, strlen($num) - 2, strlen($num) - 1);
        $num = (int) $num;

        $s = "";

        if ($num == 0)
            $s = $ZERO;
        $negative = ($num < 0 );
        if ($negative)
            $num = -$num;

        // Work least significant digit to most, right to left.
        // until high order part is all 0s.
        for ($i = 0; $num > 0; $i++) {
            $remdr = (int) ($num % $divisor[$i]);
            $num = $num / $divisor[$i];
            if ($remdr == 0)
                continue;

            $t = "";
            if ($remdr < 20)
                $t = $lowName[$remdr];
            else if ($remdr < 100) {
                $units = (int) $remdr % 10;
                $tens = (int) $remdr / 10;
                $t = $tys [$tens];

                if ($units != 0)
                    $t .= " " . $lowName[$units];
            } else
                $t = $inWords[$remdr];
            //echo $t; exit;

            $s = $t . " " . $groupName[$i] . " " . $s;
            $num = (int) $num;
        }

        $s = trim($s);
        if ($negative)
            $s = $MINUS . " " . $s;


        if (($cents != '00') && ($s == 'zero')) {
            $s = $cents . " Paise only";
            return $s;
        }


        switch ($currency) {

            case 'INR': $s .= " Rupees";
                if ($cents != '00')
                    $s .= " and " . $this->num2words($cents, 'Paise');

                $s .= " Only";
                break;
            case 'USD': $s .= " Dollar";
                if ($cents != '00')
                    $s .= " and " . $this->num2words($cents, 'Cents');

                $s .= " Only";
                break;
            case 'Paise': $s .= " Paise";
        }
        return $s;
    }

    public function saveFile($table, $fileColumn, $filename, $forignValue, $fileTypeColumn, $fileType, $forignKey, $extraData = array()) {
        //$data = array("createdBy"=>$adminID,"createdDate"=>date("Y/m/d H:i:s"),"$fileTypeColumn"=>$fileType,"$forignKey"=>$forignValue,"$fileColumn"=>$filename);

        $data = array("$forignKey" => $forignValue, "$fileColumn" => $filename);
        if (!empty($fileTypeColumn)) {
            $data["$fileTypeColumn"] = $fileType;
        }
        if (isset($extraData) && !empty($extraData)) {
            foreach ($extraData as $key => $value) {
                $data[$key] = $value;
            }

            $record = $this->getMasterDetails($table, '', $extraData);

            if (isset($record) && !empty($record)) {
                $isupdatepro = $this->updateMasterDetails($table, $data, $extraData);
                return $isupdatepro;
            }
        }
        $res = $this->db->insert($table, $data);
        $sqlerror = $this->db->error();
        $this->errorlogs->checkDBError($sqlerror, dirname(__FILE__), __LINE__, __METHOD__);
        return $res;
    }

    public function getMonth($key, $type = 'string') {

        if ($type == "string" && is_string($key)) {
            $d = date_parse($key);
            return $d['month'];
        }
        if ($type == "number" && is_numeric($key)) {
            $dateObj = DateTime::createFromFormat('!m', $key);
            return $dateObj->format('F');
        }
        return false;
    }

    public function projectSubmissionSteps() {
        return array(1 => 'Project Description', 2 => 'TRL 1 - Problem statement', 3 => 'TRL 2 - Solution is', 4 => 'TRL 3 - Idea Innovation is', 5 => 'TRL 4 - Prototype is');
    }

    public function phaseTwoSubmissionStatus() {
        return array(1 => 'Project Description', 2 => 'TRL 1 - Problem statement', 3 => 'TRL 2 - Solution is', 4 => 'TRL 3 - Idea Innovation is', 5 => 'TRL 4 - Prototype is');
    }

    public function getProjectSubmissionStatus($projectData) {
        $currentStep = $projectData->currentStep;
        $stepHtml = '';
        // Phase 1
        if ($projectData->projectStatus != "Approved") {

            $submissionSteps = $this->projectSubmissionSteps();

            foreach ($submissionSteps as $key => $status) {
                $stepStatus = $stepClass = '';
                $stepStatus = 'submitted';
                if ($key == $currentStep) {
                    $stepClass = 'active';
                    $stepStatus = 'pending';
                }
                if ($key > $currentStep) {
                    $stepClass = 'pending';
                    $stepStatus = 'pending';
                }
                if ($key == 5 && $currentStep == 6 && $projectData->phaseOneDataSubmited == 0) {
                    $stepStatus = 'pending';
                    $stepClass = 'active';
                }
                $stepHtml .= '<li class="' . $stepClass . '"><span class="trlStatusList">' . $status . ' ' . $stepStatus . '</span></li>';
            }
            if ($projectData->phaseOneDataSubmited == 1) {
                if ($projectData->projectStatus == "Reject") {
                    $stepHtml .= '<li class="pending"><span class="trlStatusList">Did not make it to the prototyping phase</span></li>';
                } else {
                    $stepHtml .= '<li class="pending"><span class="trlStatusList">Idea under Evaluation</span></li>';
                }
            }
        } else {

            // Phase 2
            if ($projectData->phaseTwoStatus != "Approved") {
                $stepHtml = '<li class=""><span class="trlStatusList">Approved for prototyping phase</span></li>';
                $phaseTwoDataSubmited = true;
                $hasPrototypeDataSubmited = true;

                if ($projectData->patentFiled == 1 && (empty($projectData->patentStatus) || empty($projectData->patentApplicationNumber))) {
                    $hasPrototypeDataSubmited = false;
                }

                if (!empty($projectData->technicalDescription) && !empty($projectData->keywords) && $hasPrototypeDataSubmited == true) {
                    $stepHtml .= '<li class=""><span class="trlStatusList">Text fields submitted</span></li>';
                    //Technical Description, Keywords and Patent information
                } else {
                    $phaseTwoDataSubmited = false;
                    $stepHtml .= '<li class="pending"><span class="trlStatusList">Text fields pending</span></li>';
                    //Technical Description, Keywords and Patent information
                }
                if (empty($projectData->leanCanvas)) {
                    $phaseTwoDataSubmited = false;
                    $stepHtml .= '<li class="pending"><span class="trlStatusList">Lean Canvas pending</span></li>';
                } else {
                    $stepHtml .= '<li class=""><span class="trlStatusList">Lean Canvas submitted</span></li>';
                }
                if (empty($projectData->valuePropositionCanvas)) {
                    $phaseTwoDataSubmited = false;
                    $stepHtml .= '<li class="pending"><span class="trlStatusList">Value Proposition Canvas pending</span></li>';
                } else {
                    $stepHtml .= '<li class=""><span class="trlStatusList">Value Proposition Canvas submitted</span></li>';
                }
                if (empty($projectData->simulationReport)) {
                    $phaseTwoDataSubmited = false;
                    $stepHtml .= '<li class="pending"><span class="trlStatusList">Simulation report pending</span></li>';
                } else {
                    $stepHtml .= '<li class=""><span class="trlStatusList">Simulation report submitted</span></li>';
                }
                if (empty($projectData->prototypeProgressVideo)) {
                    $phaseTwoDataSubmited = false;
                    $stepHtml .= '<li class="pending"><span class="trlStatusList">Prototype video pending</span></li>';
                } else {
                    $stepHtml .= '<li class=""><span class="trlStatusList">Prototype video submitted</span></li>';
                }
                if ($phaseTwoDataSubmited) {
                    if ($projectData->phaseTwoStatus == "Reject") {
                        $stepHtml .= '<li class="pending"><span class="trlStatusList">Did not make it to the Top 100 list</span></li>';
                    } else {
                        $stepHtml .= '<li class=""><span class="trlStatusList">Idea under Evaluation</span></li>';
                    }
                }
            } else {
                //Phaase 3
                $stepHtml = '<li class="active"><span class="trlStatusList">Idea in Top 100</span></li>';
                if ($projectData->phaseThreeStatus == "50") {
                    $stepHtml = '<li class="active"><span class="trlStatusList">Idea in Grand Finale</span></li>';
                }
            }
        }
        return $stepHtml;
    }

    public function getProjectMembers($projectId) {
        $join = array();
        $join[0]['type'] = "INNER JOIN";
        $join[0]['table'] = "userregistration";
        $join[0]['alias'] = "m";
        $join[0]['key1'] = "memberID";
        $join[0]['key2'] = "userID";

        $select = "t.memberID,m.firstname,m.lastName,m.status";
        $where = array("t.projectID=" => $projectId);
        $memberdetails = $this->GetMasterListDetails($select, 'membersdetails', $where, '', '', $join, '');

        $members = array();

        if (isset($memberdetails) && !empty($memberdetails)) {
            foreach ($memberdetails as $member) {
                if ($member->status == 'active')
                    $members[] = $member->firstname;
            }
            return implode(", ", $members);
        }
        return '-';
    }

    public function getMyMessages($memberID, $senderID, $limit = '', $start = '') {

        if ($start != '' && $limit != '') {
            $limitstr = "LIMIT " . $start . "," . $limit;
        } else {
            $limitstr = "LIMIT 0," . $limit;
        }
        /* $sql = "select * FROM (SELECT `m`.`userID`, `m`.`firstname`, `mm`.*
          FROM `".$this->db->dbprefix."register_user` as `m`
          INNER JOIN `".$this->db->dbprefix."messages` as `mm` ON `m`.`userID` = `mm`.`sender_id`
          WHERE `mm`.`receiver_id` = '".$memberID."' AND `mm`.`sender_id` = '".$senderID."'

          UNION ALL
          SELECT `m`.`userID`, `m`.`firstname`, `mm`.*
          FROM `".$this->db->dbprefix."register_user` as `m`
          INNER JOIN `".$this->db->dbprefix."messages` as `mm` ON `m`.`userID` = `mm`.`sender_id`
          WHERE `mm`.`receiver_id` = '".$senderID."' AND `mm`.`sender_id` = '".$memberID."') as temp ORDER BY  created_date  DESC
          ".$limitstr; */

        $sql = "select * FROM (SELECT `mm`.*
				FROM `" . $this->db->dbprefix . "messages` as `mm` WHERE `mm`.`receiver_id` = '" . $memberID . "' AND `mm`.`sender_id` = '" . $senderID . "' 
				UNION ALL
				SELECT `mm`.* FROM `" . $this->db->dbprefix . "messages` as `mm` WHERE `mm`.`receiver_id` = '" . $senderID . "' AND `mm`.`sender_id` = '" . $memberID . "') as temp ORDER BY  created_date  ASC 
				" . $limitstr;

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function logUserActivity($description, $activityType, $recordId) {

        $logData = array("description" => $description, "activityType" => $activityType, "recordId" => $recordId);
        $logData["activityUserId"] = $this->session->userdata('userId');
        $logData["activityUserName"] = $this->session->userdata('name');
        //var_dump($logData);exit;
        $this->saveMasterDetails('activity_logs', $logData);
    }

    public function sendProjectTextMessage($userid, $templateName) {

        $where = array("userID=" => $userid);
        $userDetails = $this->CommonModel->GetMasterListDetails('phoneNumber', 'userregistration', $where, '', '', '', '');
        if (!empty($userDetails) && isset($userDetails[0]) && !empty($userDetails[0]->phoneNumber)) {

            $number = $userDetails[0]->phoneNumber;

            $whereTmpl = array("tempName=" => "'" . $templateName . "'");
            $tmplDetails = $this->CommonModel->GetMasterListDetails('subject, emailContent, smsContent', 'emailMaster', $whereTmpl, '', '', '', '');

            if (!empty($tmplDetails) && isset($tmplDetails[0])) {
                $message = $tmplDetails[0]->smsContent;
                //file_put_contents("smslog/aa.txt", $number.":".$message. "\n", FILE_APPEND);
                //return;
                $url = "https://smsozone.com/api/mt/SendSMS?user=kpitpap&password=kpitpap@7654321&senderid=KSPRKL&channel=Trans&DCS=0&flashsms=0&number=$number&text=$message&route=2069";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //curl_setopt($ch, CURLOPT_POSTFIELDS);
                $contents = curl_exec($ch);
                //var_dump($contents);
                curl_close($ch);
            }
        }
    }

    public function validateUserType($userType) {
        if ($this->session->userdata('usertype') != $userType) {
            redirect("logout");
            exit;
        }
    }

    public function getProjectstatRecord($createdDate, $endDate) {


        $sql = "select count(projectID) as tot,WEEK(createdDate) weekdays FROM " . $this->db->dbprefix . "project_master WHERE createdDate BETWEEN '" . $createdDate . "' AND '" . $endDate . "' GROUP BY weekdays  ORDER BY  createdDate  ASC ";
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function getUserstatRecord($createdDate, $endDate) {


        $sql = "select count(userID) as tot,WEEK(createdDate) weekdays FROM " . $this->db->dbprefix . "userregistration WHERE createdDate BETWEEN '" . $createdDate . "' AND '" . $endDate . "' GROUP BY weekdays  ORDER BY  createdDate  ASC ";
        $query = $this->db->query($sql);
        $result = $query->result();

        return $result;
    }

    public function getNumberofRegistrations() {
        $sql = "select count(userID) as count FROM " . $this->db->dbprefix . "userregistration WHERE userType = 'User'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getNumberofNewRegistrations() {
        $sql = "select count(userID) as count FROM " . $this->db->dbprefix . "userregistration WHERE userType = 'User' AND (userID < 198 or userID > 5553)";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getNumberofIdeasSubmitted() {
        $sql = "select count(projectID) as count FROM " . $this->db->dbprefix . "project_master WHERE phaseOneDataSubmited = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getNumberofStates() {
        $sql = "select count(DISTINCT(state_id)) as count FROM " . $this->db->dbprefix . "userregistration WHERE userType = 'User' and (userID < 198 or userID > 5553)";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getNumberofColleges() {
        $sql = "select count(DISTINCT(college_id)) as count FROM " . $this->db->dbprefix . "userregistration WHERE userType = 'User' and (userID < 198 or userID > 5553)";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getNumberofPremColleges() {
        $sql = "select count(DISTINCT(ur.college_id)) as count FROM " . $this->db->dbprefix . "userregistration ur LEFT JOIN " . $this->db->dbprefix . "master_college mcol ON (mcol.college_id = ur.college_id) WHERE ur.userType = 'User' and (ur.userID < 198 or ur.userID > 5553) and mcol.is_premier = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getNumberofTopColleges() {
        $sql = "select count(DISTINCT(ur.college_id)) as count FROM " . $this->db->dbprefix . "userregistration ur LEFT JOIN " . $this->db->dbprefix . "master_college mcol ON (mcol.college_id = ur.college_id) WHERE ur.userType = 'User' and (ur.userID < 198 or ur.userID > 5553) and mcol.is_top_100 = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function getNumberofPremReg() {
        $sql = "select count(DISTINCT(ur.email)) as count FROM " . $this->db->dbprefix . "userregistration ur LEFT JOIN " . $this->db->dbprefix . "master_college mcol ON (mcol.college_id = ur.college_id) WHERE ur.userType = 'User' and (ur.userID < 198 or ur.userID > 5553) and mcol.is_premier = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
    public function getNumberofPremIdeas() {
        $sql = "select count(DISTINCT(mp.projectID)) as count FROM ab_project_master mp LEFT JOIN ab_userregistration ur ON (ur.userID = mp.userID) LEFT JOIN ab_master_college mcol ON (mcol.college_id = ur.college_id) WHERE mcol.is_premier = 1 and mp.phaseOneDataSubmited = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
    public function getNumberofTopReg() {
        $sql = "select count(DISTINCT(ur.email)) as count FROM " . $this->db->dbprefix . "userregistration ur LEFT JOIN " . $this->db->dbprefix . "master_college mcol ON (mcol.college_id = ur.college_id) WHERE ur.userType = 'User' and (ur.userID < 198 or ur.userID > 5553) and mcol.is_top_100 = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
    public function getNumberofTopIdeas() {
        $sql = "select count(DISTINCT(mp.projectID)) as count FROM ab_project_master mp LEFT JOIN ab_userregistration ur ON (ur.userID = mp.userID) LEFT JOIN ab_master_college mcol ON (mcol.college_id = ur.college_id) WHERE mcol.is_top_100 = 1 and mp.phaseOneDataSubmited = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

}
