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

      $_SESSION['Con_Timestamp'] = $_REQUEST['Con_Timestamp'];
      
      $query = "SELECT VAT FROM _assistant;";
      $stmt = connect_db($query); 
      
      $VAT_assis = array();
      while($row = $stmt->fetch())
        $VAT_assis = array_merge($VAT_assis, [$row[0]]);
      
      $Animal_name = $_SESSION['Animal_Name'];
      $Owner_VAT = $_SESSION['Owner_VAT'];      
      $date_timestamp = $_SESSION['Con_Timestamp'];

      $query = "SELECT num FROM _procedure WHERE name = ? AND VAT_owner = ?  AND date_timestamp = ?  ORDER BY num DESC LIMIT 1";
      $args = [(string) $Animal_name, (int) $Owner_VAT, (string) $date_timestamp];
      $stmt  = connect_db($query, $args);
      $result = $stmt->fetch();
      $Num = $result[0] + 1;
      
      echo("<center><h2>Insert Blood-Test information</h2></center>");

      $Indicators = ['White_Blood_Cells', 'Neutrophils', 'Lymphocytes', 'Monocytes'];
      $form_key = array_merge(['Num', 'Type', 'Procedure_Descrip', 'VAT_Assistant'], $Indicators, ['Indicators_Name']);
      $form_types = ['show', 'show', 'text', 'select', 'number', 'number', 'number', 'number', 'hidden'];
      $form_action = "insert_procedure.php";
      $default_values = [$Num, 'blood', NULL, $VAT_assis, 10, 20, 30, 40, base64_encode(serialize($Indicators))];
      create_form($form_key, $form_types, $form_action, $default_values);
      
      #######################################   
      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
    ?>
  </body>
</html>