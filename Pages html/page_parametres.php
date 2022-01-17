<?php session_start(); 

if (empty($_SESSION['id'])){
    header('Location: page_accueil_visiteur.php');
}
?>
<!DOCTYPE html>

<html lang="fr" id="d">
    <head><meta name="viewport" 
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, width=device-width">

        <title>Cyclean - Paramètres</title>
        <link rel="stylesheet" href="style_page_parametres.css?v=<?php echo time(); ?>">

        <!-- Importation du fichier header-->
        <script src="jquery.js"></script>
        <script> 
            $(function(){
               $("#header").load("contenu/header.php"); 
            });
        </script>
        <script> 
            $(function(){
                $("#header2").load("contenu/header.php"); 
            });
        </script>
    </head>

    <body>
        <?php include 'database.php';
        global $db;
        ?>

        <header class="container-flex">


            <header class="fixed margin_spec" style="width:100%;min-width:100%">
                
                <header id="header" class="gris"></header>


                <h1 class="slogan" style="padding:0;margin:0;">Paramètres </h1>
                
            </header>

            <header class="fixed" style="width:100%;min-width:100%">
                
                <header id="header2" class="gris"></header>


                <h1 class="slogan" style="padding:0;margin:0;">Paramètres </h1>
                
            </header>
        </header>

        
        <script>
            function slide(direction){
            if(direction == 'left'){
                document.getElementById('d').scrollLeft -= 10000;
            } else {
                document.getElementById('d').scrollLeft += 10000;
            }
        }


        </script>

        <div class="flex_phone">
            <button type="button" onclick="slide('left')"  class="arrow_position left button_fixed"><img src="images/fleche_bleu.png" style="transform: rotate(180deg);" class="arrow_img" alt=""></button>
            <button type="button" onclick="slide('right')" class="arrow_position right button_fixed"><img src="images/fleche_bleu.png" class="arrow_img" alt=""></button>
        </div>

        <section class="container-flex"  id="big_container">

            <?php 
            
                $q = $db ->prepare('SELECT Compte FROM utilisateurs WHERE id = ?');
                $q->execute([$_SESSION['id']]);
                $etat_compte = $q->fetch();
            ?>

            <section class="container-flex margin_spec" style="justify-content:space-around;min-width:100%;width:100%;">




                    <div class="partie">
                        <h1 class="titre">Profil<hr></h1>
                        

                        <div style="float:left;">
                            <?php 
                                if(isset($_POST['supprimer_compte'])){

                                    
                                    $q = $db->prepare("DELETE from utilisateurs WHERE id = ?");
                                    $q->execute([$_SESSION['id']]);

                                    header('Location: page_deconnexion.php');

                                }

                                if (isset($_POST['toggleState'])){
                                    if ($etat_compte[0] == "publique"){
                                        $q = $db->prepare("UPDATE utilisateurs SET Compte = ? WHERE id=?");
                                        $q->execute(["prive",$_SESSION['id']]);
                                    }
                                    else{
                                        $q = $db->prepare("UPDATE utilisateurs SET Compte = ? WHERE id=?");
                                        $q->execute(["publique",$_SESSION['id']]);
                                    }
                                    echo "<meta http-equiv='refresh' content='0'>";
                                }
                            ?>

                            Nouveau nom:<br>
                            <form action="" method="post" class="container-flex space v_center_align">
                                <input type="text"  size="21" class="no-outline" name="nom" id="nom" placeholder="<?= $_SESSION['Nom'];?>" size="10" style="margin-bottom:10px;">                       
                                <button name="post_nom" value="done"><img src="images/fleche_bleu.png" width="15px" style="" ></button>
                            </form>
                            <hr>

                            Nouveau prénom:<br>
                            <form action="" method="post" class="container-flex space v_center_align">
                                <input type="text"  size="21" class="no-outline" name="prenom" id="prenom" placeholder="<?= $_SESSION['prenom'];?>" size="10" style="margin-bottom:10px;">                       
                                <button name="post_prenom" value="done"><img src="images/fleche_bleu.png" width="15px" style="" ></button>
                            </form>
                            <hr>
                            
                            A propos de moi:<br>
                            <form action="" method="post" class="container-flex space v_center_align">
                                <textarea id="story" name="story" style="resize:none"rows="3" cols="20"><?=$_SESSION['APropos'];?></textarea>
                                <button name="post_apropos" value="done"><img src="images/fleche_bleu.png" width="15px" style="" ></button>
                            </form><br> 

                            Nouvelle adresse mail:<br>
                            <form action="" method="post" class="container-flex space v_center_align">
                                <input type="text" size="21" class="no-outline" name="email" id="email" placeholder="<?= $_SESSION['email'];?>" size="10" style="margin-bottom:10px;">                       

                                <button name="post_email" value="done"><img src="images/fleche_bleu.png" width="15px" style="" ></button>
                            </form><hr>

                            Nouveau mot de passe:<br>
                            <form action="" method="post">
                                <input type="password"  size="21" class="no-outline" name="password" id="password"  size="10" style="margin-bottom:10px;">                       
                                <hr><br>
                            Confirmer le mot de passe:<br>
                                <div  class="container-flex space v_center_align">
                                <input type="password"  size="21" class="no-outline" name="cpassword" id="cpassword"  size="10" style="margin-bottom:10px;">                       
                                <button name="post_password" value="done"><img src="images/fleche_bleu.png" width="15px" style="" ></button>
                                </div>
                            </form><hr>


                            <form method="post" enctype="multipart/form-data">
                                <p>Photo de profil:</p>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <input type="submit" value="Upload" name="submit">
                            </form>
                            <br>





                            <?php
                                $uploadOk = 1;
                                $format = strtolower(pathinfo($_FILES['fileToUpload']['name'],PATHINFO_EXTENSION));


                                $target_file ="uploads/profile_".$_SESSION['id'].".".$format;






                                // Check if image file is a actual image or fake image
                                if(isset($_POST["submit"])) {
                                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                                    if($check == false or ($format != "jpg" && $format != "png" && $format != "jpeg"
                                    && $format != "gif")) {
                                        $uploadOk = 0;
                                        echo "Le fichier n'est pas une image.";?><br><?php
                                    } else {
                                        $uploadOk = 1;
                                    }
                                

                                    // Check file size
                                    if ($_FILES["fileToUpload"]["size"] > 500000) {
                                        echo "Le fichier est trop volumineux.";?><br><?php
                                        $uploadOk = 0;
                                    }

                                    // Check if $uploadOk is set to 0 by an error
                                    if ($uploadOk == 0) {
                                    // if everything is ok, try to upload file
                                    } else {
                                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                            echo "Le fichier a été envoyé.";

                                            // Mise à jour de l'extension dans la BDD
                                            $q2 = $db->prepare("UPDATE utilisateurs SET Extension = :extension WHERE id=:id");
                                            $q2->execute(['extension' => $format ,'id' => $_SESSION['id']]);

                                            // Suppression du fichier précedent s'il n'a pas déjà été remplacé par le nouveau
                                            if ($_SESSION['extension'] != $format ){
                                                unlink("uploads/profile_".$_SESSION['id'].".".$_SESSION['extension']);
                                            }
                                             $_SESSION['extension']=$format;

                                        } else {
                                            echo "Il y a eu une erreur dans l'envoi du fichier";
                                        }
                                    }
                                }
                            ?>

                            <?php
                            // Cleaning images
                            // unlink ("uploads/profile_1.png");
                            // unlink ("uploads/profile_1.jpg");

                            // unlink ("uploads/profile_3.png");
                            // unlink ("uploads/profile_3.jpg");

                            // unlink ("uploads/profile_6.png");
                            // unlink ("uploads/profile_6.jpg");

                            // unlink ("uploads/profile_8.png");
                            // unlink ("uploads/profile_8.jpg");

                            // unlink ("uploads/profile_4.png");
                            // unlink ("uploads/profile_4.jpg");
                            
                            ?>

                            <div style="border: 1px solid black; ;"><img src="<?php require_once('photo_profil.php'); 
            echo get_pdp($_SESSION['id'],$_SESSION['extension']);?>"></div>

                            
                        </div>
                    

                        <?php

                            if(isset($_POST['post_nom'])){
                                extract ($_POST);
                                ////////////////////////////////////////////////conditions formulaire infini
                                $longueurnom = strlen($nom);
                                if (!empty($nom) &&($longueurnom > 20)){?>
                                 
        
                                   <div class=texte> <?php
                                       echo "nom trop long ! (20 caractères max)";?>
                                    </div>
                                    <?php return false;
                                //////////////////////////////////////////////

                                    $q = $db->prepare("SELECT * FROM utilisateurs WHERE id = :id");
                                    $q->execute(['id' => $_SESSION['id']]);
                                    $resultat = $q->fetch(); //Convertit le résultat en un tableau

                                    if ($resultat){  //Si le compte existe


                                        $q2 = $db->prepare("UPDATE utilisateurs SET Nom = :nom WHERE id=:id");
                                        $q2->execute(['nom' => $nom,'id' => $_SESSION['id']]);

                                        $_SESSION['Nom'] = $nom;
                                    }
                                    
                                    else{
                                        trigger_error("Erreur: Le compte n'existe pas",E_USER_WARNING);
                                    }

                                }
                            }

                            if(isset($_POST['post_prenom'])){
                                extract ($_POST);
                                if (!empty($prenom)){

                                    $q = $db->prepare("SELECT * FROM utilisateurs WHERE id = :id");
                                    $q->execute(['id' => $_SESSION['id']]);
                                    $resultat = $q->fetch(); //Convertit le résultat en un tableau

                                    if ($resultat){  //Si le compte existe

                                        $q2 = $db->prepare("UPDATE utilisateurs SET prenom = :prenom WHERE id=:id");
                                        $q2->execute(['prenom' => $prenom,'id' => $_SESSION['id']]);

                                        $_SESSION['prenom'] = $prenom;
                                    }
                                    
                                    else{
                                        trigger_error("Erreur: Le compte n'existe pas",E_USER_WARNING);
                                    }

                                }
                            }

                            if(isset($_POST['post_apropos'])){
                                extract ($_POST);
                                if (!empty($story)){

     

                                    // Convertit la zone de texte entrée avec des br

                                    $story = str_replace("\n", "<br />",$story);

                                    $q = $db->prepare("SELECT * FROM utilisateurs WHERE id = :id");
                                    $q->execute(['id' => $_SESSION['id']]);
                                    $resultat = $q->fetch(); //Convertit le résultat en un tableau

                                    if ($resultat){  //Si le compte existe

                                        $q2 = $db->prepare("UPDATE utilisateurs SET APropos = :apropos WHERE id=:id");
                                        $q2->execute(['apropos' => $story,'id' => $_SESSION['id']]);

                                        $_SESSION['APropos'] = $story;
                                    }
                                    
                                    else{
                                        trigger_error("Erreur: Le compte n'existe pas",E_USER_WARNING);
                                    }

                                }
                            }

                            if(isset($_POST['post_email'])){
                                extract ($_POST);
                                if (!empty($email)){

                                    $q = $db->prepare("SELECT * FROM utilisateurs WHERE id = :id");
                                    $q->execute(['id' => $_SESSION['id']]);
                                    $resultat = $q->fetch(); //Convertit le résultat en un tableau

                                    if ($resultat){  //Si le compte existe


                                        $q3 = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email");

                                        $q3->execute(['email' => $email]);

                                        $resultat_email = $q3->fetch(); //Convertit le résultat en un tableau 

  
                                        if ($resultat_email){
                                            // Texte pour dire que l'adresse est déjà utilisée
                                        }
                                        //Si l'adresse mail n'est pas utilisée
                                        else{


                                            $q2 = $db->prepare("UPDATE utilisateurs SET  email = :email WHERE id=:id");
                                            $q2->execute(['email' => $email ,'id' => $_SESSION['id']]);
    
                                            $_SESSION['email'] = $email;

                                         }

                                    }

                                    else{
                                        trigger_error("Erreur: Le compte n'existe pas",E_USER_WARNING);
                                    }
                                }
                            }

                            if(isset($_POST['post_apropos'])){
                                extract ($_POST);
                                if (!empty($story)){

                                    $q = $db->prepare("SELECT * FROM utilisateurs WHERE id = :id");
                                    $q->execute(['id' => $_SESSION['id']]);
                                    $resultat = $q->fetch(); //Convertit le résultat en un tableau

                                    if ($resultat){  //Si le compte existe

                                        $q2 = $db->prepare("UPDATE utilisateurs SET APropos = :apropos WHERE id=:id");
                                        $q2->execute(['apropos' => $story,'id' => $_SESSION['id']]);

                                        $_SESSION['APropos'] = $story;
                                    }
                                    
                                    else{
                                        trigger_error("Erreur: Le compte n'existe pas",E_USER_WARNING);
                                    }

                                }
                            }

                            if(isset($_POST['post_password'])){
                                extract ($_POST);
                                if (((!empty($password) and !empty($cpassword)) && $cpassword == $password)){

                                    $q = $db->prepare("SELECT * FROM utilisateurs WHERE id = :id");
                                    $q->execute(['id' => $_SESSION['id']]);
                                    $resultat = $q->fetch(); //Convertit le résultat en un tableau

                                    if ($resultat){  //Si le compte existe

                                        $options=['cost'=>12];
                                        $password = password_hash($password, PASSWORD_BCRYPT, $options);

                                            
                                        $q2 = $db->prepare("UPDATE utilisateurs SET password = :password WHERE id=:id");
                                        $q2->execute(['password' => $password,'id' => $_SESSION['id']]);

                                        $_SESSION['password'] = $password;

                                        }

                                    
                                    else{
                                        trigger_error("Erreur: Le compte n'existe pas",E_USER_WARNING);
                                    }

                                }
                                else{
                                    echo "vide ou correspond pas";
                                }
                            }
                            ?>

                    </div>
                    
                    <div class="partie">
                        <h1 class="titre">Interface<hr></h1>
                        

                        <form method="post" id="post_tick">
                                    
                            <input type="checkbox"> Pollution sonore<hr>

                            <input type="checkbox"> Fréquence cardiaque<hr>

                            <input type="checkbox"> Qualité de l'air <hr>

                            <input type="checkbox"> Autre<hr>

                            <input type="submit" class="spec" name="interface_form" id="interface_form" value="confirmer">
                        </form>
                    
                    </div>
            </section>

            































































            <section class="height-sometimes container-flex" style="justify-content:space-around;min-width:100%;width:100%">

                
                <div class="partie" style="justify-content:center;">
                    <h1 class="titre">Mon compte<hr></h1>


                    
                    <form method="post" class="post">
                        <button name="supprimer_compte" id="supprimer_compte" onclick="return confirm('Etes-vous sûr de vouloir supprimer le compte?')" >Supprimer le compte</button>
                    </form>

                    
                    <form method="post" action="">
                        <input type="submit" id="toggleState" name="toggleState" value="<?php echo $etat_compte[0]=="publique" ?  "Rendre le compte privé" : "Rendre le compte public" ;  ?>"/>
                    </form>



                </div>

                <div class="partie" style="">
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

        </section>                    











        <!-- FOOTER -->

        <div class="container-flex">

            <footer class="container_footer fixed margin_spec" style="min-width:100%;width:100%">

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

        <footer class="container_footer fixed" style="min-width:100%;width:100%">                
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
    </div>




    </body>