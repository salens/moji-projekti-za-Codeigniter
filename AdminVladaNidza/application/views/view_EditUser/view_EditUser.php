<?php
echo 'Update fields:';
echo "<br><br>";
echo form_open('RegisteredUsers/edit/' . $id);

echo"Update your username:";
echo "<br>";
$data= array(
    'name' => 'username',
    'value' => $username,
    'maxlength' => '100',
    'size' => '30',
    
    );

echo form_input($data);

echo "<br>";
echo"Update your password:";
$data= array(
    'name' => 'password',
    'value' => $password,
    'maxlength' => '100',
    'size' => '30',
     
    );
echo "<br>";
echo form_input($data);
echo "<br>";
echo "Update your email:";
echo "<br>";

$data= array(
    'name' => 'email',
    'value' => $email,
    'maxlength' => '100',
    'size' => '30',
     
    );
echo form_input($data);
echo "<br><br>";
echo form_submit('submit','Submit');
echo form_close();

?>
