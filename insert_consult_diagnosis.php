<?php 
  session_start(); 
  include_once "connect.php";
  
  $vars_names = [ 'Animal_Name', 'Owner_VAT', 'Con_Timestamp',  'Diagnosis_Code'];
  foreach ($vars_names as $key) {
    if(!empty($_REQUEST[$key])){
      $_SESSION[$key] = $_REQUEST[$key];
    }
  }

  #Obter dados do formulário para variáveis
  $Owner_VAT = $_SESSION['Owner_VAT'];      
  $Animal_name = $_SESSION['Animal_Name'];
  $date_timestamp = $_SESSION['Con_Timestamp'];

  $Code = $_SESSION['Diagnosis_Code'];

  #Inserir dados na Database
  $query = "INSERT INTO _consult_diagnosis (code, name, VAT_owner, date_timestamp) VALUES ( ? , ?, ?, ?) ;";
  $args = [(string) $Code, (string) $Animal_name , (int) $Owner_VAT, (string) $date_timestamp ];

  connect_db($query, $args);

  header("Location: form_consult_diagnosis.php");
?>

