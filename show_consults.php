<?php 
  session_start(); 
  $_SESSION['Last_page'] = $_SESSION['Curr_page'];
  $_SESSION['Curr_page'] = 'show_consults.php';
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
      
      $vars_names = ['Owner_VAT', 'Owner_Name', 'Animal_Name'];
      foreach ($vars_names as $key) {
        if(!empty($_REQUEST[$key])){
          $_SESSION[$key] = $_REQUEST[$key];
        }
      }

      $VAT = $_SESSION['Owner_VAT'];
      $Own_name = $_SESSION['Owner_Name'];
      $Ani_name = $_SESSION['Animal_Name'];

      echo("<h1>Records of animal '$Ani_name' of '$Own_name' with Vat = $VAT </h1>\n");

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

      $args = [(string) $Ani_name, (string) $Own_name, (int) $VAT];
      $stmt  = connect_db($query, $args);
      if ($stmt->rowCount() !== 0){ 
          
        $table_headers = ['Timestamp', 'VAT_client','VAT_vet'];
        $var_name = 'Con_Timestamp';
        $href = 'consult_descr.php';
      
        create_tableh($table_headers, $stmt, $var_name, $href);
        list_animals();
        
      } else {

        echo("<h3> No consults for animal '$Ani_name' found</h3>");
        list_animals();
      }

      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
      echo("<p></p><a href='animal_list.php'> Show list of animals </a>");

    ?>
  </body>
</html>