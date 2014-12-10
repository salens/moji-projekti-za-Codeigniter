<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link type="text/css" href="<?= base_url() .APPPATH ?>css/main.css" rel="stylesheet" />   
  </head>
<body><?php echo $this->session->userdata('username'); ?>
    <h1>Welcome to page for Upload Files</h1>
      <div id="register">
        <h2>Choose Images:</h2>
         <form action="<?php echo base_url() . 'RegisteredUsers/fileUpload';?>" method="POST" enctype="multipart/form-data">
          
          Choose File: <input type="file" multiple="multiple" name="uploadfile[]"><br><br>
          <p>captcha Code: <?php echo $captcha;
          $data_form=  array(
              'name'    => 'captch'
          );
          echo form_input($data_form);
          ?></p>
          
            <button type="submit">Upload</button>   
        </form><br>
      <?php if($this->session->flashdata('PicExistsAllReady')) echo $this->session->flashdata('PicExistsAllReady', 'Sorry, file already exists.');?>
    </div>     
</body>
</html>
