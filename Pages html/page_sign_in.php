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

        <header>
            <img src="images/images_footer/Blanc/LogoGris.png" width="100px">
            <div class="titre">CYCLEAN</div>
        </header>
        

        

        <section>

                
            <form class="element_1" method="post">
                    <input type="text" name="connexion_pseudo" id="connexion_pseudo" class="no-outline" placeholder="Pseudo ...">
                    <hr>
                        
                    <input type="password" name="connexion_password" id="connexion_password" class="no-outline" name="pwd" placeholder="Mot de passe" />                                          
                    <hr>

                    <input type="submit" name="connexion_form" id="connexion_form" value="Login">

                        
            </form>

            <p class="oublié">Mot de passe oublié ?</p>
                



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
                                $_SESSION['Prénom'] = $resultat['Prénom'];
                                $_SESSION['Prénom'] = $resultat['Prénom'];
                                $_SESSION['email'] = $resultat['email'];
                                $_SESSION['APropos'] = $resultat['APropos'];
                                
                                header('Location: page_accueil.php');
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

                

            
        </section>

            

            
        <!-- FOOTER -->

        <footer class="container_footer">                
            <div style="padding-left: 5%;">
                <img src="images/images_footer/Blanc/LogoGris.png" width="65px"><br>

                <p class="texte_footer" style="margin-top: 0px;">
                    Cyclean 
                </p>
                
            </div>


                    




            <p class="texte_footer">
                © GREEN SENSE 2021<br>
                ALL RIGHTS RESERVED
            </p>


                    




            <div style="margin-right: 5%;">

                <p class="texte_footer" style="margin-bottom: 0px; margin-top: 0px;">
                Contacts
                </p>
                    
                <div>
                    <div class="logo_insta_whatsapp">
                        <img src="images/images_footer/Blanc/instaF.png" width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/images_footer/Blanc/WhatsappF.png" width="20px"><br>
                        <img src="images/images_footer/Blanc/TwitterF.png" width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/images_footer/Blanc/Mail.F.png" width="20px">
                    </div>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/images_footer/Blanc/facebookF.png " width="20px">
                </div>
            </div>

    </footer>    

        


    </body>
</html>