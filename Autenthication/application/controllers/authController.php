<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AuthController extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getLogin() {
        if($this->session->userdata('logged')) {
            redirect(base_url() . 'dashboardController/start');
            exit();
        }
        $this->load->view('login/index');
    }
    
    
    public function postLogin() {
        if($this->session->userdata('logged')) {
            redirect(base_url() . 'dashboardController/start');
            exit();
        }
        if(!empty($_POST)) {
            // mesto za validaciju
            
            
            $this->load->model('User');
            
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $password = sha1($password);
            
            
            if($user = $this->User->findUser($username, $password)) {
                $this->session->set_userdata(array(
                    'logged'    => TRUE,
                    'user_id'   => $user['id'],
                    'username'  => $user['username']
                ));
                redirect(base_url() . 'DashboardController/start');
                exit();
            } else {
                $this->session->set_flashdata('msg', 'Invalid login credentials.');
                redirect(base_url() . 'login');
                exit();
            }
            
            
            
            
        } else {
            redirect(base_url() . 'login');
            exit();
        }
        
    }
    
    public function getLogout() {
        $this->session->unset_userdata('logged');
        $this->session->sess_destroy();
        redirect(base_url() . 'login');
        exit();
    }
    
}