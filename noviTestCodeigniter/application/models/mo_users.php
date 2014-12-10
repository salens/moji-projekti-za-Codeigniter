<?php

class Mo_users extends CI_Model {
    
    protected $table = 'registerusers';
            
    function userValid($data){
        
        $this->db->insert($this->table,$data);
        
        if($this->db->affected_rows() > 0) return true; 
     
        
    }   
    
    function getUsers(){
        
        $query = $this->db->get($this->table);
        
        if ($query->num_rows() > 0){
            
            return $query->result_array();
        }   
        
        else return FALSE;
        
        }
    
        function deleteUser($id){
   
            if($this->db->delete($this->table, array('id' => $id))){       
            return $this->db->affected_rows();

                }

                    else return FALSE;
                }
                
        function editUser($id, $data){
            
             $this->db->where('id', $id);
             $this->db->update($this->table, $data); 
             
             if($this->db->_error_message()) return FALSE;
       
             return TRUE;
             
        }
        
        function UserCheck($id){
            
            $query = $this->db->get_where($this->table, array('id' => $id));
            
            if($query->num_rows() > 0)
            {
                return $query-> row_array();
                
            }
            return FALSE;
        }
                
  }
?>
