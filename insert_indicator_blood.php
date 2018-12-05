<?php 
  session_start(); 
  include_once "connect.php";
  
  $vars_names = [ 'Animal_Name', 'Owner_VAT', 'Con_timestamp',  'Num', 'Indicator_Name','Indicator_Value'];
  foreach ($vars_names as $key) {
    if(!empty($_REQUEST[$key])){
      $_SESSION[$key] = $_REQUEST[$key];
    }
  }

  #Obter dados do formulário para variáveis
  $Owner_VAT = $_SESSION['Owner_VAT'];      
  $Animal_name = $_SESSION['Animal_Name'];
  $date_timestamp = $_SESSION['Con_Timestamp'];

  $Num = $_SESSION['Num'];
  $indicator_name = $_SESSION['Indicator_Name'];
  $indicator_value = $_SESSION['Indicator_Value'];

  #Inserir dados na Database
  $query = "INSERT INTO _produced_indicator (name, VAT_owner, date_timestamp , num, indicator_name, value) VALUES ( ? , ?, ?, ?, ?, ?) ;";
  $args = [(string) $Animal_name, (int) $Owner_VAT,  $date_timestamp, (int) $Num, (string) $indicator_name, (int) $indicator_value];

  connect_db($query, $args);

  header("Location: form_indicator_blood.php");
?>

