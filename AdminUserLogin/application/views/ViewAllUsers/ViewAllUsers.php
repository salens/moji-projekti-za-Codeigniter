
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Users</title>
    <style>
        h1{color: blue}
    </style>
  </head>
  <body>
      <h1>Users</h1>
      <?php echo $this->session->flashdata('msg'). '<br>';?>   
      <form action="<?php echo base_url() . 'AuthController/getUserInfo';?>" method="POST">
      <table border="3">
          <th>Username</th><th>Password</th><th>Email</th><th>Role</th><th>Change</th>
          <tr>
<?php
        
   foreach ($results as $view){ ?>
       
        <td><?php  echo $view['username'];?></td>
        <td><?php  echo $view['password'];?></td>
        <td><?php  echo $view['email'];?></td>
        <td><?php  echo $view['role'];?></td>
        <?php if($view['role'] == 'user'){ ?>
        <td><input type="checkbox" name="admin[]" value="<?php echo $view['id']; ?>"></td>       
       <?php }?>
        </tr>
   <?php }?>
</table>
<br>          
<button type="submit">Submit</button> 
</form><br>
<a href="<?php echo base_url() . 'AuthController/LogOut'?>"><button type="submit">Logout</button></a>    
</body>
</html>