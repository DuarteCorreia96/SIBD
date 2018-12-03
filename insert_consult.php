<?php 
  session_start(); 
  include_once "connect.php";
  include_once "create.php";
  
  $vars_names = [ 'Animal_Name', 'Owner_VAT', 'date_timestamp',  's', 'o', 'a', 'p', 'Client_VAT', 'Vet_VAT', 'Weight', 'Code'];
  foreach ($vars_names as $key) {
    if(!empty($_REQUEST[$key])){
      $_SESSION[$key] = $_REQUEST[$key];
    }
  }

  #Obter dados do formulário para variáveis
  $Client_VAT = $_SESSION['Client_VAT'];
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

  header("Location: show_consults.php");
?>

