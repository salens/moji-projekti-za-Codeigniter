<html>
    <head>
        <title><?php echo $title; ?></title>
    </head>    
<body> 
<table>
    <?php if(isset($results)) { ?>
    <?php foreach($results as $test) : ?>
    <tr>
        <td><a href="<?php echo base_url() . 'myController/check/' . $test['id'];?>"><?php echo $test['username'];?></a>
        </td>
        <td><a href="<?php echo base_url() . 'myController/check/' . $test['id'];?>"><?php echo $test['password'];?></a></td>
        <td><a href="<?php echo base_url() . 'myController/check/' . $test['id'];?>"><?php echo $test['text'];?></a><a href="<?php echo base_url() . 'myController/delete/' . $test['id'];?>"><?php echo " delete"?></a></td>

    </tr>
    <?php endforeach; ?>
    <?php } ?>
</table>  
   <a href="<?php echo base_url() . 'myController/SignIn/'?>">Sign IN</a>
   
</body> 
</html>