<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link type="text/css" href="<?= base_url() .APPPATH ?>css/main.css" rel="stylesheet" />   
  </head>
  <body>
      <h1>Edit Posts</h1>
      <h2>Edit Posts:</h2>
      <form action="<?php echo base_url() . 'RegisteredUsers/editBlog/' . $result['B_id'];?>" method="POST">          
          <br> <textarea rows="4" cols="50" name="posts"><?php echo $result['posts']; ?></textarea>
          <input type="text" name="tags" value="<?php echo $tags;?>">
          <br/><br/>
          <button type="submit">Change</button>          
      </form> 
  </body>
</html>
