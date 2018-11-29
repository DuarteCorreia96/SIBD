<?php 
  session_start(); 
  $_SESSION['Last_page'] = $_SESSION['Curr_page'];
  $_SESSION['Curr_page'] = 'start_next.php';
?>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head> 
  <body>
    <?php

      include_once "connect.php";
      include_once "create.php";
      include_once "list_animals.php";

      $vars_names = ['Client_VAT', 'Owner_Name','Animal_Name'];
      foreach ($vars_names as $key) {
        if(!empty($_REQUEST[$key])){
          $_SESSION[$key] = $_REQUEST[$key];
        }
      }

      $VAT = $_SESSION['Client_VAT'];
      $Own_name = $_SESSION['Owner_Name'];
      $Ani_name = $_SESSION['Animal_Name'];

      $query = "SELECT p.name 
                FROM  _person p, _client cl 
                WHERE cl.VAT = p.VAT 
                  AND p.name LIKE CONCAT('%', ?, '%');"
              ;
      $args = [(string) $Own_name];
      $stmt = connect_db($query, $args); 
      
      $_SESSION['Owner_Name'] = implode($stmt->fetch());
      $Own_name = $_SESSION['Owner_Name'];

      #Get the VAT from the owner
      $query = "SELECT cl.VAT 
                FROM  _person p, _client cl 
                WHERE p.name = ? 
                  AND p.VAT = cl.VAT;"
              ;
      $args = [(string) $Own_name];
      $stmt_VAT = connect_db($query, $args); 
      $result = $stmt_VAT->fetch();
      $VAT_owner = $result[0];
      $_SESSION['Owner_VAT'] = $VAT_owner;

      if($stmt->rowCount() !== 0){

        $query = "SELECT c.date_timestamp, c.VAT_client, c.VAT_vet
                  FROM _person p, _animal a, _consult c, _client cl 
                  WHERE a.name = ?
                    AND p.name LIKE CONCAT('%', ?, '%')
                    AND cl.VAT = ?
                    AND cl.VAT = p.VAT
                    AND cl.VAT = a.VAT
                    AND a.name = c.name
                    AND (p.VAT = c.VAT_owner OR p.VAT = c.VAT_client);"       
        ;
        $args  = [(string) $Ani_name, (string) $Own_name, (int) $VAT_owner];
        $stmt = connect_db($query, $args);

        echo("<h1>Records of animal '$Ani_name' of '$Own_name' with Vat = $VAT_owner </h1>");

        if ($stmt->rowCount() !== 0){ 
            
          $table_headers = ['Timestamp', 'VAT_client','VAT_vet'];
          $var_name = 'Con_Timestamp';
          $href = 'consult_descr.php';
        
          create_tableh($table_headers, $stmt, $var_name, $href);
          
        } else {

          echo("<h3> No consults for animal '$Ani_name' found</h3>");

          echo("<div class='hr'></div>");

          echo("<center><h2>Insert new animal for client '$Own_name' with VAT: $VAT_owner</h2></center>");
          $form_key = ['Animal_Name', 'Animal_Race','Birth_Year'];
          $form_types = ['text', 'text', 'year'];
          $form_action = "animal_inserted.php";
          create_form($form_key, $form_types, $form_action);

        }
      } else {

        echo("<h3> No client with this name or VAT </h3>");

      }
      
      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
      echo("<p></p><a href='animal_list.php'> Check list of client Animals </a>");
    ?>
  </body>
</html>