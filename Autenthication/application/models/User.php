<?php

class User extends CI_Model {
    
    protected $table = 'users';


    public function __construct() {
        parent::__construct();
    }
    
    public function findUser($username, $password, $active = 1) {
        $this->db->where(array(
            'username'  => $username,
            'password'  => $password,
            'active'    => $active
        ));
        
        $query = $this->db->get($this->table);
        
        if($query->num_rows() > 0) {
            return $query->row_array();
        }
        
        return FALSE;
                
    }
}