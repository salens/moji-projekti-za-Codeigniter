<html>
    <head>  
        <title>
            Dobrodosli!
        </title>
        
        <style>
            h1,p{color: blue}
        </style>
    </head>
 
    <body>
        <h1>Welcome New Users</h1>
        <?php echo validation_errors(); ?>
        <form action="<?php echo base_url('mainController/userRegister/') ;?>" method="post">
        <p>Username</p>
        <input type="text" name="username" size="30">
        <br>
        <p>Password</p>
        <input type="password" name="password" size="30">       
        <br><br>
        <input type="submit" value="Submit"> 
        </form>
    </body>
</html>
