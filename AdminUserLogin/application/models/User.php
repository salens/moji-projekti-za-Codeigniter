<?php

class User extends CI_Model{

    protected $table = 'users';

    function __construct() {
        parent::__construct();
    }
    
    function save($data){
        
        $this->db->insert($this->table,$data);
        if($this->db->affected_rows() > 0) return TRUE;
        
    }
    
    function checkUser($data){
        
        $query = $this->db->get_where($this->table, array('username' => $data['username'], 'password' => $data['password'], 'role' => $data['role']));
   
        if($query->num_rows() == 1) return true;
        
        return FALSE;
        
    }
    
    function getUsers(){
       $query = $this->db->get($this->table);
        
         if ($query->num_rows() > 0){
           
             return $query->result_array();
             
        }else return FALSE;
    }
    
    function updateUser($id,$data){
        
        if(is_array($id)) $this->db->where_in('id', $id);
        else $this->db->where('id', $id);
        
        $this->db->update($this->table, $data);
        
        if(!$this->db->_error_message()) return TRUE;
        
        return FALSE;
        
    }
    
    function get_search($match){        
      
        $this->db->like('username',$match['username']);
        $this->db->or_like('email',$match['email']);
        $this->db->or_like('role',$match['role']);
        $query = $this->db->get($this->table);
        
        if($query->num_rows() == 1 || $query->num_rows() > 0){ 
            return $query->result();
            
        }  
        else{ 
            return FALSE;
            
        }  
        
    }
         
}

