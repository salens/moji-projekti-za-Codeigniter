<?php

class Users extends CI_Model {
       
    protected $table = 'registerusers';
    
     function GetKorisnici(){
         
         $guery = $this->db->get($this->table);
         
         if($guery->num_rows() > 0)
         {
             return $guery->result_array();
         }
         
         else return FALSE;
         
     }

}
?>
