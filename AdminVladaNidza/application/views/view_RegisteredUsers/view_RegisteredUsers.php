
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
      <h1>Simple Users</h1>  
      <table border="3">
          <th>Username</th><th>Password</th><th>Email</th><th>Role</th><th>Active</th>
          <tr>
<?php        
   foreach ($results as $view){if($view['role'] == 'user'){ ?>
       
        <td><?php  echo $view['username'];?></td>
        <td><?php  echo $view['password'];?></td>
        <td><?php  echo $view['email'];?></td>
        <td><?php  echo $view['role'];?></td>
        <td><?php  echo $view['active'];?></td>    
        </tr>
   <?php }}?>
</table>
<br>          
<a href="<?php echo base_url() . 'RegisteredUsers/LogOut'?>"><button type="submit">Logout</button></a>    
</body>
</html>