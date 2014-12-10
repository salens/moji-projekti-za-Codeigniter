<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Main extends CI_Controller {
    
    
    function __construct() {
        parent::__construct();
        if($this->session->userdata('Logged') != TRUE){
              $this->load->view('view_MainPage/view_MainPage');
        }else {
            //$this->load->view('view_MainPage/view_MainPage');
        }       
    }
    
    function index(){       
        $date = date('Y-m-d H:i:s');
        $tillDate = date('2015-11-28 16:20:00');  
        if($date < $tillDate ){
            //$this->load->view('view_MainPage/view_MainPage');   
            
            $welcomeMssg['Wlc1'] = 'Hey welcome man! ;)';
            $welcomeMssg['Wlc2'] = 'One more time welcome man! ;)';
            $this->load->view('header', $welcomeMssg);  // ova tri su zamena za view_MainPage!
            $this->load->view('body');
            $this->load->view('footer');
        }
       
    }
  
    function register(){      
        $this->load->model('User');
        
        if(!empty($_POST)){
            $this->load->library('form_validation');        
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[6]|max_length[12]|xss_clean|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|max_length[12]|xss_clean|is_unique[users.password]');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|xss_clean|is_unique[users.email]');

            if($this->form_validation->run() == FALSE){               
                $this->load->view('view_MainPage/view_MainPage');  
            }else{
                    $data = [

                        'username'      =>      $this->input->post('username'),
                        'password'      =>      sha1($this->input->post('password')),
                        'email'         =>      $this->input->post('email'),
                        'role'          =>      'user',
                        'active'        =>      1
                    ];

                    if($this->User->save($data)){
                        
                        $this->session->set_flashdata('msgRegister', 'Uspesno ste se registrovali!');
                        redirect(base_url() . 'Main/index');
                    }
             }
        }
    }
    
    function login(){
        if($this->session->userdata('Logged') != TRUE){
              $this->load->view('view_MainPage/view_MainPage');
        }if($this->session->userdata('Logged') == TRUE){
              redirect(base_url() . 'RegisteredUsers/regUsersTable');
        }
        $this->load->model('User');
        
        if(!empty($_POST)){
            
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|xss_clean');
        
            if($this->form_validation->run() == FALSE){

                    $this->load->view('view_MainPage/view_MainPage');            
            }else{

                $data = [                          
                    'password'      => sha1($this->input->post('password')),
                    'email'         => $this->input->post('email')                   
                ];

                if($user = $this->User->check($data)){        
                   //var_dump($user['role']); exit();
                    if($user['role'] == 'admin'){  
                    $this->session->set_userdata(array( 
                        'Logged'        =>  TRUE,
                        'id'            =>  $user['id'],
                        'username'      =>  $user['username']
                        ));                 
                    redirect(base_url() . 'RegisteredUsers/regUsersAdminTable/');
                    }
                    elseif($user['role'] == 'user'){
                    $this->session->set_userdata('Logged' , TRUE);                 
                    redirect(base_url() . 'RegisteredUsers/regUsersTable');
                    }

                }else{  
                   
                    redirect(base_url());
                }

            }               
                
        }
       
    }
    
}