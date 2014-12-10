<?php

class Blog extends CI_Model{

    protected $tableUsers= 'users';
    protected $table = 'blog';    
    protected $pivotTable = 'blogtag';
    protected $tableTag = 'tag'; 
    
    function __construct() {
        parent::__construct();
    }

    
    function insertPosts($data){

        $this->db->insert($this->table, $data);
        if($this->db->affected_rows() > 0)    return TRUE; 
        
        return  FALSE;
                
    }
    
    function getPosts(){
      $query = $this->db->select('*');
      $query = $this->db->from('users');
      $query = $this->db->join('blog', 'users.id = blog.U_id');       
      $query = $this->db->order_by('date' , 'DESC'); 
      $query = $this->db->get();
      
         if($query->num_rows() > 0){
            
            return $query->result_array();
        }else{
            return FALSE;
        }
    }   
    
     function delete($id){
         
        $query = $this->db->delete($this->table, array('B_id'  =>  $id));
        return $this->db->affected_rows();
    }  
    
     function checkBlog($B_id){
         
         $query = $this->db->get_where($this->table, array('B_id' => $B_id));
         
        if($query->num_rows() > 0) 
        {                    
           return $query->row_array();            
        }else{
            return FALSE;
        }
    }
            
     function editPosts($B_id, $data){
          
         $this->db->where('B_id',$B_id);
         $this->db->update($this->table, $data);
         
         if(!$this->db->_error_message()) return TRUE;
         
            return FALSE;
         
    }
    
    function deleteTagsForPost($postID) {
        $this->db->where(['idBlog' => $postID]);
        $this->db->delete($this->pivotTable);
        
        if(!$this->db->_error_message()) return TRUE;
         
        return FALSE;
    }
    
    function connectBlogAndTags($blogID, $tagID) {
        $this->db->insert($this->pivotTable, ['idBlog' => $blogID, 'idTag' => $tagID]);
       
        if($this->db->affected_rows() > 0) return TRUE;
        
        return FALSE;
    }
    
    function getBlogTags($blogID) {
        $this->db->select();
        $this->db->from($this->pivotTable);
        $this->db->where('idBlog', $blogID);
        $this->db->join('tag', 'blogtag.idTag = tag.id');
        $query = $this->db->get();
        
        if($query->num_rows() > 0) return $query->result_array();
        
        return FALSE;
    } 
    
    function getAllPosts(){
        $query = $this->db->select('users.username,blog.posts, tag.title, blog.date');
        $query = $this->db->from($this->tableUsers);    
        $query = $this->db->join('blog', 'users.id = blog.U_id');       
        $query = $this->db->join('blogtag', 'blog.B_id = blogtag.idBlog');   
        $query = $this->db->join('tag', 'blogtag.idTag = tag.id');
        $query = $this->db->get();       
        if($query->num_rows() > 0) return $query->result_array();
        
        else return FALSE;
    }

}
