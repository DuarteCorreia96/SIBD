<?php 
  session_start(); 
  $_SESSION['Last_page'] = $_SESSION['Curr_page'];
  $_SESSION['Curr_page'] = 'animal_inserted.php';
?>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php

      include_once "connect.php";
      include_once "list_animals.php";

      $vars_names = ['Client_VAT', 'Owner_Name','Animal_Name', 'Animal_Race', 'Birth_Year'];
      foreach ($vars_names as $key) {
        if(!empty($_REQUEST[$key])){
          $_SESSION[$key] = $_REQUEST[$key];
        }
      }

      $VAT = $_SESSION['Client_VAT'];
      $Own_name = $_SESSION['Owner_Name'];
      $Ani_name = $_SESSION['Animal_Name'];
      $Ani_race = $_SESSION['Animal_Race'];
      $Ani_year = $_SESSION['Birth_Year'];

      $query = "INSERT INTO _animal (name, VAT, species_name, birth_year) VALUES 
                ( ? , ?, ?, ?) ;"
      
      ;

      $args = [(string) $Ani_name, (int) $VAT, (string) $Ani_race, (int) $Ani_year ];
      $stmt = connect_db($query, $args);

      $query = "SELECT a.name, a.species_name, YEAR(CURDATE()) - a.birth_year AS age
                FROM _animal a, _person p
                WHERE p.name LIKE CONCAT('%', ?, '%') 
                  AND p.VAT = ?
                  AND a.VAT = p.VAT;"    
;

  $args = [ (string) $Own_name, (int) $VAT];
  $stmt = connect_db($query, $args);

      if ($stmt->rowCount() !== 0){ 
        list_animals();
      } else {
        echo("<h3> No animal found. Insert new animal</h3>");  
      }
      
      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
    ?>
  </body>
</html>
