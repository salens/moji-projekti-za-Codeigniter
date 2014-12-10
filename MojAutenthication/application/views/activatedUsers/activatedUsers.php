<html>
    <head>
        <title></title>
    </head>
    <body>
        <table border="4">
            <?php if(isset($results)){ ?>  
            <?php if($this->session->flashdata('wlc')) echo $this->session->flashdata('wlc') . '<br>'; ?>
            <th>Username</th><th>Email</th>    
                <?php foreach ($results as $show) { ?>
            
                <tr>
                    <td><?php echo $show['username'];?></td>                  
                    <td><?php echo $show['email'];?></td>
                </tr>   
             <?php } ?>
             <?php } ?>
        </table>
    </body>
</html>