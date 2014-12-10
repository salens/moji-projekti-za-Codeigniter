<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>title</title>
    <link type="text/css" href="<?= base_url() .APPPATH ?>css/main.css" rel="stylesheet" />   
  </head>
  <body>
      <h2>Insert Tag:</h2>
      <form action="<?php echo base_url() . 'RegisteredUsers/insertTag/' . $B_id?>" method="POST">          
          <br> Tag:<input type="text" name="tags">
          <br/><br/>
          <button type="submit">Insert Tag</button>          
      </form>
          
  </body>
</html>
