<?php //defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User extends CI_Model{ 
    function __construct() { 
        // Set table name 
        $this->table = 'userregistration'; 
    } 
     
    /* 
     * Fetch user data from the database 
     * @param array filter data based on the passed parameters 
     */ 
    function getRows($params = array()){ 
        $this->db->select('*'); 
        $this->db->from($this->table); 
         
        if(array_key_exists("conditions", $params)){ 
            foreach($params['conditions'] as $key => $val){ 
                $this->db->where($key, $val); 
            } 
        } 

        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $this->db->count_all_results(); 
        }else{ 
            if(array_key_exists("id", $params) || $params['returnType'] == 'single'){ 
                if(!empty($params['id'])){ 
                    $this->db->where('id', $params['id']); 
                } 
                $query = $this->db->get(); 
                $result = $query->row_array();
                // print_r($result);
            }else{ 
                $this->db->order_by('id', 'desc'); 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $this->db->limit($params['limit']); 
                } 
                            
                $query = $this->db->get(); 
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
                

            } 
        } 
         
        // Return fetched data 
        return $result; 
    } 
     
    
}