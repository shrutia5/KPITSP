<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class CompanyCommercialsModel extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getTotalCommercials($where=array(),$other=array())
	{
		$whereStr = "";
		$limitstr = "";
		foreach ($where as $key => $value) {
			if($whereStr == "")
				$whereStr .= $key." ".$value." ";
			else
				$whereStr .= " AND ".$key." ".$value." ";
 
		}
		if(trim($whereStr) != '' ){
			$whereStr = " WHERE ".$whereStr;
		}
		else{
			$whereStr="";
		}

		if(isset($other['whereIn']) && !empty($other['whereIn'])){
				
				if($whereStr == "")
					$whereStr .= " WHERE ".$other['whereIn']." IN (".$other['whereData'].") ";
				else
					$whereStr .= " AND ".$other['whereIn']." IN (".$other['whereData'].") ";
		}

		$sql = "SELECT c.*,cm.companyName FROM ".$this->db->dbprefix."companyCommercials as c LEFT JOIN ".$this->db->dbprefix."companyMaster as cm ON c.companyID = cm.companyID ".$whereStr."";
		//$sql = "SELECT commercialsID FROM ".$this->db->dbprefix."companyCommercials ".$whereStr."";
		$query = $this->db->query($sql);
		$rowcount = $query->num_rows();
		return $rowcount;
		
	}
	function GetCommercialsDetails($select = '',$where= array(),$limit='',$start='',$join='',$other=array())
	{
		$whereStr = "";
		$limitstr = "";
		foreach ($where as $key => $value) {
			if($whereStr == "")
				$whereStr .= $key." ".$value." ";
			else
				$whereStr .= " AND ".$key." ".$value." ";
 
		}
		if($start !='' && $limit!='')
		{
				$limitstr = "LIMIT ".$start.",".$limit;
		}
		else{
			$limitstr = "LIMIT 0,".$limit;
		}

		if(trim($whereStr) != '' ){
			$whereStr = " WHERE ".$whereStr;
		}
		else{
			$whereStr="";
		}
		if(isset($other['whereIn']) && !empty($other['whereIn'])){
				
				if($whereStr == "")
					$whereStr .= " WHERE ".$other['whereIn']." IN (".$other['whereData'].") ";
				else
					$whereStr .= " AND ".$other['whereIn']." IN (".$other['whereData'].") ";
		}
		if(isset($other['orderBy']) && !empty($other['orderBy']))
		{
			$orderBy = "ORDER BY ".$other['orderBy']." ".$other['order'];
		}else{
			$orderBy = "ORDER BY createdDate DESC";
		}

		$sql = "SELECT c.*,cm.companyName FROM ".$this->db->dbprefix."companyCommercials as c LEFT JOIN ".$this->db->dbprefix."companyMaster as cm ON c.companyID = cm.companyID ".$whereStr." ".$orderBy." ".$limitstr;
		
		$query = $this->db->query($sql);

		$result = $query->result();
		//print $this->db->last_query();
		return $result;
	}
	public function getCommercialsDetailsSingle($select="*",$where=array())
	{
		if(!isset($where) || empty($where))
		{
			return false;
		}
		
		$this->db->select($select);
		$this->db->from('companyCommercials');
		$this->db->where($where);
		$query = $this->db->get();
		$sqlerror = $this->db->error();
		$this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
		$result = $query->result();
		return $result;
	}
	public function saveCommercialsInfo($data,$commercialsID){

		$this->db->where("commercialsID",$commercialsID);
		$res = $this->db->update("companyCommercials",$data);
		$sqlerror = $this->db->error();
		$this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
		return $res;
	}
	public function createCommercialsInfo($data){

		$res = $this->db->insert("companyCommercials",$data);
		$sqlerror = $this->db->error();
		$this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
		return $this->db->insert_id();
	}
	public function getStipendCommercialsMaster($where=array(),$join=array())
	{
		if(!isset($where) || empty($where))
		{
			return false;
		}
		
		$select="cs.* , t.skillDesc";
		$this->db->select($select);
		$this->db->from('commercialStipendRateMaster as cs');
		$this->db->join("traineeSkillMaster as t"," ON cs.traineeSkillID = t.traineeSkillID ","INNER");
		$this->db->where($where);
		$query = $this->db->get();
		$sqlerror = $this->db->error();
		$this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
		$result = $query->result();
		//print $this->db->last_query();
		return $result;
	}
	public function createBatchSkillRateMaster($data,$isbatch=true){
		if($isbatch)
			$res = $this->db->insert_batch('commercialStipendRateMaster',$data); 
		else
			$res = $this->db->insert("commercialStipendRateMaster",$data);

		$sqlerror = $this->db->error();
		$this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
		return $res;
	}
	public function saveSkillRateMasterInfo($data,$CSRID){

		$this->db->where("CSRID",$CSRID);
		$res = $this->db->update("commercialStipendRateMaster",$data);
		$sqlerror = $this->db->error();
		$this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
		return $res;
	}
		
	
	public function changeCommercialsStatus($tableName,$statusCode,$ids,$primaryID){

		if(!isset($tableName) || empty($tableName)){
			return false;
		}
		if(!isset($ids) || empty($ids)){
			return false;
		}	

		if(!isset($primaryID) || empty($primaryID)){
			return false;
		}	

        $idlist = explode(",",$ids);
        $modifyBy = $this->input->post("SadminID");
        $data = array("status"=>$statusCode,"modifiedDate"=>date("Y/m/d H:i:s"),"modifiedBy"=>$modifyBy);
        $data = array("status"=>$statusCode);
        $this->db->where_in($primaryID,$idlist);
        $res = $this->db->update($tableName,$data);
        $sqlerror = $this->db->error();
        $this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
        return $res;
    }
   
    public function getSupervisorDetails($select="*",$where=array())
	{
		if(!isset($where) || empty($where))
		{
			return false;
		}
		
		$this->db->select($select);
		$this->db->from('commercialSupervisors');
		$this->db->where($where);
		$query = $this->db->get();
		$sqlerror = $this->db->error();
		$this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
		$result = $query->result();
		return $result;
	}
	public function createSupervisor($data){
		$res = $this->db->insert("commercialSupervisors",$data);
		$sqlerror = $this->db->error();
		$this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
		return $res;
	}
	public function updateSupervisor($data,$supervisorsID){

		$this->db->where("supervisorsID",$supervisorsID);
		$res = $this->db->update("commercialSupervisors",$data);
		$sqlerror = $this->db->error();
		$this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
		return $res;
	}
	public function deleteSupervisor($supervisorsID){

		$this->db->where("supervisorsID",$supervisorsID);
		$res = $this->db->delete("commercialSupervisors");
		$sqlerror = $this->db->error();
		$this->errorlogs->checkDBError($sqlerror,dirname(__FILE__),__LINE__,__METHOD__);
		return $res;
	}
	
}

	