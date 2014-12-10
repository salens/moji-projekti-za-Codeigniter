<html>
    <head>
        <title>
            My form
        </title>
    </head>
    
    <body>            
           
        <?php echo form_open('Main/editUsr/' . $result['id']);?>          
        
        <h5>Username</h5>
        <input type="text" name="username" value="<?php echo $result['username']; ?>" size="50" /><br>
        <?php if($this->session->flashdata('errUsername')) echo $this->session->flashdata('errUsername');?>
        
         <h5>Password</h5>
         <input type="text" name="password" value="<?php echo $result['password']; ?>" size="50" /><br>     
         <?php if($this->session->flashdata('errPassword')) echo $this->session->flashdata('errPassword');?>
        
         
         <h5>Email Adress</h5>
         <input type="text" name="email" value="<?php echo $result['email']; ?>" size="50" /><br>
         <?php if($this->session->flashdata('errEmail')) echo $this->session->flashdata('errEmail');?>
         
         <h4>Programski jezici:</h4>
         
         <input type="checkbox" name="cSharp" value="1" <?php echo ($result['C#']) ? 'checked' : ''?>>C#<br>
       
         <input type="checkbox" name="php" value="1" <?php echo ($result['PHP']) ? 'checked' : ''?>>PHP<br>
         
         <input type="checkbox" name="js" value="1" <?php echo ($result['JS']) ? 'checked' : ''?>>JS<br>
         
         <input type="checkbox" name="cplusplus" value="1" <?php echo ($result['C++']) ? 'checked' : ''?>>C++<br>
         <br><br>
       
         <div><input type="submit" value="Submit!" /></div>
    </form>
    </body> 
</html>