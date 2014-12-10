<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserRegistrationController extends CI_Controller {

    public function __construct() {
        parent::__construct();        
         
    }    
    
    public function index(){
        $this->load->library('form_validation');
        $this->load->view('userRegister/userRegister');
    }

    public function userReg(){
          
        $this->load->model('User');
        
        if(!empty($_POST)){
            
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'required||min_length[6]|max_length[12]|trim|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[12]|trim|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            
            if($this->form_validation->run() == FALSE){
                $this->load->view('userRegister/userRegister');
            }
            else{
                $data = [
                    
                    'username'   => $this->input->post('username'),
                    'password'   => sha1($this->input->post('password')),
                    'email'      => $this->input->post('email'),
                    'active'     => 0,
                    'code'       => sha1(microtime())
                ];
                
                if($userID = $this->User->save($data)){                 
                    redirect(base_url() . 'UserRegistrationController/userActivate/' . $userID);
                    exit();
                }
            }
        }     
        
    }
    
      public function userActivate($id){     
         
          $this->load->model('User');
          if($user = $this->User->checkID($id)){   
            
          $data['user'] = $user;
          $this->load->view('userActiv/userActiv', $data);
          
          }
      }
      
      public function userCheckIn($id){
          
          $this->load->model('User');   
          
           $data = [                    
                    'active'     => 1,
                    'code'       => ''
                ];
           
          if($this->User->update($id, $data)){
              $this->session->set_flashdata('wlc', 'Dobrodosli novi korisnici!');
              redirect(base_url() . 'UserRegistrationController/showActivatedUsers/');
              exit();
          }          
            
          else echo 'error';   
          
      }
      
       public function showActivatedUsers(){
         
             $this->load->model('User');              
             
             $data['results'] = $this->User->showActivatedUsers();
             $this->load->view('activatedUsers/activatedUsers',$data);          
             
       }
      
}
