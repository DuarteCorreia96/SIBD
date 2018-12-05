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
      
      $query = "SELECT p.indicator_name FROM _produced_indicator AS p NATURAL JOIN _test_procedure AS t WHERE t.type LIKE '%blood%' GROUP BY p.indicator_name;";
      $stmt = connect_db($query); 
      
      $Indicators = array();
      while($row = $stmt->fetch())
      $Indicators = array_merge($Indicators, [$row[0]]);

      echo("<center><h2>Insert indicator information</h2></center>");

      $form_key = ['Indicator_Name','Indicator_Value'];
      $form_types = ['select','number'];
      $form_action = "insert_indicator_blood.php";
      $default_values = [$Indicators, NULL];
      create_form($form_key, $form_types, $form_action, $default_values);
      
      #######################################   
      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
    ?>
  </body>
</html>