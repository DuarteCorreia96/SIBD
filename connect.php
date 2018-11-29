<?php
  function connect_db($query, $arguments = NULL){
      
    $host = "db.ist.utl.pt";
    $user = "ist181225";	
    $password = "qcli5859";	
    $dbname = $user;	
   
    try {
      $connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $connection->prepare($query);
      $stmt-> execute($arguments);
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    $result = $stmt->setFetchMode(PDO::FETCH_NUM);
    $connection = null;

    return $stmt;
  }

  function do_transaction($querys, $arguments = NULL){
      
    $host = "db.ist.utl.pt";
    $user = "ist181225";	
    $password = "qcli5859";	
    $dbname = $user;	
 
    try {
      $connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $connection->beginTransaction();

      for($i = 0, $count = count($querys); $i < $count; $i++){ {
        $stmt = $connection->prepare($querys[$i]);
        $result = $stmt->execute($arguments[$i]);
        if($result == FALSE){
          $connection->rollBack();
          return FALSE;
        }
      }
      $connection->commit();
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

    $connection = null;
    return TRUE;
  }
?>