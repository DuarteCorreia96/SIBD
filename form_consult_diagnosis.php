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
      include_once "connect.php";
      
      # Ver todos os diagnosis codes
      $query = "SELECT code FROM _diagnosis_code;";
      $stmt = connect_db($query); 
      
      $codes = array();
      while($row = $stmt->fetch())
        $codes = array_merge($codes, [$row[0]]);

      echo("<center><h2>Insert indicator information</h2></center>");

      $form_key = ['Diagnosis_Code'];
      $form_types = ['select'];
      $form_action = "insert_consult_diagnosis.php";
      $default_values = [$codes];
      create_form($form_key, $form_types, $form_action, $default_values);
      
      #######################################   
      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
    ?>
  </body>
</html>