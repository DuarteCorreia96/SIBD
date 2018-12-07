<?php 
  session_start(); 
  include_once "connect.php";
  
  $vars_names = [ 'Animal_Name', 'Owner_VAT', 'Con_Timestamp',  'Num', 'Procedure_Descrip', 'VAT_Assistant', 'Type', 'Indicators_Name'];
  foreach ($vars_names as $key) {
    if(!empty($_REQUEST[$key])){
      $_SESSION[$key] = $_REQUEST[$key];
    }
  }

  #Obter dados do formulário para variáveis
  $Animal_name = $_SESSION['Animal_Name'];
  $Owner_VAT = $_SESSION['Owner_VAT'];      
  $date_timestamp = $_SESSION['Con_Timestamp'];
  $Num = $_SESSION['Num'];
  $Procedure_Descrip = $_SESSION['Procedure_Descrip'];
  $VAT_Assistant = $_SESSION['VAT_Assistant'];
  $Type = $_SESSION['Type'];

  #Inserir dados na Database - Consulta, e diagnosis code
  $query1 = "INSERT INTO _procedure (name, VAT_owner, date_timestamp , num, description) VALUES ( ? , ?, ?, ?, ?) ;";
  $args1 = [(string) $Animal_name, (int) $Owner_VAT,  $date_timestamp, (int) $Num,  (string) $Procedure_Descrip];
  
  $query2 = "INSERT INTO _performed (name, VAT_owner, date_timestamp , num, VAT_assistant) VALUES ( ? , ?, ?, ?, ?) ;" ;
  $args2 = [(string) $Animal_name, (int) $Owner_VAT,  $date_timestamp, (int) $Num,  (string) $VAT_Assistant];

  $query3 = "INSERT INTO _test_procedure (name, VAT_owner, date_timestamp , num, type) VALUES ( ? , ?, ?, ?, ?) ;";
  $args3 = [(string) $Animal_name, (int) $Owner_VAT,  $date_timestamp, (int) $Num,  (string) $Type];
  
  $arguments = array($args1, $args2, $args3);
  $querys = array($query1, $query2, $query3);

  $Indicators_Name = unserialize(base64_decode($_SESSION['Indicators_Name']));   
  $query = "INSERT INTO _produced_indicator (name, VAT_owner, date_timestamp , num, indicator_name, value) VALUES ( ? , ?, ?, ?, ?, ?) ;";
  foreach ($Indicators_Name as $indicator){
    
    $indicator_name = str_replace('_',' ',$indicator); 
    $args = [(string) $Animal_name, (int) $Owner_VAT,  $date_timestamp, (int) $Num, (string) $indicator_name, (int) $_REQUEST[$indicator]];

    $querys = array_merge($querys, [$query]);
    $arguments = array_merge($arguments, [$args]);
  }

  do_transaction($querys, $arguments);

  header("Location: show_consults.php");
?>

