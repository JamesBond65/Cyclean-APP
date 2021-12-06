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



<h1>S'inscrire</h1>
    <form method="post">
        <input type="text" name="pseudo" id="pseudo" placeholder="Votre pseudo" required><br>
        <input type="text" name="nom" id="nom" placeholder="Votre nom" required><br>
        <input type="text" name="prenom" id="prenom" placeholder="Votre prenom" required><br>
        <input type="email" name="email" id="email" placeholder="Votre adresse mail" required><br>
        <input type="password" name="password" id="password" placeholder="Votre mot de passe" required><br>
        <input type="password" name="cpassword" id="cpassword" placeholder="Confirmer le mot de passe" required><br>
        <input type="submit" name="formsend" id="formsend" value="S'inscrire">
    </form>



<?php 
    if (isset($_POST['formsend'])){
        extract($_POST);

        if(!empty($password) && !empty($cpassword) && !empty($email) && !empty($prenom) && !empty($nom) && !empty($pseudo)){




            if ($password == $cpassword){
                // POUR HACHER LE MDP 
                // $options=['cost'=>12];
                // $hashpass = password_hash($password, PASSWORD_BCRYPT, $options);



                // Recherche d'email' dans la base de donnée
                $requete_email = $db->prepare("SELECT email FROM Utilisateurs WHERE email = :email");
                $requete_email->execute(['email' => $email]);

                $somme_email = $requete_email->rowCount();

                if ($somme_email == 0){

                    // Recherche de pseudo dans la base de donnée
                    $requete_pseudo= $db->prepare("SELECT pseudo FROM Utilisateurs WHERE pseudo = :pseudo");
                    $requete_pseudo->execute(['pseudo' => $pseudo]);

                    $somme_pseudo = $requete_pseudo->rowCount();

                    if ($somme_pseudo == 0){
                        $q = $db->prepare("INSERT INTO Utilisateurs(pseudo,Nom,prenom,email,password) VALUES(:pseudo,:nom,:prenom,:email,:password)");
                        
                        
                        $q->execute([
                            'pseudo' => $pseudo,
                            'nom'=> $nom,
                            'prenom'=> $prenom,
                            'email' => $email, 
                            'password' => $password
                        ]); // Attention aux différences entre différents types de guillemets

                        $_SESSION['creation_compte'] = "Votre compte a été créé" ; 

                        header('Location: connexion.php');
                    }
                    else{
                        echo "Ce pseudo est déjà utilisé.";
                    }
                }
                else{
                    echo "Cette adresse mail est déjà utilisée.";
                }
            }
            else{
                echo "Vos mots de passe ne coincident pas.";
            }
        }
        
        else {
            echo "Il y a une erreur de saisie, veuillez reessayer.";
        }
    }


?>