<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
    
     public function index(){

        $this->load->view('view_FirstPage');
   }
   
     public function userValidation(){
        
        $this->load->model('Mo_users');
       
       
       
        if(!empty($_POST)){
           
            $this->load->library('form_validation');	
            $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|min_length[6]|max_length[12]');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[6]|max_length[12]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');         

        if($this->form_validation->run()=== FALSE){
               
                $this->load->view('view_FirstPage');

          }
        
             else{  
              
                    $data = array(

                        'username'   => $this->input->post('username'),
                        'password'   => sha1($this->input->post('password')),
                        'email'      => $this->input->post('email'),
                        'C#'         => $this->input->post('cSharp'),
                        'PHP'        => $this->input->post('php'),
                        'JS'         => $this->input->post('js'),
                        'C++'        => $this->input->post('cplusplus'),
                );                    
             
              if($this->Mo_users->userValid($data));
                   {
                       redirect(base_url() . 'main/viewUsers');
                       exit();
                   } 
           }
       }
   }


        function viewUsers(){
            
                $this->load->model('mo_users');            

                $data['results'] = $this->mo_users->getUsers();

                $this->load->view('view_Users',$data);

             }             
             
        function deleteUsr($id){
            
            $this->load->model('mo_users');                
            if($this->mo_users->deleteUser($id)){
                
                $this->session->set_flashdata('delUserMsg', 'Korisnik je obrisan!');
                redirect(base_url() . 'Main/viewUsers');
                exit();
                
            } else echo 'error';
            
        }
             
        function checkUser($id){
                 
            $this->load->model('mo_users');    
            $this->mo_users->UserCheck($id);
                 
            if($results['result'] = $this->mo_users->UserCheck($id)){
                     
                $this->load->view('view_EditUser',$results);
            }
            
        }
             
        function  editUserPage(){
                 
                 $this->load->view('view_EditUser');
             }
                     
        function editUsr($id){                
                  
                    $this->load->model('mo_users');               
                    
            
                
                $this->load->library('form_validation');
                $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean|min_length[6]|max_length[12]|');
                $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|min_length[6]|max_length[12]');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

                              
                            
            if($this->form_validation->run() == FALSE){

                $this->session->set_flashdata('errUsername', 'Za Username je potrebno minimum 6 karaktera, a maksimum 12.');                                                
                $this->session->set_flashdata('errPassword', 'Za Password je potrebno minimum 6 karaktera, a maksimum 12.');                        
                $this->session->set_flashdata('errEmail', 'Za Email je potrebno napisati validan email sa @ znakom i validnim domenom!');
            redirect(base_url() .'Main/checkUser/'.$id);                       
            exit();
            
            }              
                    
            else{
                    
                    $data = array(
                   'username'   =>  $this->input->post('username'),
                   'password'   =>  $this->input->post('password'),
                   'email'      =>  $this->input->post('email'),
                   'C#'         =>  ($this->input->post('cSharp') != '')    ? $this->input->post('cSharp') : 0, 
                   'PHP'        =>  ($this->input->post('php') != '')       ? $this->input->post('php') : 0,
                   'JS'         =>  ($this->input->post('js') != '')        ? $this->input->post('js') : 0,
                   'C++'        =>  ($this->input->post('cplusplus') != '') ? $this->input->post('cplusplus') : 0
           );                        
          
            if($this->mo_users->editUser($id,$data)){ 
                    
                $this->session->set_flashdata('msg', 'Korisnik je uspesno update-ovan!');
                redirect(base_url() . 'Main/viewUsers');
                exit();

                 }
            }
        }
}
?>
