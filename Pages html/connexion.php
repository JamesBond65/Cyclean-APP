<?php session_start(); 

echo $_SESSION['creation_compte']; //Message si l'on vient de créer un compte
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

<h1>Se connecter</h1>
<form method="post">
    <input type="text" name="connexion_pseudo" id="connexion_pseudo" placeholder="Votre pseudo" required><br>
    <input type="password" name="connexion_password" id="connexion_password" placeholder="Votre mot de passe" required><br>
    <input type="submit" name="connexion_form" id="connexion_form" value="Login">
</form>



<?php 
    if(isset($_POST['connexion_form'])){
        extract ($_POST);

        if(!empty($connexion_password) && !empty($connexion_pseudo)){
            $q = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo");

            $q->execute(['pseudo' => $connexion_pseudo]);

            $resultat = $q->fetch(); //Convertit le résultat en un tableau

            if ($resultat){ //Si le compte existe

                $password_compte= $resultat['password'];

                if ($connexion_password == $password_compte){

                    $_SESSION['id'] = $resultat['id'];
                    $_SESSION['pseudo'] = $resultat['id'];
                    
                    header('Location: accueil_connected.php');
                }
                else{
                    echo "Le mot de passe est incorrect.";
                }

            }
            else{
                echo "le compte portant le pseudo " . $connexion_pseudo . " n'existe pas.";
            }

        }
        else{
            echo "Veuillez remplir toutes les cases.";
        }
    }
?>