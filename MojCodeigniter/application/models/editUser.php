<?php

class EditUser extends CI_Model {
    
    protected $table = 'registerusers';
    
    public function __construct() {
        parent::__construct();
    }
            
     
    function editA($id, $data){
        
       $this->db->where('id', $id);
       $this->db->update('registerusers', $data);   
         
        
        //ovo je vaznoooo jako kad se edituje!
       
       
       if($this->db->_error_message()) return FALSE;
       
       return TRUE;
    }  
    
    function m_getID($id){
        
        $query = $this->db->get_where($this->table, array('id' => $id));
        
        if($query->num_rows() > 0) 
        {                    
           return $query->row_array();
            
        }
        
        return FALSE;
    }
    
}

?>
