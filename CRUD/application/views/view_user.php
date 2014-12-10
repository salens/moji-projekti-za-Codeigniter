<?php
echo 'Update';
echo "<br>";
echo form_open('MyController/update');
echo"Update your id";
echo "<br>";
$data= array(
    'name' => 'id',
    'value' => $id,
    'maxlength' => '100',
    'size' => '30',
    
    );

echo form_input($data);

echo "<br>";
echo"Update your username";
echo "<br>";
$data= array(
    'name' => 'username',
    'value' => $username,
    'maxlength' => '100',
    'size' => '30',
    
    );

echo form_input($data);

echo "<br>";
echo"Update your password";
$data= array(
    'name' => 'passwd',
    'value' => $password,
    'maxlength' => '100',
    'size' => '30',
     
    );
echo "<br>";
echo form_input($data);
echo "<br>";
echo "Update some text";
echo "<br>";

$data= array(
    'name' => 'text',
    'value' => $text,
    'maxlength' => '100',
    'size' => '30',
     
    );
echo form_textarea($data);
echo "<br>";
echo form_submit('submit','Submit');
echo form_close();

?>
