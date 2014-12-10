
<body>
<style>
   #dot{
       color: red;
   }
</style>
    <h1>Welcome Users</h1>
      <h3><?php echo $Wlc1 . '<br>' . $Wlc2; ?></h3>
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
      <label style="right: 550px; top: 90px; position: absolute; color: blue; font-size: 50px;">ovo je label Dobrodosli</label>