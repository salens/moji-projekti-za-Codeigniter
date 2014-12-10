<?php

class DelKorisnik extends CI_Model {

    protected $table = 'registerusers';
    


    function deleteKorisnik($id){
        
        $this->db->delete($this->table, array('id' => $id));
        return $this->db->affected_rows();
        
    }
}


?>
