<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MyValidationController extends CI_Controller {
    

    function insertValidation(){
        $this->load->model('Validation');
        
        if($_POST){
            
            $this->load->helper('form', 'url');
            
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('username','Username', 'required|xss_clean');
            $this->form_validation->set_rules('password', 'Password','required|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email');
            
        if($this->form_validation->run() === FALSE)
        
        {
             $this->load->view('view_NewUsers');
        }
        else{
            $data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'email'    => $this->input->post('email')                                    
            ];
            if($this->Validation->insertUsersValidations($data)) {           
               redirect(base_url() . 'MyValidationController/GetValidatedUsers');
            }
        }
                          
        }
      
    }
    
    
    
        function GetValidatedUsers(){
            $this->load->model('Validation');
            $data['results'] = $this->Validation->getValidationUsers();

            $this->load->view('view_ValidatedUsers', $data);
        }

        

        function AddUsers(){
            $this->load->view('view_NewUsers');

        }
        
}


?>
