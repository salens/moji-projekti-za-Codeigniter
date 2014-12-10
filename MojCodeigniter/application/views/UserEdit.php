<htm>
    <head>
        <title> <?php echo $header ?></title>
        
  <style>
  body {background-color:lightgray}
  h1   {color:blue}
  p    {color:red ;font-weight: bolder}
  input[type=submit] {background-color: red}
  input[type=submit] {color: white}
  input[type=text] {background-color: linen}
  input{color: indigo ; font-weight: bolder}
  textarea {color:white}

</style>
    </head>
    
    <body>
    
        <p><?php echo validation_errors(); ?></p>
        
        <?php
            echo '<h1>'.$naslov.'</h1>';
            
        
            
            echo form_open('mojKontroler/update');
            ?>
        
        <input type="hidden" name="id" value="<?php echo $user['id'];?>">
         <input type="text" name="username" value="<?php echo $user['username'];?>">   
         <input type="password" name="password" value="<?php echo $user['password'];?>">
         <input type="text" name="email" value="<?php echo $user['email'];?>">
            
         <button type="submit">Update</button>
            <?php
           
            echo form_close();
            
        ?>         
        
    </body>
</htm>






