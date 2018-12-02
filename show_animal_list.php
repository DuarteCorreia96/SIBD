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

      include_once "list_animals.php";
      list_animals();

      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
    ?>
  </body>
</html>