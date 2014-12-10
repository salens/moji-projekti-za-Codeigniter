<?php

class User extends CI_Model {
    
    protected $table = 'user';
    
    
    function getValues(){
        $query = $this->db->get($this->table);
        
        if($query->num_rows() > 0) 
        {
            return $query->result_array();
        }
        
        else return FALSE;
        
    }
    
    function insertUsers($data){ 
        $this->db->insert($this->table,$data);
        if($this->db->affected_rows() > 0) return $this->db->insert_id();
        return FALSE;
    }
    
    function delete($id){
       $this->db->delete($this->table, array('id' => $id));   
       return $this->db->affected_rows();
    }
    
    function editValues($id,$data){
                $this->db->where('id', $id);
                $this->db->update($this->table,$data);
    }
    
    function checkUser($id){        
      
       $query = $this->db->get_where($this->table, array('id' => $id));
      
        if($query->num_rows() > 0) 
        {                    
           return $query->row_array();            
        }
        
        return FALSE;
        
    }
    
    
}