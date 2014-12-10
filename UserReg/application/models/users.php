<?php

class Users extends CI_Model {
    
     protected $table = 'users';


    function insertUsers($data){
            
        $this->db->insert($this->table, $data); 
        if($this->db->affected_rows() > 0) return true;
     
    }
    
    function getUsers(){
        
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0) return $query->result_array();
        return FALSE;
    }
    
    function deleteUser($id){
        $this->db->delete($this->table, array('id' => $id));   
        return true;
    }

}


?>
