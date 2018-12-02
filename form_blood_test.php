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

      $Indicators = ['White_Blood_Cells', 'Neutrophils', 'Lymphocytes', 'Monocytes'];
      $form_key = array_merge(['Num', 'Procedure_Descrip', 'VAT_Assistant', 'Type'], $Indicators, ['Indicators_Name']);
      $form_types = ['number', 'text', 'number', 'text', 'number', 'number', 'number', 'number', 'hidden'];
      $form_action = "insert_procedure.php";
      $default_values = [NULL, NULL, NULL, 'Blood', 100, 20, 100, 50, base64_encode(serialize($Indicators))];
      create_form($form_key, $form_types, $form_action, $default_values);
      
      #######################################   
      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
    ?>
  </body>
</html>