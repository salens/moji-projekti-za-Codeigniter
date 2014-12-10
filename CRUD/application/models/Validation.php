<?php

class Validation extends CI_Model {
    
    protected $table = 'validation';
    
        function insertUsersValidations($data){
        $this->db->insert($this->table,$data);
        if($this->db->affected_rows() > 0) return $this->db->insert_id();
        return FALSE;
    }

    function getValidationUsers(){

        $query = $this->db->get($this->table);

        if($query->num_rows() > 0 )
        {
            return $query->result_array();
        }

        else return FALSE;
    }
}


?>
