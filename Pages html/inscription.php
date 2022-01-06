<?php session_start(); 

$_SESSION['creation_compte'] = "" ; 
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />    
    </head>

<body>
    
<?php
include 'database.php';
global $db;
?>



<form  method="form">
        <input
          type="text"
          name="search1"
          id="search1"
          placeholder="Recherche.."

        >
        <input type="submit" class="button" name="search_form" id="search_form" value="recherche">


</form><?php 
        if(isset($_POST['search_form'])){
            echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
                    extract ($_POST);
                    $q = $db->prepare("SELECT pseudo FROM utilisateurs WHERE pseudo = :pseudo");

                    $q->execute(['pseudo' => $search1]);

                    $resultat = $q->fetch();

                }
        ?>       
</body>
</html>