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
        <form action="<?php echo base_url('main/userValidation/') ;?>" method="post">
        <p>Username</p>
        <input type="text" name="username" size="30">
        <br>
        <p>Password</p>
        <input type="password" name="password" size="30">
        <p>Email</p>
        <input type="text" name="email" size="30">
        <br><br>
        <input type="checkbox" name="cSharp" value="1">C#<br>
         <br><br>
        <input type="checkbox" name="php" value="1">PHP<br>
         <br><br>
        <input type="checkbox" name="js" value="1">JS<br>
         <br><br>
        <input type="checkbox" name="cplusplus" value="1">C++<br>
        <br><br>
        <input type="submit" value="Submit"> 
        </form>
    </body>
</html>
