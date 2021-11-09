
<?php

 define("HOST","localhost");
 define("DB_NAME","siteweb");
 define("USER","root");
 define("PASS","" );    

 try{
  $db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USER, PASS);
  $db->setAttribute(PDO::ERRMODE_EXCEPTION, 'ATTR_ERRMODE');
//   echo "Connect > OK !";
 }

 catch(PDOEXeption $e){
  echo $e;
 }
?>
