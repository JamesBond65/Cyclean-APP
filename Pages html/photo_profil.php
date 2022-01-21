<?php
function get_pdp($id){ //function parameters, two variables.

    include 'database.php';
    global $db;

    $q = $db->prepare("SELECT Extension FROM utilisateurs WHERE id = :id");
    $q->execute(['id' => $id]);

    $extension=$q->fetch()[0];


    $nom = "";
    if ($extension != NULL ){
        $nom = "uploads/profile_".$id.".".$extension;
    }
    else{
        $nom = "uploads/profile.png";
    }


    return $nom;  //returns the second argument passed into the function
}?>
