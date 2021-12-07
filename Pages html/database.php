<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*define("HOST","leomelki.fr");
define("DB_NAME","armandb");
define("USER","armandb");
define("PASS","#Kj1q47v");*/

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
