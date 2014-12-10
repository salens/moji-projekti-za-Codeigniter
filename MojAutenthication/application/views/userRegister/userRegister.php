<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>User Register</title>    
    <style>
        body, button{color: blue;}
    </style>
  </head>
  <body>
      <h1>Welcome new Users</h1>
      <?php echo validation_errors(); ?>
      <?php if($this->session->flashdata('msg')) echo $this->session->flashdata('msg') . '<br>'; ?>
      <form action="<?php echo base_url() . 'UserRegistrationController/userReg'?>"  method="POST">          
          Username: <input type="text" name="username">
          <br/>          
          Password: <input type="password" name="password">
          <br/>
          Email: <input type="text" name="email">
          <br/><br/>
          <button type="submit">Login</button>          
      </form>     
      
 <?php 

  $dir = 'd:/filmovi';       

  function chk($dir){
      
    $ffs = scandir($dir);    
    
          print_r($dir);
          echo '<pre>';
          print_r($ffs);
          echo '</pre>';
           
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
        if(is_dir($dir.'/'.$ff)) chk($dir.'/'.$ff);         
        }           
    } 

}

chk($dir);
 
;?>
      
</body>
</html>