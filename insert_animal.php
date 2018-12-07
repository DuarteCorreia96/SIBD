<?php 
  session_start();

  include_once "connect.php";
  include_once "list_animals.php";

  $vars_names = ['Client_VAT', 'Owner_Name','Animal_Name', 'Animal_Race', 'Birth_Year', 'Color','Gender'];
  foreach ($vars_names as $key) {
    if(!empty($_REQUEST[$key])){
      $_SESSION[$key] = $_REQUEST[$key];
    }
  }

  $VAT = $_SESSION['Client_VAT'];
  $Own_name = $_SESSION['Owner_Name'];
  $Ani_name = $_SESSION['Animal_Name'];
  $Ani_race = $_SESSION['Animal_Race'];
  $Ani_year = $_SESSION['Birth_Year'];
  $color = $_SESSION['Color'];
  $gender = $_SESSION['Gender'];

  $query = "INSERT INTO _animal (name, VAT, species_name, birth_year, coulour, gender) VALUES ( ? , ?, ?, ?) ;";
  $args = [(string) $Ani_name, (int) $VAT, (string) $Ani_race, (int) $Ani_year, (string) $color, (string) $gender];
  $stmt = connect_db($query, $args);

  header("Location: show_animal.php");
?>

