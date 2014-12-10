<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RegisteredUsers extends CI_Controller {
    
    function __construct() {
        parent::__construct();
     
    }
    
    function index(){
        
    }
    
    function regUsersTable(){
           $this->load->model('User');        
           if( $this->session->userdata('Logged')){
               $data['results'] = $this->User->getUsers();
               $this->load->view('view_RegisteredUsers/view_RegisteredUsers', $data);
           }
           else{
               redirect(base_url() . 'Main/index');
           }
    }

    function regUsersAdminTable(){
        
          $this->load->model('User');
          $this->load->model('Tag');

          if( $this->session->userdata('Logged')){
              $data['results'] = $this->User->getUsers();           
              $this->load->view('view_RegisteredAdminUsers/view_RegisteredAdminUsers', $data);
          }
          else{
              redirect(base_url() . 'Main/index');
          }
    }

    function deleteUser($id){  

        $this->load->model('User');
        if($this->User->delete($id)){
             redirect(base_url() . 'RegisteredUsers/regUsersAdminTable');
        }
        else echo 'error';         
    }          

    function check($id){
        $this->load->model('User');
        $this->User->checkUser($id);        
        if($results = $this->User->checkUser($id)) {            
        $this->load->view('view_EditUser/view_EditUser',$results);           
        }
        else  redirect(base_url() . 'RegisteredUsers/regUsersAdminTable/');         
    } 

    function edit($id){
        $this->load->model('User');          
        $data = array(
        'username'       =>      $this->input->post('username'),
        'password'       =>      $this->input->post('password'),
        'email'          =>      $this->input->post('email')
            );  
        if($this->User->edit($id, $data)){

            $this->session->set_flashdata('msgEdit', 'Uspesno ste izmenili podatke!');
            redirect(base_url() . 'RegisteredUsers/regUsersAdminTable');
        }
        else{
             echo 'error';
        }
    }

    function blog(){
        $this->load->model('Blog');
        $this->load->model('User');
        $this->load->model('Tag');
        $this->User->checkUser($this->session->userdata('id'));        
        if($data = $this->User->checkUser($this->session->userdata('id'))) {                                     
            $data['results'] = $this->Blog->getPosts(); 
            $this->load->view('view_Blog/view_Blog', $data);           
        }
        else{   
        $this->load->view('view_Blog/view_Blog');  
        }   
    }

    function blogPosts($id){
        $this->load->model('Blog');

        $data = array(
              'U_id'      =>   $id,                    
              'posts'     =>   $this->input->post('posts'),
              'date'      =>   date('Y-m-d H:i:s')
          );
        if($this->Blog->insertPosts($data)){
              $this->session->set_flashdata('msgPosts', 'Uspesno ste dodali novi post!');                
              redirect(base_url() . 'RegisteredUsers/blog/' . $id);                  
        }
        else{
              echo 'error';
        }
    }           

     function checkBlogs($B_id){            
        $this->load->model('Blog');             
        if($result = $this->Blog->checkBlog($B_id)) { 
                $data['result']    = $result;
                $tags = $this->Blog->getBlogTags($B_id);
            if($tags) {
                $tagArray = [];
             foreach($tags as $tag) {
                $tagArray[] = $tag['title'];
             }                  
                $tagArray = implode(', ', $tagArray);
            }                 
            if(isset($tagArray)) $data['tags'] = $tagArray;
            else $data['tags'] = '';        
                $this->load->view('view_EditBlog/view_EditBlog', $data);                 
        }
        else{                   
              echo 'error';
        }           

     }

     function editBlog($B_id){
         $this->load->model('Blog');             
         $this->load->model('Tag');
         $data = array(                 
             'posts'    => $this->input->post('posts')
         );
        if($this->Blog->editPosts($B_id, $data)){                 

            if($tags = $this->input->post('tags')) {
                $tags = explode(',', $tags);

                if(count($tags) > 0) {
                    $targetTags = array();
                    
                    foreach($tags as $tag) {
                        $tag = trim($tag);
                        if($check = $this->Tag->checkTag($tag)) {               
                            $targetTags[] = $check->id;
                        }
                        else {

                            if($inserted = $this->Tag->addTag(['title' => $tag])) {
                                $targetTags[] = $inserted;
                            }
                        }
                    }
                    $this->Blog->deleteTagsForPost($B_id);
                    
                    foreach($targetTags as $tagID){                                
                         $this->Blog->connectBlogAndTags($B_id, $tagID);   
                    }              
                }
            }
            else {
                $this->Blog->deleteTagsForPost($B_id);
            }                
                $this->session->set_flashdata('editPost', 'Uspesno ste editovali post!');
                redirect(base_url() . 'RegisteredUsers/blog');                 
        }
        else{                 
             echo 'error';
        }
    }

    function deleteBlog($id = null, $U_id = null){  
        if($this->session->userdata('Logged')){
            $this->load->model('Blog');
            if($this->Blog->delete($id)){
                $this->session->set_flashdata('deletePost', 'Uspesno ste obrisali post!');
                redirect(base_url() . 'RegisteredUsers/blog');
            }
            else echo 'error';
        }
        else {
                redirect(base_url() . 'Main/index');
        }
    }   
    
    function viewFileUpload(){
        if($this->session->userdata('Logged')){
            $this->load->helper('captcha');
            $vals = array(
                'img_path'      =>'./captcha/',
                'img_url'       =>  base_url() . 'captcha/',
                'img_width'     =>150,
                'img_height'    =>30
            );

            $cap = create_captcha($vals);
            $this->session->set_userdata('captcha', $cap['word']);
            $data['captcha']=$cap['image'];
            $this->load->view("view_FileUpload/view_FileUpload" , $data); 
        }else{
            $this->session->set_flashdata('NotValid', 'Nemate prava ka ovom linku!');
            redirect(base_url() . 'RegisteredUsers/regUsersAdminTable');
        }
    }
    
       // more then one file upload, array!!
    function fileUpload(){
        if(strtolower($this->session->userdata('captcha')) != (strtolower($_POST['captch']))){
            echo "You typed in  ". $_POST['captch'] . '<br>'; 
            echo "and the code was   " . $this->session->userdata('captcha');
        }
        else {            
        
            $location = './images/';
            $thumbs = './images/thumbs';
             if(!is_dir($location)){
                mkdir($location, 0777, TRUE);
            }   
            if(!is_dir($thumbs)){
                mkdir($thumbs, 0777, TRUE);
            }        

            $config['upload_path'] =  $location;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '10024';
            $config['max_width']  = '4024';
            $config['max_height']  = '2768';  
            $this->load->library('upload', $config); 

            $files = $_FILES;       
            $thumbsArray = array();

            for($i = 0; $i < count($files['uploadfile']['name']); $i++) {

                $target_file = $location . $_FILES['uploadfile']['name'] = $files['uploadfile']['name'][$i];
                $_FILES['uploadfile']['type'] = $files['uploadfile']['type'][$i];
                $_FILES['uploadfile']['tmp_name'] = $files['uploadfile']['tmp_name'][$i];
                $_FILES['uploadfile']['error'] = $files['uploadfile']['error'][$i];
                $_FILES['uploadfile']['size'] = $files['uploadfile']['size'][$i];           
                // check if file exists in directory! ovde pocinje
                if (file_exists($target_file)) {
                    $this->session->set_flashdata('PicExistsAllReady', "Sorry, file already exists '". $target_file . "'");
                    redirect(base_url() . 'RegisteredUsers/viewFileUpload');               
                }
                // ovde se zavrsava file exists!
                $thumbsArray[] = $files['uploadfile']['name'][$i];  
                $this->upload->initialize($config);
                $this->upload->do_upload('uploadfile');  

                $image_data = $this->upload->data(); 

                }

                $this->load->library('image_lib');  
                foreach ($thumbsArray as $picts){  

                    $config2 =array(
                    'source_image'      => $image_data['full_path'],
                    'new_image'         => './images/thumbs/' .$picts,
                    'maintain_ratio'    => TRUE,
                    'width'             =>'150',
                    'height'            =>'100'
                    );      

                    $this->image_lib->initialize($config2);            
                    $this->image_lib->resize();

                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    } 
                    
                    $this->load->model('File');
                    foreach ($thumbsArray as $picts){
                   
                    $data = array(
                        'user'      =>  $this->session->userdata('username'),
                        'file_name' =>  './images/' .$picts,
                        'date'      =>  date('Y-m-d H:i:s')
                    );
                    $this->image_lib->initialize($data);
                    $this->File->save($data);
                     //var_dump($data); // ovde nastaviti jos model treba da se uradi! 
                    } //exit();
                }           
                redirect(base_url() . 'registeredUsers/viewImages'); 
        }
    }
    
    function viewImages(){           
        if($this->session->userdata('Logged')){
            $map['img'] = directory_map('./images/'); 
            foreach ($map AS $Key => $Value) {
                unset($map [$Key]['thumbs']);
             }
                $this->load->view('view_Images/view_Images', $map);  
        }  else {
                redirect(base_url() . 'Main/index');
        }
    }
    
    function pagination(){
    if($this->session->userdata('Logged')){
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'RegisteredUsers/pagination';
        $config['per_page'] = 3;
        $config['num_links'] = 2;
        $config['total_rows'] = $this->db->get('tag')->num_rows();
        
        $this->pagination->initialize($config);
        $data['query'] = $this->db->get('tag', $config['per_page'], $this->uri->segment(3));
        $this->load->view('view_Pagin/view_Pagin', $data);
    }
    else {
                redirect(base_url() . 'Main/index');
    }
}
    
    function logOut(){        
        $this->session->sess_destroy();
        $this->session->unset_userdata('Logged');     
        $this->session->set_flashdata('msgLogOut', '<p id="messageColor">Uspesno ste se izlogovali!</p>');
        redirect(base_url() . 'Main/index');        
    }
    
    function showPosts(){ 
        // ternarno uporedjivanje!
        echo (($this->session->userdata('username') == 'Sasa82Ns') ?  '<h3>Korisnik je ulogovan kao: ' . $this->session->userdata('username') . '</h3>'  :  'FALSE');         
        $data['Title']  = 'Welcome to Posts';
        $data['naslov'] = '<h1>Posts</h1>';
        $this->load->model('Blog'); 
        $data['result'] = $this->Blog->getAllPosts();   
        $this->load->view('view_Posts/view_Posts', $data);
        
    }
}
