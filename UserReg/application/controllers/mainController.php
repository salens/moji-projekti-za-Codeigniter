<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MainController extends CI_Controller {
    
        
    public function index(){

        $this->load->view('view_LogIn');
   }
   
   
     function userRegister(){        
       
        $this->load->model('Users');
         
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[6]|max_length[12]');
        
        if($this->form_validation->run() == FALSE){            
          
            $this->load->view('view_LogIn');
      
        }
        
        else{
            $data = array(

                'username'   => $this->input->post('username'),
                'password'   => $this->input->post('password'),
        );
            
           if($this->Users->insertUsers($data))
           {
                redirect(base_url() . 'MainController/getUsers');
                exit();
           }
            
        }
        
    }    
     
    
    function getUsers(){        
        $this->load->model('Users');
        $data['res'] = $this->Users->getUsers();
        $this->load->view('view_Users', $data);
  
    }
    
    function deleteUser($id){
        $this->load->model('Users');
        $this->Users->deleteUser($id);
        if($this->Users->deleteUser($id)){
            redirect(base_url() . 'MainController/getUsers');
            exit();
        } else echo 'error deleting User';
        
    }
    
    
}
   



?>
