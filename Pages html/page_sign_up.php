    <?php session_start(); ?>
<!DOCTYPE html>



<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Inscription</title>
        <link rel="stylesheet" href="style_page_sign_up.css?v=<?php echo time(); ?>">
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
        

        
        <section>
            
            <form method="post" class="element_1">
                <div style="display:flex;justify-content: space-between;">
                    <div>
                        <input type="radio" name="compte" id="admin" value="Administrateur"><label for="admin" style="background-color:#B2BDCC;">Administrateur</label>
                    </div>

                    <div>
                        <input type="radio" name="compte" id="utilisateur"  value="Utilisateur" required="required"><label for="utilisateur">Utilisateur</label>
                    </div>

                </div>
                <hr>
                <input type="text" name="pseudo" id="pseudo" style="width:100%;" placeholder="Pseudo ..." required><br> 
                <hr>
                <input type="text" name="nom" id="nom" style="width:100%;" placeholder="Nom ..." required><br>
                <hr>
                <input type="text" name="prenom" id="prenom" style="width:100%;" placeholder="Prénom ..." required><br>
                <hr>
                <input type="email" name="email" id="email" style="width:100%;" placeholder="Adresse mail..." required><br>
                <hr>
                <input type="password" name="password" style="width:100%;" id="password" placeholder="Mot de passe..." required><br>
                <hr>
                <input type="password" name="cpassword" style="width:100%;" id="cpassword" placeholder="Confirmer mot de passe..." required><br>
                <hr>
                <button name="formsend" id="formsend" style="width:100%;" style="">S'INSCRIRE</button>

            </form>

            
            <?php 
            include 'database.php';
            global $db;

            if (isset($_POST['formsend'])){
                extract($_POST);

                if(!empty($password) && !empty($cpassword) && !empty($email) && !empty($prenom) && !empty($nom) && !empty($pseudo)){


                

                    if ($password == $cpassword){

                        

                        $longueurpass = strlen($password);
                        $longueurpseudo = strlen($pseudo);
                        $longueurprenom = strlen($prenom);
                        $longueurnom = strlen($nom);
                        
                        if ($longueurpseudo > 20 || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $pseudo)){?>

                        <p class=texte> <?php
                            echo "Pseudo incorrect ou trop long (20 caractères max - aucun caractère spécial)";?>
                            </p>
                            <?php
                        }
                        elseif ($longueurpass < 8){?>

                            <p class=texte> <?php
                                echo "Mot de passe trop court ! (8 caractères min)";?>
                                </p>
                                <?php
                            }

                        elseif ($longueurprenom > 20 || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $prenom)){?>

                        <p class=texte> <?php
                            echo "Prénom incorrect ou trop long ! (20 caractères max - aucun caractère spécial)";?>
                            </p>
                            <?php
                        }

                        elseif ($longueurnom > 20 || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $nom)){?>

                        <p class=texte> <?php
                            echo "Nom incorrect ou trop long ! (20 caractères max - aucun caractère spécial)";?>
                            </p>
                            <?php
                        }
                        // Si toutes les conditions ci-dessus sont vérifiées
                        else{
                            // Filtre en plus au cas où
                            $prenom = preg_replace('/[0-9\@\.\;\" "]+/', '', $prenom);
                            $nom = preg_replace('/[0-9\@\.\;\" "]+/', '', $nom);
                            $pseudo = preg_replace('/[0-9\@\.\;\" "]+/', '', $pseudo);

                            // POUR HACHER LE MDP 
                            $options=['cost'=>12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $options);



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
                                    $q = $db->prepare("INSERT INTO utilisateurs(pseudo,Nom,prenom,email,password,ModeleProduit,TypeUtilisateur) VALUES(:pseudo,:nom,:prenom,:email,:password,:modele,:compte)");
                                    
                                    
                                    $q->execute([
                                        'pseudo' => $pseudo,
                                        'nom'=> $nom,
                                        'prenom'=> $prenom,
                                        'email' => $email, 
                                        'password' => $password,
                                        'modele'=> 112,
                                        'compte' => $compte,
                                    ]); // Attention aux différences entre différents types de guillemets

                                    $q = $db->prepare("SELECT id FROM utilisateurs WHERE pseudo = :pseudo");
                                    $q->execute([
                                        'pseudo' => $pseudo
                                    ]);

                                    $resultat=$q->fetch()[0];

                                    

                                    // MESSAGE COMPTE CREER DANS LA PAGE SIGN IN !

                                    header('Location: page_sign_in.php');
                                }
                                else{
                                    echo '<p class=texte>'."Ce pseudo est déjà utilisé.".'</p>';
                                }
                            }
                            else{
                                echo '<p class=texte>'."Cette adresse mail est déjà utilisée.".'</p>';
                            }
                        }
                    }
                    else{
                        echo '<p class=texte>'."Vos mots de passe ne coincident pas.".'</p>';
                    } 
                
                }
                
                else {
                    echo '<p class=texte>'."Il y a une erreur de saisie, veuillez reessayer.".'</p>';
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

                <p class="texte_footer" style="margin-bottom: 10px;">
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