<?php 
    session_start(); 




    $_SESSION = array();

    // Check failed: we'll start a brand new session
    session_regenerate_id(FALSE);
    session_unset();
    session_destroy();

    header('Location: page_accueil_visiteur.php');

?>