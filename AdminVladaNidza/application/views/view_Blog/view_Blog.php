<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Blog</title>
    <style>
        h1,h2,h4,h5{color: blue}
    </style>  
  </head>
  <body>
     <h1>Blog</h1>      

    <?php echo form_open('RegisteredUsers/blogPosts/' . $id);?>
    <h2>Posts:</h2>    
    <textarea name="posts" rows="5" cols="50" style="resize: none;"></textarea><br>
    <input type="submit" value="Submit" />
    <?php echo form_close();?> 
    
    <h1>View Posts:</h1>
    <h2><?php if($this->session->flashdata('addTag')) echo $this->session->flashdata('addTag'); ?></h2>
    <h2><?php if($this->session->flashdata('deletePost')) echo $this->session->flashdata('deletePost');?></h2>
    <h2><?php if($this->session->flashdata('editPost')) echo $this->session->flashdata('editPost');?></h2>
    <h2><?php if($this->session->flashdata('msgPosts')) echo $this->session->flashdata('msgPosts'); ?></h2>
    <div> 
        <table border="2"> 
            <th>Username</th><th>Email</th><th>role</th><th><h4>Posts</h4></th><th>Date</th><th>Edit</th><th>Delete</th>
            <tr>
                <?php foreach ($results as $view){?>
                <td><?php echo $view['username'];?></td>
                <td><?php echo $view['email'];?></td>
                <td><?php echo $view['role'];?></td>
                <td><h5><?php echo $view['posts'];?></h5></td>          
                <td><?php echo $view['date']?></td> 
                <?php if($id == $view['id']) {?>
                <td><a href="<?php echo base_url() . 'RegisteredUsers/checkBlogs/' . $view['B_id'];?>" name="editPost">edit</a></td>
                <td><a href="<?php  echo base_url() . 'RegisteredUsers/deleteBlog/' . $view['B_id'] . '/'. $view['U_id'];?>">delete</a></td>   
                   
                <?php }?>
            </tr>
                <?php }?>
        </table>
    </div>
</body>
</html>
