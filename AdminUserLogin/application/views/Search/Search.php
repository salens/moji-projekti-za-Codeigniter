<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Search</title>
  </head>
  <body>     
<?php echo validation_errors();?>      
<br><label>Search:</label>
<form action="<?php echo base_url() . 'AuthController/search'?>"  method="POST">          
          <input type="text" name="search"><br><br>  
          <button type="submit">Search</button>  
          <br/>                 
</form><br>
<?php if($this->session->flashdata('err')) echo $this->session->flashdata('err');?>
<table border="2">
<tr><th>Username</th><th>Email</th><th>Role</th></tr>
<?php foreach($result as $item){?>
<tr>
<td><?php echo $item->username; ?></td>
<td><?php echo $item->email; ?></td>
<td><?php echo $item->role; ?></td>
</tr>
<?php }?>
</table>
  </body>
</html>
