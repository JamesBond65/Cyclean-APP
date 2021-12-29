<?php session_start(); ?>
<!DOCTYPE html>



<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Inscription</title>
        <link rel="stylesheet" href="style_page_sign_up.css">
    </head>


    <body>
        <header>
            <div class="logo_header">
                <a href="page_accueil_visiteur.php"><img src="images/images_footer/Blanc/LogoGris.png" width="120px"></a>
            </div>
            
            <div class="titre titre_display" style="margin-bottom : -30px;">
                
                    CYCLEAN

            </div>
            

            
        </header>
        

        

        <section >
            
            <form method="post" class="element_1">
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo ..." required><br>
                <hr>
                <input type="text" name="nom" id="nom" placeholder="Nom ..." required><br>
                <hr>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom ..." required><br>
                <hr>
                <input type="email" name="email" id="email" placeholder="Adresse mail..." required><br>
                <hr>
                <input type="password" name="password" id="password" placeholder="Mot de passe..." required><br>
                <hr>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirmer mot de passe..." required><br>
                <hr>
                <input type="submit" name="formsend" id="formsend" value="S'inscrire">   


                <p class="oublié">Mot de passe oublié ?</p> 
            </form>            
        </section>

        <?php 

            include 'database.php';
            global $db;

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
                            // si l'email n'est pas déjà utilisé
                            
                            $requete_pseudo= $db->prepare("SELECT pseudo FROM Utilisateurs WHERE pseudo = :pseudo");
                            $requete_pseudo->execute(['pseudo' => $pseudo]);

                            $somme_pseudo = $requete_pseudo->rowCount();

                            if ($somme_pseudo == 0){
                                // si le pseudo n'est pas déjà utilisé
                                $q = $db->prepare("INSERT INTO utilisateurs(pseudo,Nom,prenom,email,password,ModeleProduit) VALUES(:pseudo,:nom,:prenom,:email,:password,:modele)");
                                
                                
                                $q->execute([
                                    'pseudo' => $pseudo,
                                    'nom'=> $nom,
                                    'prenom'=> $prenom,
                                    'email' => $email, 
                                    'password' => $password,
                                    'modele'=> 112,
                                ]); // Attention aux différences entre différents types de guillemets

                                // MESSAGE COMPTE CREER DANS LA PAGE SIGN IN !

                                header('Location: page_sign_in.php');
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