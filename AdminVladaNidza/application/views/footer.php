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