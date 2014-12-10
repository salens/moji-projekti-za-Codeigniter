<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MojKontroler extends CI_Controller {
    
    
    public function index(){
        
        $this->FirstPage();
    }
    
    public function FirstPage(){
        $data['header'] = 'Welcome to myFirst Page';
        $data['naslov'] = 'Dobrodosli novi korisnici';
        $this->load->view('HeaderPage', $data);
    }
    
    
    function regUser(){
        
        $this->load->model('registerUsers');      
     
        
        if($this->input->post('submit'))
        {
            
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username','Username', 'required|trim|xss_clean|min_length[6]|max_length[12]|is_unique[registerusers.username]');
        $this->form_validation->set_rules('password','Password','required|trim|xss_clean|min_length[6]|max_length[12]|is_unique[registerusers.password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[registerusers.email]');
        
        if($this->form_validation->run()=== FALSE)
        {
              $data['header'] = 'Welcome to myFirst Page';
              $data['naslov'] = 'Dobrodosli novi korisnici';
              $this->load->view('HeaderPage',$data);
        }
        
        else{
            $data = [
                'username' => $this->input->post('username'),                
                'password' => $this->input->post('password'),                
                'email'    => $this->input->post('email')
            ];
            
            if($this->registerUsers->NoviKorisnici($data)){
                
                
                
                $this->session->set_flashdata('msg', 'Uspesno ste uneli novog korisnika.');
              redirect(base_url() . 'mojKontroler/PrikaziKorisnika');
              exit();
             
            }      
        }
            
        }      
       
    }
    
     function PrikaziKorisnika(){
         
         $this->load->model('users');
         $data['header'] = "Welcome to Registrated User's Page";
         $data['naslov'] = 'Dobrodosli novi korisnici';
         $data['rezultati'] = $this->users->GetKorisnici();
         $this->load->view('PrikazRegKorisnike', $data);
    }
    
    function deleteKorisnik($id){
        
        $this->load->model('delKorisnik');
        if($this->delKorisnik->deleteKorisnik($id)){
             $this->session->set_flashdata('msg', 'Korisnik nije obrisan.');
              redirect(base_url() . 'mojKontroler/PrikaziKorisnika');
              exit();
        }
        
        else echo 'error';
    }  
    
    
    
    
     function editovanjeKorisnika($id){
          $this->load->model("editUser");
          if(!$data['user'] = $this->editUser->m_getID($id)){
              
              $this->session->set_flashdata('msg', 'Korisnik nije pronadjen.');
              redirect(base_url() . 'mojKontroler/PrikaziKorisnika');
              exit();
          }
          
        
          $data['naslov'] = 'Dobrodosli novi korisnici';
          $this->load->view('UserEdit',$data);         
        
    }
    
    function update(){       
               
        $this->load->model("EditUser");         
        $id= $this->input->post('id');  
        
        
        
        if($this->EditUser->m_getID($id)){            
        
        
        $data['username']   = $this->input->post('username');
        $data['password']   = $this->input->post('password');
        $data['email']      = $this->input->post('email');
           
         }
         
        if($this->EditUser->editA($id, $data)){    
            
            $this->session->set_flashdata('msg', 'Korisnik je uspesno update-ovan.');
            redirect(base_url() . 'mojKontroler/PrikaziKorisnika');
            exit();
        } else echo'error';
               
    }  
 

}
  


?>
