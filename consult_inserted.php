<?php 
  session_start(); 
  $_SESSION['Last_page'] = $_SESSION['Curr_page'];
  $_SESSION['Curr_page'] = 'consult_inserted.php';
?>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <?php


      include_once "connect.php";
      include_once "create.php";
      
      $vars_names = [ 'Animal_Name', 'Owner_VAT', 'date_timestamp',  's', 'o', 'a', 'p', 'Driver_VAT', 'Vet_VAT', 'Weight', 'Code'];
      foreach ($vars_names as $key) {
        if(!empty($_REQUEST[$key])){
          $_SESSION[$key] = $_REQUEST[$key];
        }
      }

      #Obter dados do formulário para variáveis
      $Driver_VAT = $_SESSION['Driver_VAT'];
      $Owner_VAT = $_SESSION['Owner_VAT'];
      $Animal_name = $_SESSION['Animal_Name'];
      $date_timestamp = $_SESSION['date_timestamp'];
      $s = $_SESSION['s'];
      $o = $_SESSION['o'];
      $a = $_SESSION['a'];
      $p = $_SESSION['p'];   
      $Owner_name = $_SESSION['Owner_Name'];   
      $Vet_VAT = $_SESSION['Vet_VAT'];
      $Weight = $_SESSION['Weight'];
      $Code = $_SESSION['Code'];

      #Inserir dados na Database - Consulta, e diagnosis code
      $query = "INSERT INTO _consult (name, VAT_owner, date_timestamp , s, o, a, p, VAT_client, VAT_vet, weight) VALUES
                ( ? , ?, ?, ?, ?, ?, ?, ?, ?, ?) ;"  
      ;

      $args = [(string) $Animal_name, (int) $Owner_VAT,  $date_timestamp, (string) $s,  (string) $o, (string) $a, (string) $p,
                (int) $Driver_VAT, (int) $Vet_VAT, (int) $Weight];
      $stmt = connect_db($query, $args);

/*     $query = "INSERT INTO _diagnosis_code (code, descrip) VALUES
                 ( ? , ?, ) ;"  
      ;

      $args = [(string) $code, (string) $descrip ];
      $stmt = connect_db($query, $args);*/
   
      $query = "INSERT INTO _consult_diagnosis (code, name, VAT_owner, date_timestamp) VALUES ( ? , ?, ?, ?) ;";
      $args = [(string) $Code, (string) $Animal_name , (int) $Owner_VAT, $date_timestamp ];
      $stmt = connect_db($query, $args);

      #######################################

      #Desenhar tabela de consultas do Animal
      $query = "SELECT c.date_timestamp, c.VAT_client, c.VAT_vet
      FROM _person p, _animal a, _consult c, _client cl 
      WHERE a.name = ?
        AND p.name = ?
        AND cl.VAT = ?
        AND cl.VAT = p.VAT
        AND cl.VAT = a.VAT
        AND a.name = c.name
        AND c.VAT_owner = cl.VAT;"
        ;

        $args  = [(string) $Animal_name, (string) $Owner_name, (int) $Owner_VAT];
        $stmt = connect_db($query, $args);

        echo("<h1>Records of animal '$Animal_name' of '$Owner_name' with Vat = $Owner_VAT </h1>");

        if ($stmt->rowCount() !== 0){ 

        $table_headers = ['Timestamp', 'VAT_client','VAT_vet'];
        $var_name = 'Con_Timestamp';
        $href = 'consult_descr.php';

        create_tableh($table_headers, $stmt, $var_name, $href);
        }
      ##########################################

      
      $last = $_SESSION['Last_page'];
      echo("<p></p><a href=$last> Go to Last page </a>");
      echo("<p></p><a href='start.php'> Go to Start </a>");
    ?>
  </body>
</html>
