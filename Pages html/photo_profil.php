<?php
function get_pdp($id,$extension){ //function parameters, two variables.

    $nom = "";
    if ($extension != NULL ){
        $nom = "uploads/profile_".$id.".".$extension;
    }
    else{
        $nom = "uploads/profile.png";
    }


    return $nom;  //returns the second argument passed into the function
}?>
