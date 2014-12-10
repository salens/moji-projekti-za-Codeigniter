<html>
    <head>
        <title>
            <?php echo $header; ?>
        </title>
        
        <style>
            th {text-decoration: underline ; color: blue}
            td{border: 1px solid black;}
            table{color: green}
            table{ border: 3px solid blueviolet;}
            a:link{color: firebrick}
            h3{color: purple}
           
            
        </style>
    </head>
    <body>
        <h3 color="red"><?php echo $naslov; ?></h3>
        <table>
            <th>Username</th><th>Password</th><th>Email</th><th>delete</th>
                <?php if($this->session->flashdata('msg')) echo $this->session->flashdata('msg'); ?>
                <?php if(!empty($rezultati)) {?>
                <?php foreach ($rezultati as $prikazi) { ?>            
                <tr>
                    <td><?php echo $prikazi['username'];?></td>        
                    <td><?php echo $prikazi['password'];?></td>
                    <td><?php echo $prikazi['email'];?></td>
                    <td><a href="<?php echo base_url() . 'mojKontroler/deleteKorisnik/'. $prikazi['id'];?>"><?php echo "delete" ?></a></td>
                    <td><a href="<?php echo base_url() . 'mojKontroler/editovanjeKorisnika/' . $prikazi['id'];?>"><?php echo "Edit User" ?></a></td>
                </tr>   
             <?php } ?>   
                <?php }?>
                    
                    
          <p><?php echo anchor('mojKontroler/FirstPage','Dodaj Novog Korisnika');?></p> 
    </body>
</html>