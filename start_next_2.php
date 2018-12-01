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
      foreach ($vars_names as $key){
        if(!empty($_REQUEST[$key])){
          $_SESSION[$key] = $_REQUEST[$key];
        }
      }

      $VAT = $_SESSION['Client_VAT'];
      $Own_name = $_SESSION['Owner_Name'];
      $Ani_name = $_SESSION['Animal_Name'];

      // Check if client is a client
      $query = "SELECT * FROM _client cl WHERE cl.VAT = ?";
      $args = [$VAT];
      $stmt1 = connect_db($query, $args); 

      // Check if owner is a person and a client
      $query = "SELECT * FROM _client cl, _person p WHERE p.name LIKE CONCAT('%', ?, '%') AND cl.VAT = p.VAT";
      $args = [$Own_name];
      $stmt2 = connect_db($query, $args); 

      if($stmt1->rowCount() > 0 && $stmt2->rowCount() > 0){

        // Check intersection of the form
        $query = "SELECT owner.name, a.name
          FROM _person owner, _consult c, _animal a
          WHERE owner.name LIKE CONCAT('%', ?, '%')
            AND a.name = ?
            AND owner.VAT = a.VAT
            AND ( a.VAT = ? OR (
                    a.name = c.name
                AND a.VAT = c.VAT_owner
                AND c.VAT_client = ?
              )
            )
          GROUP BY a.name;"
        ;
        $args = [(string) $Own_name, (string) $Ani_name, (int) $VAT, (int) $VAT];
        $stmt = connect_db($query, $args); 

        echo("<h1> Records of animal '$Ani_name' of '$Own_name' accompanied with Vat = $VAT </h1>");

        if ($stmt->rowCount() > 0){ 
            
          $table_headers = ['Owner Name', 'Animal Name'];
          $var_name = 'Owner_Name';
          $href = 'show_consults.php';
          $column_ref = 0; 
          $column_click = 1;    
          create_tableh($table_headers, $stmt, $var_name, $href, $column_ref, $column_click);
          
        } else {

          echo("<h3> No animal found for these conditions</h3>");
          echo("<h2> This may be due to: </h2>");
          echo("<ul> 
           <li> No animal with that name with owner name like that.</li>
           <li> No animal with that name with owner name like that being accompanied by client the VAT given. </li>
           <li> No animal with that name with owner name like that and with the VAT given. </li>
          </ul>");

          echo("<div class='hr'></div>");

          // Check if the name corresponds to the VAT to be a owner
          $query = "SELECT p.name 
            FROM  _person p, _client cl 
            WHERE cl.VAT = p.VAT 
              AND p.name LIKE CONCAT('%', ?, '%')
              AND cl.VAT = ?;
          ";
          $args = [(string) $Own_name, (int) $VAT];
          $stmt = connect_db($query, $args); 
          
          if($stmt->rowCount() > 0){

            $_SESSION['Owner_VAT']  = $VAT;
            $_SESSION['Owner_Name'] = implode($stmt->fetch());
            $Own_name = $_SESSION['Owner_Name'];

            echo("<center><h2>Insert new animal for client '$Own_name' with VAT: $VAT</h2></center>");
            $form_key = ['Animal_Name', 'Animal_Race','Birth_Year'];
            $form_types = ['text', 'text', 'year'];
            $form_action = "animal_inserted.php";
            create_form($form_key, $form_types, $form_action);

          } else {

            echo("<h2>VAT doens't correspond to the name of the person. Please Insert correct values </h2>");
          }
        }
      } else {
        echo("<h3> No client with this name or VAT </h3>");
      }
      
      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
    ?>
  </body>
</html>
