<?php session_start(); ?>
<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Connexion</title>
        <link rel="stylesheet" href="style_page_sign_in.css?v=<?php echo time(); ?>">
    </head>


    <body>
        <?php include 'database.php';
            global $db;
            ?>

        <section class="page_entiere image">
            
            <a href="page_accueil_visiteur.php" class="logo">
                <img src="images/images_footer/Blanc/LogoGris.png" width="120px">  
            </a>
            

            <div class="box" style="padding-right: 700px;">
            

            <form method="post">
                    

                    <input type="text" name="connexion_pseudo" id="connexion_pseudo" class="no-outline" placeholder="Pseudo ...">
                    <hr><br>
                        
                    <input type="password" name="connexion_password" id="connexion_password" class="no-outline" name="pwd" placeholder="Mot de passe ..." />                                          
                    <hr>


                    <input type="submit" class="button" name="connexion_form" id="connexion_form" value="Se Connecter">

                        
            </form>






            <?php 
                if(isset($_POST['connexion_form'])){
                    extract ($_POST);


                    if(!empty($connexion_password) && !empty($connexion_pseudo)){


                        $q = $db->prepare("SELECT * FROM utilisateurs WHERE pseudo = :pseudo");

                        $q->execute(['pseudo' => $connexion_pseudo]);

                        $resultat = $q->fetch(); //Convertit le résultat en un tableau

                        if ($resultat){ //Si le compte existe

                            $password_compte= $resultat['password'];

                            if ($connexion_password == $password_compte){

                                $_SESSION['id'] = $resultat['id'];
                                $_SESSION['pseudo'] = $resultat['pseudo'];
                                $_SESSION['Nom'] = $resultat['Nom'];
                                $_SESSION['prenom'] = $resultat['prenom'];
                                $_SESSION['email'] = $resultat['email'];
                                $_SESSION['APropos'] = $resultat['APropos'];
                                $_SESSION['extension'] = $resultat['Extension'];
                                $_SESSION['utilisateur'] = $resultat['TypeUtilisateur'];
                                
                                header('Location: page_accueil.php');
                            }
                            else{
                                echo "Le nom d'utilisateur ou le mot de passe est incorrect.";
                            }

                        }
                        else{
                            echo "Le nom d'utilisateur ou le mot de passe est incorrect.";
                        }

                    }
                    else{
                        echo '<div class="remplir">'.'Veuillez remplir tous les champs'.'</div>';
                    }
                }
            ?>       
            

            <p class="oublié">Mot de passe oublié ?</p>

            </div>




                



     

                

            
        </section>

    </body>
</html>