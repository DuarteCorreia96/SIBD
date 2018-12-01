<?php 
  session_start(); 
  $_SESSION['Last_page'] = $_SESSION['Curr_page'];
  $_SESSION['Curr_page'] = 'show_consults.php';
?>
<html>
  <head>
    <meta charset="UTF-8">
  </head> 
  <body>
    <?php
  
      include_once "connect.php";
      include_once "create.php";
      include_once "list_animals.php";
      
      $vars_names = ['Owner_Name', 'Animal_Name'];
      foreach ($vars_names as $key) {
        if(!empty($_REQUEST[$key])){
          $_SESSION[$key] = $_REQUEST[$key];
        }
      }
      
      $Own_name = $_SESSION['Owner_Name'];
      $Ani_name = $_SESSION['Animal_Name'];
      
      #Get the VAT from the owner
      $query = "SELECT p.VAT FROM  _person p, _client cl WHERE p.name = ? AND p.VAT = cl.VAT;";
      $args = [(string) $Own_name];
      $stmt_VAT = connect_db($query, $args); 
      $result = $stmt_VAT->fetch();
      $_SESSION['Owner_VAT'] = $result[0];
      
      $VAT = $_SESSION['Owner_VAT'];

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
          
        $table_headers = ['Timestamp', 'VAT_client','VAT_vet', 'Blood Test'];
        $var_name = 'Con_Timestamp';
        $href = 'consult_descr.php';
        $column = [0, 0]; // 1st: column where to click, 2nd: column to referentiate 
        $button = ['consult_descr.php', 'Con_Timestamp', 0, 3]; // [reference, var_name, column with the value]
        create_tableh($table_headers, $stmt, $var_name, $href, $column, $button);
        
      } else {

        echo("<h3> No consults for animal '$Ani_name' found</h3>");
      }
    
      #Adicionar nova consulta
      echo("<div class='hr'></div>");

      echo("<center><h2>Insert new consult for animal '$Ani_name'  with VAT_Owner: $VAT</h2></center>");
      
      $form_key = ['date_timestamp', 's', 'o', 'a', 'p', 'Driver_VAT', 'Vet_VAT', 'Weight', 'Code'];
      $form_types = ['datetime-local', 'text', 'text', 'text', 'text', 'number', 'number', 'number', 'text'];
      $form_action = "consult_inserted.php";
      create_form($form_key, $form_types, $form_action);
      #############################
    

      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
      echo("<p></p><a href='animal_list.php'> Show list of animals </a>");

    ?>
  </body>
</html>
