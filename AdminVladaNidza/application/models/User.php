<?php

class User extends CI_Model{

    protected $table = 'users';

    function __construct() {
        parent::__construct();
    }
    
    function save($data){        
        $this->db->insert($this->table, $data);
        if($this->db->affected_rows() > 0) return TRUE;
    }

    function check($data){  
       

        $query = $this->db->get_where($this->table,$data);
 

        if($query->num_rows() == 1) 
        {                    
           return $query->row_array();            
         }else{
            return FALSE;
        }
    }
    
    function getUsers(){
        
       $query = $this->db->get($this->table);
        if($query->num_rows() > 0){
            
            return $query->result_array();
            
        }else{
            return FALSE;
        }
    }
    
    function delete($id){
        
        $this->db->delete($this->table, array('id'  =>  $id));
        return $this->db->affected_rows();
    }  
     
    function checkUser($id){        
      
       $query = $this->db->get_where($this->table, array('id' => $id));
      
        if($query->num_rows() > 0) 
        {                    
           return $query->row_array();            
        }
        
        return FALSE;
        
    }
    
    function edit($id,$data){
        $this->db->where('id', $id);
        $this->db->update($this->table,$data);
        
        if(!$this->db->_error_message()) return TRUE;
        
        return FALSE;
    }    
    
}