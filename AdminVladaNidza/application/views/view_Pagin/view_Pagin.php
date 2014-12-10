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
    <h1>Pagination</h1><br><br><br><br>      
    <div>
        <table border="3"><th>Title</th>
    <tr>
        <?php $i = 0;?>
        <?php foreach ($query->result() as $row){ $i++;?>          
              <td style="list-style: none ;"><?php echo $row->title;?></td>    
    </tr>      
    <?php  }?>  
    </table> 
        <?php echo $this->pagination->create_links();?>
    </div>            
  </body>
</html>

