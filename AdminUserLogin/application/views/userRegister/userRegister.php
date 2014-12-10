<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
  </head>
  <body>
      
       <?php echo validation_errors(); ?>
       <?php if($this->session->flashdata('msg')) echo $this->session->flashdata('msg') . '<br>'; ?>
      <form action="<?php echo base_url() . 'Main/saveNewUser';?>" method="POST">
          Username: <input type="text" name="username">
          <br/>
          Password: <input type="password" name="password">
          <br/>          
          Email: <input type="text" name="email">
          <br/>
          <button type="submit">Login</button>
      </form>     
      
<br><label>Search:</label>
<a href="<?php echo base_url() . 'AuthController/search';?>" >Search for Users</a>
  </body>
</html>
