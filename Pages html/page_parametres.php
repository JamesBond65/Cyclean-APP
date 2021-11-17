<?php session_start(); ?>
<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Paramètres</title>
        <link rel="stylesheet" href="style_page_parametres.css?v=<?php echo time(); ?>">

        <!-- Importation du fichier header-->
        <script src="jquery.js"></script>
        <script> 
        $(function(){
            $("#header").load("contenu/header.html"); 
        });
        </script>
    </head>

    <body>
        <?php include 'database.php';
        global $db;
        ?>


        <header class="fixed">
            
            <header id="header" class="gris"></header>

            <h1 class="slogan" style="margin-top: -75px;">Paramètres </h1>
            
        </header>


        <section class="grid center" style="padding-top: 180px;padding-bottom: 700px;">

            <!-- Ligne 1 -->


            <div>
                <h1 class="titre">Profile<hr></h1>
                

                <form method="post" class="post">

                    Nouveau nom:<br>
                    <input type="text" name="nom" id="nom" placeholder="<?= $_SESSION['Nom'];?>" size="30">
                    <br>

                    Nouveau prénom:<br>
                    <input type="text" name="prenom" id="prenom" placeholder="<?= $_SESSION['prenom'];?>" size="30">
                    <br>
                    
                    A propos de moi:<br>
                    <textarea id="story" name="story" style="resize:none"
                    rows="5" cols="33"> <?=$_SESSION['APropos']?> </textarea><br> 

                    Nouvelle adresse mail:<br>
                    <input type="text" name="email" id="email" placeholder="<?= $_SESSION['email'];?>" size="30">
                    <br>
                    Nouveau mot de passe:<br>
                    <input type="password" name="password" id="password" placeholder="Nouveau mot de passe..." size="30">                                          
                    <br>
                    Confirmer le nouveau mot de passe:<br>
                    <input type="password" name="cpassword" id="cpassword" placeholder="Confirmer le mot de passe..." size="30">           
                    <br>


                    <input type="submit" name="profile_form" id="profile_form" value="confirmer" size="30">
                </form>
              

                <?php
                    if(isset($_POST['profile_form'])){
                        extract ($_POST);

                        if (!empty($nom) || !empty($prenom) || !empty($story) || !empty($email) || (!empty($password) && !empty($cpassword)) ) {
                            // !empty($email) verif
                            $q = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email");

                            $q->execute(['email' => $email]);

                            $resultat = $q->fetch(); //Convertit le résultat en un tableau

                            if ($resultat){  //Si le compte existe
                                echo "l'adresse mail est déjà utilisée pour un autre compte";
                            }
                            else{






















                                if ( ( (!empty($password) and !empty($cpassword) ) && $cpassword == $password ) or (empty($password) and empty($cpassword)) ) {
                                    
                                    $q = $db->prepare("UPDATE utilisateurs SET  
                                    Nom = CASE
                                            WHEN length(:nom)>0 THEN :nom 
                                            ELSE Nom END,
                                    prenom = CASE
                                            WHEN :prenom IS NOT NULL AND length(:prenom)>0 THEN :prenom 
                                            ELSE prenom END,

                                    APropos = CASE
                                            WHEN :apropos IS NOT NULL AND length(:apropos)>0 THEN :apropos
                                            ELSE APropos END,

                                    email = CASE
                                            WHEN :email IS NOT NULL AND length(:email)>0 THEN :email
                                            ELSE email END,

                                    password = CASE
                                            WHEN :password IS NOT NULL AND length(:password)>0 THEN :password
                                            ELSE password END
                                                                            
                                       WHERE id=:id");




                                    $donnees=[

                                        'nom' => $nom,
                                        'prenom' => $prenom,
                                        'apropos' => $story,

                                        'email' => $email,

                                        'password' => $password,



                                        'id' => $_SESSION['id']

                                    ];

                                    $q->execute($donnees);

                                }
                                else {
                                    echo 'les mdp remplis ne correspondent pas';
                                }
































                            }
                        }
                        else{
                            echo "Veuillez remplir les champs obligatoires";
                        }
                    }
                    ?>

            </div>
            
            <div>
                <h1 class="titre">Interface<hr></h1>
                

                <form method="post" id="post_tick">
                            
                    <input type="checkbox"> Pollution sonore<hr>

                    <input type="checkbox"> Fréquence cardiaque<hr>

                    <input type="checkbox"> Qualité de l'air <hr>

                    <input type="checkbox"> Autre<hr>

                    <input type="submit" name="interface_form" id="interface_form" value="confirmer">
                </form>
            
            </div>

            <div>
                <h1 class="titre">Mon compte<hr></h1>
                
                <form method="post" class="post">
                            
                    <input type="checkbox"> Pollution sonore
                    <hr>

                    <input type="checkbox"> Fréquence cardiaque   
                    <hr>

                    <input type="checkbox"> Qualité de l'air           
                    <hr>

                    <input type="checkbox"> Autre
                    <hr>
                    <input type="submit" name="compte_form" id="compte_form" value="confirmer">
                </form>
            
            </div>
        </section>










        <!-- FOOTER -->

        <footer class="container_footer fixed" style="bottom: 0;">                
            <div style="padding-left: 5%;">
                <img src="images/LogoBlanc.png " width="65px"><br>

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
                        <img src="images/images_footer/Blanc_Blanc/instaF.png" width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/images_footer/Blanc_Blanc/WhatsappF.png" width="20px"><br>
                        <img src="images/images_footer/Blanc_Blanc/TwitterF.png" width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <img src="images/images_footer/Blanc_Blanc/Mail.F.png" width="20px">
                    </div>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/images_footer/Blanc_Blanc/facebookF.png " width="20px">
                </div>
            </div>

    </footer>



    </body>