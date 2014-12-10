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
      <h1>Admin Users</h1>
      <?php echo validation_errors(); ?> 
      <h1><?php if($this->session->flashdata('NotValid')) echo $this->session->flashdata('NotValid');?></h1>
      <?php if($this->session->flashdata('msgEdit')) echo $this->session->flashdata('msgEdit'); ?>
      <table border="3">
          <th>Username</th><th>Password</th><th>Email</th><th>Role</th><th>Active</th><th>Edit</th><th>Delete</th><th>upload files</th>
          <tr>
<?php 
   foreach ($results as $view){?>
        <td><?php  echo $view['username'];?></td>
        <td><?php  echo $view['password'];?></td>
        <td><?php  echo $view['email'];?></td>
        <td><?php  echo $view['role'];?></td>
        <td><?php if($view['active'] == 1) echo $view['active'];?></td>
        <td><a href="<?php  echo base_url() . 'RegisteredUsers/check/' . $view['id'];?>">edit</a></td>
        <td><a href="<?php  echo base_url() . 'RegisteredUsers/deletePost/' . $view['id'];?>">delete</a></td> 
        <td><a href="<?php echo base_url() . 'RegisteredUsers/viewFileUpload/';?>">upload files</a></td>
        </tr>
   <?php }?>
</table> 
<br>       
<a href="<?php echo base_url() . 'RegisteredUsers/blog/' . $this->session->userdata('id');?>"><button type="submit">Goto blog</button></a> 
<br><br>
<a href="<?php echo base_url() . 'RegisteredUsers/LogOut'?>"><button type="submit">Logout</button></a>
<a href="<?php echo base_url() . 'RegisteredUsers/showPosts'?>"><button type="submit">View Posts</button></a>   
</body>
</html>