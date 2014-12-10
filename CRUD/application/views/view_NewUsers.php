<?php

echo validation_errors();
 
echo form_open('myValidationController/insertValidation');
echo"Welcome to form validation";

echo "<br>";
echo" your username";
echo "<br>";
$data= array(
    'name' => 'username',
    'value' => '',
    'maxlength' => '100',
    'size' => '30',
    
    );

echo form_input($data);

echo "<br>";
echo" your password";
$data= array(
    'name' => 'password',
    'value' => '',
    'maxlength' => '100',
    'size' => '30',
     
    );
echo "<br>";
echo form_input($data);
echo "<br>";
echo "your email";
echo "<br>";

$data= array(
    'name' => 'email',
    'value' => '',
    'maxlength' => '100',
    'size' => '30',
     
    );
echo form_input($data);
echo "<br>";
echo form_submit('submit','Submit');
echo form_close();


?>
