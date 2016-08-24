<?php

// Report all PHP errors (see changelog)
  error_reporting(E_ALL);

  require_once __DIR__ . "/db_connect.php";
  
  $db = new DB_CONNECT();
  
  echo $db;
  $response["name"] = "janos";
  $response["age"] = "10";
  
  echo json_encode($response)
?>