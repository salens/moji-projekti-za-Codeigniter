<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $Title;?></title>
        <link type="text/css" href="<?= base_url() .APPPATH ?>css/main.css" rel="stylesheet" />   
        <style>
            #table{
                position: absolute;
                right: 700px;
                top: 150px;
            }
            h3{
                color: blueviolet;
            }
        </style>
    </head>
    <body>
            <?php echo $naslov; ?>
            <table id="table" border="2">
                <th><h3>Username</h3></th><th><h3>Tagovi</h3><th><h3>Postovi</h3></th><th><h3>Vreme</h3></th>
          <tr>
<?php 
   foreach ($result as $view){?>
        <td><?php  echo $view['username'];?></td>         
        <td><?php  echo $view['title'];?></td> 
        <td><?php  echo $view['posts'];?></td> 
        <td><?php  echo $view['date'];?></td>  
        </tr>
   <?php }?>
</table> 
    </body>
</html>