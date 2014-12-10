<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link type="text/css" href="<?= base_url() .APPPATH ?>css/main.css" rel="stylesheet" />   
<style>
    #dot{
        color: red;
    }
</style>
  </head>
  <body>
      <h1>Welcome Users</h1>
      <div id="register">
      <h2>New User Please register:</h2>
      <label><b>Register:</b></label>
      <form action="<?php echo base_url() . 'Main/register';?>" method="POST">
          Username<b id="dot">*</b> <input type="text" name="username">
          <br/>
          Password<b id="dot">*</b> <input type="password" name="password">
          <br/>
          Email<b id="dot">*</b> <input type="text" name="email">
          <br/>
          <button type="submit">Register</button>
          <?php echo validation_errors(); ?>
          <?php if($this->session->flashdata('msgRegister')) echo $this->session->flashdata('msgRegister');?>
      </form>
      </div>
      
     <div id="login">
      <h2>For registered Users:</h2>
      <label><b>LogIn:</b></label> 
     <form action="<?php echo base_url() . 'Main/login';?>" method="POST">
         Email<b id="dot">*</b> <input type="text" name="email" required>
          <br/>
          Password<b id="dot">*</b> <input type="password" name="password" required>
          <br/>         
          <button type="submit">Login</button>
      </form> 
     </div>
     <?php if($this->session->flashdata('msgLogOut')) echo $this->session->flashdata('msgLogOut');?>
  </body>
</html>
