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

      $vars_names = ['Owner_VAT', 'Owner_Name','Animal_Name', 'Con_Timestamp'];
      foreach ($vars_names as $key) {
        if(!empty($_REQUEST[$key])){
          $_SESSION[$key] = $_REQUEST[$key];
        }
      }
      
      $VAT = $_SESSION['Owner_VAT'];
      $Own_name = $_SESSION['Owner_Name'];
      $Ani_name = $_SESSION['Animal_Name'];
      $Con_Time = $_SESSION['Con_Timestamp'];

      echo("<h1>Record for consult on '$Con_Time' of animal '$Ani_name' of '$Own_name' with Vat = $VAT </h1>\n");

      $query = "SELECT c.VAT_Client, c.VAT_VET, a.gender, c.weight, YEAR(c.date_timestamp) - a.birth_year, c.s, c.o, c.a, c.p
        FROM _consult c, _animal a 
        WHERE c.name = ? 
          AND c.VAT_owner = ? 
          AND c.date_timestamp = ?
          AND a.name = c.name
          AND a.VAT = c.VAT_owner;";
      $args  = [ (string) $Ani_name, (int) $VAT, $Con_Time];
      $stmt  = connect_db($query, $args);
      
      // não é preciso verificar se existem consultas visto ter-se chegado
      // a este script a partir de um link de uma consulta existente
      $result = $stmt->fetch();
      echo("<p>VAT of Client: $result[0] </p>");
      echo("<p>VAT of veterinary: $result[1] </p>");
      echo("<p>Gender of the animal: $result[2] </p>");
      echo("<p>Age of the animal: $result[4] years (at the time of the consult)</p>");

      echo("<div class='hr'></div>");
      echo("<h2> Information obtained in consult:</h2>");
      echo("<p>Weight of the animal: $result[3] kilos </p>");
      echo("<p>Subjective Notes: $result[5] </p>");
      echo("<p>Objective Notes: $result[6] </p>");
      echo("<p>Assessment Notes: $result[7] </p>");
      echo("<p>Plan Notes: $result[8] </p>");
      
      echo("<div class='hr'></div>");
      echo("<h2>Diagnosis codes from this consult</h2>");
      $query = "SELECT cd.code, dc.name
        FROM _consult_diagnosis cd JOIN _diagnosis_code dc ON cd.code = dc.code
        WHERE cd.name = ? 
          AND cd.VAT_owner = ? 
          AND cd.date_timestamp = ?;";
      $args  = [$Ani_name, $VAT, $Con_Time];
      $stmt  = connect_db($query, $args);

      if ($stmt->rowCount() !== 0){ 

        $table_headers = ['Code','Description'];  
        create_tableh($table_headers, $stmt);

      } else { echo("<p> No diagnosis from this consult </p>");}
      
      echo("<h2>Presciptions from this consult</h2>");
      $query = "SELECT p.name_med, p.lab, p.dosage, p.regime
        FROM _prescription p
        WHERE p.name = ? 
          AND p.VAT_owner = ? 
          AND p.date_timestamp = ?;";
      $args  = [$Ani_name, $VAT, $Con_Time];
      $stmt  = connect_db($query, $args);

      if ($stmt->rowCount() !== 0){ 

        $table_headers = ['Medicine','Laboratory', 'Dosage', 'Regime'];  
        create_tableh($table_headers, $stmt);

      } else { echo("<p> No presciptions from this consult </p>");}

      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
    ?>
  </body>
</html>