<html>
    <head>
        <title><?php echo $title; ?></title>
    </head>    
<body> 
<?php
echo 'HELLO YOU';
echo "<br>";
echo form_open('MyController/insertValues');
echo"Insert your username";
echo "<br>";
$data= array(
    'name' => 'username',
    'value' => '',
    'maxlength' => '100',
    'size' => '30',
    
    );

echo form_input($data);

echo "<br>";
echo"Insert your password";
$data= array(
    'name' => 'passwd',
    'value' => '',
    'maxlength' => '100',
    'size' => '30',
     
    );
echo "<br>";
echo form_input($data);
echo "<br>";
echo "Insert some text";
echo "<br>";

$data= array(
    'name' => 'text',
    'value' => '',
    'maxlength' => '100',
    'size' => '30',
     
    );
echo form_textarea($data);
echo "<br>";
echo form_submit('submit','Submit');
echo form_close();

?>
    

<p><?php echo anchor('MyValidationController/AddUsers','Users Validation');?></p>

</body> 
</html>