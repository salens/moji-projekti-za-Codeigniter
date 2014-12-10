<?php

class File extends CI_Model{

    protected $table = 'file';

    function __construct() {
        parent::__construct();
    }
    
    function save($data){
        //echo var_dump($data); exit();
        $this->db->insert($this->table, $data);
        if($this->db->affected_rows() > 0) return TRUE;
    }
}