<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  AuthController extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }
    
    function index(){
         
          $this->load->view('LogIn/LogIn');
    }
    
    function postLog(){
      
        $this->load->model('User');
        
        if(!empty($_POST)){
            
        $this->load->library('form_validation');	
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[6]|max_length[12]');  
   
        if($this->form_validation->run() == FALSE){       
 
             $this->load->view('LogIn/LogIn');
             
        }else{
            
            $data = [
                
                'username'      =>  $this->input->post('username'),
                'password'      =>  sha1($this->input->post('password')),
                'role'          =>  'admin',            
              
           ];
            
        if($this->User->checkUser($data)){
               
                  redirect(base_url() . 'AuthController/adminUsers');
               
            }else{
                $this->session->set_flashdata('SimpleUserLogged' , TRUE);  
                redirect(base_url() . 'Main/simpleUsers');
            }
            
        }
    }
    
}
        function adminUsers(){
                $this->session->set_userdata('Logged' , TRUE);
                $this->load->view('AdminUsers/AdminUsers');            
        }
        
        function viewAllUsers(){
             
             $this->load->model('User');
          
        if($this->session->userdata('Logged')){
            if($data['results'] = $this->User->getUsers()){
             
             $this->load->view('viewAllUsers/viewAllUsers' , $data); 
             }else{                  
                   $this->load->view('viewAllUsers/viewAllUsers' , $data); 
                }
             }
        }
        
        function getUserInfo(){        
            
             $this->load->model('User'); 
         
             if(!empty($_POST)){
                 $id = $this->input->post('admin');                  
                 $data = [                        
                         'role'   =>    'admin'                     
                   ];                 
        
                   if($this->User->updateUser($id,$data)){                 
                        redirect(base_url() . 'AuthController/viewAllUsers');
                   }
             }else{                
                 $this->session->set_flashdata('msg', 'Morate chekirati nekog ud User-a');                
                 redirect(base_url() . 'AuthController/viewAllUsers');
             }
        }
        
        function LogOut(){
            
            $this->session->unset_userdata('Logged');
            $this->session->sess_destroy();
          if($this->session->userdata('Logged') == FALSE){
            redirect(base_url() . 'Main/index');
          }
        }
        
        function search(){
      
            $this->load->model('User');       
     
              
              $match = [
                
                'username'      =>  $this->input->post('search'),
                'email'         =>  $this->input->post('search'),
                'role'          =>  $this->input->post('search')            
              
                    ];
              
            $this->load->library('form_validation');	
            $this->form_validation->set_rules('search', 'Search', 'required|trim|xss_clean|');     
            $data['result'] = $this->User->get_search($match);
                
            if($this->form_validation->run() == FALSE){
                
                $this->load->view('Search/Search', $data);         
              }  
              
             else if ($data['result'] = $this->User->get_search($match)){
                  
                     $this->load->view('Search/Search', $data); 
              }else{     

                    $this->session->set_flashdata('err', 'That user doesn\'t exists');
                    redirect(base_url() . 'AuthController/search');
                }
        }
}