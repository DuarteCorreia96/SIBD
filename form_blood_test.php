<?php 
  session_start(); 
  $_SESSION['Last_page'] = 'show_consults.php';
?>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <?php

      if(isset($_SESSION['ErrorDB'])){
        echo("<p>".$_SESSION['ErrorDB']."</p>");
        unset($_SESSION['ErrorDB']);
      }

      include_once "create.php";

      $_SESSION['Con_Timestamp'] = $_REQUEST['Con_Timestamp'];
      
      echo("<center><h2>Insert Blood-Test information</h2></center>");
      $form_key = [  'Num', 'Procedure_Descrip', 'VAT_Assistant', 'Type', 'Indicator_Name', 'Indicator_Value'];
      $form_types = ['number', 'text', 'number', 'text', 'text', 'number'];
      $form_action = "insert_procedure.php";
      create_form($form_key, $form_types, $form_action);
      
      #######################################   
      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
    ?>
  </body>
</html>