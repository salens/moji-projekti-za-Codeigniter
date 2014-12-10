<html>
    <head>
        <title></title>
    </head>
    <body>
        <table border="4">
           
            <?php if(isset($results)){ ?>
            <th>Username</th><th>Email</th><th>active</th>    
                <?php foreach ($results as $show) { ?>
            
            <tr>
                    <td><?php echo $show['username'];?></td>                 
                    <td><?php echo $show['email'];?></td>
                    <td><?php echo $show['active'];?></td>
                </tr>   
             <?php } ?>
             <?php } ?>
        </table>
        <!-- <p><?php echo anchor('MyValidationController/AddUsers','Back to add Users');?></p> -->
        
    </body>
</html>