<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MyController extends CI_Controller {
    
    public function index(){
      $this->_WelcomeScreen();     
   
    }
    
    function _WelcomeScreen(){
        $data['title'] = 'CRUD';
        $this->load->view('MyPage',$data);
    }   
    
    function insertValues(){
     
        $this->load->model('User');
        if($this->input->post('submit'))
        {
            $data = [
                'username'  => $this->input->post('username'),
                'password'  => $this->input->post('passwd'),
                'text'      => $this->input->post('text')
            ];
           if($this->User->insertUsers($data)) {
               
               redirect(base_url() . 'MyController/getAllValues');
           }
        }        
        
    }
            
    function getAllValues(){
        $this->load->model("User");
        
        $data['results'] = $this->User->getValues();
       
        $this->load->view('view_users', $data);
    }
    
    function delete($id){
        $this->load->model("User");
        if($this->User->delete($id)) 
        {
           redirect(base_url() . 'MyController/getAllValues');
        }
        
        else echo 'error';

    }
    
    function update(){
        $this->load->model("User");
        $id= $this->input->post('id');
        $data = array(
            'username' =>$this->input->post('username'),
            'password' =>$this->input->post('passwd'),
            'text' =>$this->input->post('text')
    );
    $this->User->editValues($id,$data);
        redirect(base_url() . 'MyController/getAllValues');
               
    }  
  
    
    function check($id)
    {
        $this->load->model("User");
        $this->User->checkUser($id);
        
        if($results = $this->User->checkUser($id))
        {
            
            $this->load->view('view_user',$results);
           
        } else  redirect(base_url() . 'MyController/getAllValues/');       
        
       
    } 
    
    function SignIn(){
        $this->load->view('myform');
    }
            
    function postSignIn(){
        
        
        if($_POST) {
            $this->load->helper(array('form','url'));
        
            $this->load->library('form_validation');

                    $this->form_validation->set_rules('username', 'Username','callback_username_check', 'trim|required|min_length[5]|max_length[12]|xss_clean');
                    $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]|md5');
                    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
                    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            if($this->form_validation->run()=== FALSE)
            {
                $this->load->view('myform');
                
             
            }
            else{

                $this->load->view('formsuccess');
            }
        } else {
            redirect(base_url('myController/SignIn'));
        }
        
        
    }
    
    function username_check($str){
        
        if($str == 'test')
        {
            $this->form_validation->set_message('username_check','The %s field can not be the word "test"');
            return FALSE;
            
        }
        else {
            return TRUE;
        }
    }
    
    
}

?>
