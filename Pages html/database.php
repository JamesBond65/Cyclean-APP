<?php
/*define("HOST","leomelki.fr");
define("DB_NAME","armandb");
define("USER","armandb");
define("PASS","#Kj1q47v");    

try{
 $db = new PDO("mysql:host=" . HOST . ";port=3306;dbname=" . DB_NAME, USER, PASS);
 $db->setAttribute(PDO::ERRMODE_EXCEPTION, 'ATTR_ERRMODE');
}

catch(PDOException $e){
 echo $e;
}
*/
 
define("HOST", "localhost");
define("DB_NAME", "siteweb");
define("USER", "root");
define("PASS", "root");

global $db;
try {
    $db = new PDO("mysql:host=" . HOST . ";port=3306;dbname=" . DB_NAME, USER, PASS);
    $db->setAttribute(PDO::ERRMODE_EXCEPTION, 'ATTR_ERRMODE');
} catch (PDOException $e) {
    throw $e;
}

?>