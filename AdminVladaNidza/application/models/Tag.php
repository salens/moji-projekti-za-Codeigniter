<?php

class Tag extends CI_Model{

    protected $tableUsers= 'users';
    protected $tableBlog = 'blog';
    protected $tableBlogTag = 'blogtag';
    protected $tableTag = 'tag';
    
    function __construct() {
        parent::__construct();
    }
    
    function addTag($data){
        
        $this->db->insert($this->tableTag, $data);
       
        if($this->db->affected_rows() > 0)  return $this->db->insert_id();
        
         return  FALSE;
    }   
    
    function checkTag($tag) {
        $query = $this->db->get_where($this->tableTag, array('title' => $tag));
        
        if($query->num_rows() > 0) return $query->row();
        
        return FALSE;
    }
    
    function checkIdTags($t){
        $query = $this->db->get_where($this->tableBlogTag, array('idTag' => $t));
        
        if($query->num_rows() > 0) return $query->result_array();
        
        return FALSE;
        
    }   
   
}