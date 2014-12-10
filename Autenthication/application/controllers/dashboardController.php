<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashboardController extends CI_Controller {
    
        public function __construct() {
            parent::__construct();


            if(!$this->session->userdata('logged')) {
                redirect(base_url() . 'login');
                exit();
            }
        }
    
        public function start() {
            $this->load->view('user/dashboard');
        }
        
}