<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MojAuthController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getLogin(){
       
        if($this->session->userdata('logged')){
        redirect(base_url() . 'UserDashboardController/start');
        exit();
        }
        $this->load->view('login/login');
       
    }
    
    public function postLogin(){
        
        if($this->session->userdata('logged')){
            redirect(base_url() . 'UserDashboardController/start');
            exit();
        }
        
        if(!empty($_POST)){
            
            $this->load->model('User');
            
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $password = sha1($password);
            
            if($user = $this->User->findUser($username, $password)){
                
                $this->session->set_userdata(array(
                    
                    'logged'    =>      TRUE,
                    'username'  =>      $user['username']
                    
                ));
              
                redirect(base_url() . 'UserDashboardController/start');
                exit();
                
            } else {
                
                 $this->session->set_flashdata('msg' , 'Invalid login credentials.');
                 redirect(base_url() . 'login');
                 exit();
                
            }
            
        }
            
            else{
                
                redirect(base_url() . 'login');
                exit();
            }
        }   
    
            public function getLogout(){

                $this->session->unset_userdata('logged');
                $this->session->sess_destroy();
                redirect(base_url() . 'login');
                exit();
            }

   
}
