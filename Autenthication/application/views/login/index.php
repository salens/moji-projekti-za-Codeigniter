<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
  </head>
  <body>
      <?php if($this->session->flashdata('msg')) echo $this->session->flashdata('msg') . '<br>'; ?>
      <form action="<?php echo base_url() . 'authController/postLogin';?>" method="POST">
          Username: <input type="text" name="username">
          <br/>
          Password: <input type="password" name="password">
          <br/>
          <button type="submit">Login</button>
      </form>
  </body>
</html>