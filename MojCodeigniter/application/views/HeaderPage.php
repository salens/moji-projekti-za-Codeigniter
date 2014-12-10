<htm>
    <head>
        <title> <?php echo $header ?></title>
        
  <style>
  body {background-color:lightgray}
  h1   {color:blue}
  p    {color:red ;font-weight: bolder}
  input[type=submit] {background-color: red}
  input[type=submit] {color: white}
  input[type=text] {background-color: linen}
  input{color: indigo ; font-weight: bolder}
  textarea {color:white}

</style>
    </head>
    
    <body>
        <p><?php echo validation_errors(); ?></p>
        
        <?php
            echo '<h1>'.$naslov.'</h1>';
            
        
            
            echo form_open('mojKontroler/regUser');
            
            echo "Unesite vase korisnicko ime:". '<br>';
            
            $data= array(
            'name' => 'username',
            'value' => '',
            'maxlength' => '100',
                'size' => '25',

            );
            echo form_input($data);
            
            echo '<br>'. "Unesite vasu lozinku:". '<br>';
            
             
            $data= array(
            'name' => 'password',
            'value' => '',
            'maxlength' => '100',
            'size' => '25',

            );
            echo form_input($data);
            
            echo '<br>'."Unesite vas email:". '<br>';
            
            $data= array(
            'name' => 'email',
            'value' => '',
            'maxlength' => '100',
            'size' => '25',

            );
            echo form_input($data);
            
            echo '<br><br>'. form_submit('submit', 'Nastavi');
            echo form_close();
            
        ?>         
        
    </body>
</htm>





