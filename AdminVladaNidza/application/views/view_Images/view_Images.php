<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Gallery</title>
    <link type="text/css" href="<?= base_url() .APPPATH ?>css/main.css" rel="stylesheet" />   
    <style>
        table{
            border-color: blueviolet;
            border-style: groove;
        }
    </style>
  </head>
  <body>
    <h1>Upload Images Files</h1><br><br><br><br>      
    <div>
    <table><tr>
        <?php $i = 0;?>
        <?php foreach ($img as $value){ $i++;?>          
              <td style="list-style: none ;"><img src="<?php echo base_url() . 'images/' . $value;?>" width="300" height="300"></td>    
            <?php if($i % 4 == 0){ 
                echo '</tr><tr>';   
            }?>      
        <?php  }?>
    </tr>
    </table> 
    </div><br> 
    <a href="<?php echo base_url() . 'RegisteredUsers/pagination'?>"><button type="submit">pagination</button></a>    
  </body>
</html>

