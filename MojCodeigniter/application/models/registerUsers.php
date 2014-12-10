<?php

class RegisterUsers extends CI_Model {
    
    protected $table = 'registerusers';
              
      
    function NoviKorisnici($data){
        
        
       $this->db->insert($this->table, $data);               
       return true;       
             
            
    }    
   
}
?>
