
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
      <?php echo $this->session->flashdata('msg');?>
      <table border="3">
          <th>Username</th><th>Password</th><th>Email</th><th>Role</th>
          <tr>
<?php

   foreach ($results as $view){ ?>
       
        <?php if($view['role'] == 'user'){?> 
        <td><?php  echo $view['username'];?></td>
        <td><?php  echo $view['password'];?></td>
        <td><?php  echo $view['email'];?></td> 
         <td><?php  echo $view['role'];?></td> 
        </tr>
   <?php }}?>
</table>
<br>          

</body>
</html>