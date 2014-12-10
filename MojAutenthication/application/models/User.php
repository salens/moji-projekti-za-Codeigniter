<?php

class User extends CI_Model{
    
    
    protected $table = 'users';
     
    public function __construct() {
        parent::__construct();
    }
    
    public function findUser($username,$password, $active = 1){
        
        $this->db->where(array(
                
                'username'  =>  $username,
                'password'  =>  $password,
                'active'    =>  $active
                ));
        
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0){
           
            return $query->row_array();
        }
        
        return FALSE;
        
    }
    
    public function save($data){
        
        $this->db->insert($this->table, $data);
        if($this->db->affected_rows() > 0) return $this->db->insert_id();
    
        return FALSE;
    }
    
    public function checkID($id){
        
        $this->load->model('User');
        $query = $this->db->get_where($this->table, array('id' => $id));
        
        if($query->num_rows() > 0){
            
            return $query->row_array();
        }
        
        return FALSE;
    }
    
    public function update($id, $data){        
     
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        
        if(!$this->db->_error_message()) return TRUE;
    
        return FALSE;       
        
 
    }
    
     public function showActivatedUsers($active = 1){
        
        $this->db->where(array(
            
                'active'    =>  $active
                ));
        
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0){
           
            return $query->result_array();
        }
        
        return FALSE;
        
    }
}
?>
