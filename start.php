<?php 
  session_start(); 
  session_unset();
?>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>  
  <body>
    <center> <h1>Check Consults</h1> </center>
    <?php
      
      include_once "create.php";
      
      $form_key = ['Client_VAT', 'Owner_Name','Animal_Name'];
      $form_types = ['number', 'text', 'text'];
      $form_action = "show_animal.php";
      $default_values = [4, "Silva", "Totti"];
      create_form($form_key, $form_types, $form_action, $default_values);

    ?>
  </body>
</html>