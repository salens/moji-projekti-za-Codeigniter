<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }
    
    function index(){
       
        $this->load->view('userRegister/userRegister');
    }
    
    function saveNewUser(){
        
        $this->load->model('User');
   
        if(!empty($_POST)){
        $this->load->library('form_validation');	
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
   
        if($this->form_validation->run() == FALSE){           
      
            $this->session->set_flashdata('msg' , 'Invalid Username, Password or Email');
            $this->load->view('userRegister/userRegister');
            
        } else{
            
            $data = [
              
                'username'      =>  $this->input->post('username'),
                'password'      =>  sha1($this->input->post('password')),
                'email'         =>  $this->input->post('email'),
                'role'          =>  'user'
            ];
            
            if($this->User->save($data)){
                 
                 $this->session->set_flashdata('msg' , 'Success');
                 redirect(base_url() . 'AuthController/index');
            }
        }
        }
    }  
    
    function simpleUsers(){
             
             $this->load->model('User');           
            
             if($this->session->flashdata('SimpleUserLogged')){                 
                 $data['results'] = $this->User->getUsers();
                 $this->load->view('SimpleUsers/SimpleUsers' , $data); 
             }else{
                 echo 'error';
             }
           
        }
    
}
