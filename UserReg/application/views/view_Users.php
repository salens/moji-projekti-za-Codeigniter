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
        <h1>This is all Users</h1>
        <?php if($this->session->flashdata('msg')) echo $this->session->flashdata('msg'); ?>
        <div id="delUser"><?php if($this->session->flashdata('delUserMsg')) echo $this->session->flashdata('delUserMsg');?><br></div>
            <?php if($res){ ?>
        
        <table border="2">
            
            <tr><th>Username</th><th>Password</th><th>Delete</th><th>Edit</th></tr>          
            
          
            <?php foreach($res as $view){ ?>        
            <tr>               
                <td><?php echo $view['username']?></td>
                <td><?php echo $view['password']?></td>
             
               <td><a id="delbutt" href="<?php echo base_url() . 'MainController/deleteUser/' . $view['id'];?>"><?php echo " delete"?></a></td>     
               <td><a href="<?php echo base_url() . 'main/checkUser/' . $view['id'];?>"><?php echo " edit"?></a></td>
                <?php }?>
               
            </tr>
        </table>
            <?php }?>
    </body>
</html>
