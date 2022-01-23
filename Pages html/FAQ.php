<!doctype html>



<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Page FAQ</title>
  <link rel="stylesheet" href="style_page_FAQ.css">
  <script src="jquery.js"></script>
  <script src="js_faq.js"></script>
  

  <script>
        $(function(){
            $("#header").load("contenu/header.php"); 
         });
    </script> 

</head>


    <?php
        $compteur_id = 0;
        
        session_start();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include_once 'database.php';
        global $db;

    ?>


<body>

<!-- ------------------------------------------------------------------------------- -->

    
    
   <!-- --------------------------------------------------------------------------------------- --> 
    <header id="header"></header>

    <section>
        <div class="titre">
            FAQ
        </div>

        <div class="classement-trait"></div>
    </section>



    <!-- ------------------------------------------------------------------------------------ -->

    


    
    
    
   <?php

        $sql = "SELECT * FROM `faq` INNER JOIN utilisateurs ON faq.pseudo = utilisateurs.pseudo WHERE faq.question =1 ";

        $requete = $db->query($sql);
        $informations = $requete->fetchall();

        #echo($_SESSION['utilisateur']);

     ?>   


    <?php
    foreach ($informations as $information) {
        $compteur_id = $information['idQuestion'] + 1;
        

        #echo($information['pseudo']);
        #echo($information['id']);
        
    ?>

        <section class="discussion">
        
            <div class= "messages">
                
                <div class="entete">

                    <div class ="photo_profil">

                        <img src="<?php require_once('photo_profil.php'); 
                        echo get_pdp($information['id']); ?>" width="50px" style="border-radius: 50%;">

                    </div>

                    <div class="pseudo">
                        <?php echo($information['pseudo']) ?>

                    </div>

                    <div class="date_heure">
                        <?php

                            echo($information['date']);
                            
                        ?>
                    </div>

                    <div class="supprimer">
                        <?php 
                        if( $_SESSION['utilisateur'] = 'Administrateur'){
                        ?>
                            <form action="" method="POST">
                                
                                <input type="hidden" name="idSupprimer" value="<?php echo($information['idQuestion']) ?>">
                                

                                <div class="button_supprimer" style="vertical-align:middle">
                                    <input class="suppr" type="submit" name="supprimer" value="Supprimer"><span></span>
                                </div>
                                
                            </form>
                            
                        <?php
                        }
                        
                        ?>
                    </div>

                    <div class="fleche_repondre">
                        
                        <img class="image_fleche" onclick="apparaitre()" src="images\fleche_repondre.png" width="35px" >

                    </div>

                </div>

                <div class="corps" >
                    
                    <div class="info_ancien_message">
                        <?php echo($information['texte'])?>
                    </div>
                        
                    </form>
                </div>

            </div>

        </section>

    <?php
        }
    ?>

<?php
        if (isset($_POST['supprimer'])){
            
            $numero = intval($_POST['idSupprimer']);
           
            #echo($numero);
            #echo("je suis là"); 
            $db->exec("DELETE FROM `faq` WHERE idQuestion = $numero");
            header('Location: FAQ.php');

        }
    ?>

    <?php
        if (isset($_POST['publier'])){

            if (!empty($_POST['remarque'])){
               #echo('ici');

                
                $DateAndTime = date('d-m-Y H:i');
                
                
                $db->exec("INSERT INTO `faq` (`idQuestion`, `texte`, `pseudo`, 
                `question`, `reponse`, `reponse_de_la_question`, `date`) 
                VALUES('$compteur_id', '$_POST[remarque]' , '$_SESSION[pseudo]', '1','0','0','$DateAndTime' )");

                header('Location: FAQ.php');
                
            }

            else{
                echo('Le champ est vide');
            }
        }
    ?>


    

    <section class="discussion">
        <div id="js_messages">
            <div class= "messages">
                
                <div class="entete">

                    <div class ="photo_profil">
                        <img src="images\Profil.png" width="50px" style="border-radius: 50%;">

                    </div>

                    <div class="pseudo">
                        <?php echo($_SESSION['pseudo']) ?>

                    </div>

                    <div class="date_heure">
                        <?php
                            echo($DateAndTime = date('d-m-Y H:i'));
                        ?>
                    </div>

                    <div class="fleche_repondre">
                        <img class="image_fleche" onclick="apparaitre()" src="images\fleche_repondre.png" width="35px" >

                    </div>

                </div>

                <div class="corps">
                    <form method="POST" action="" class="publication_message">
                        <div class="emplacement_ecriture">
                           <textarea type="text" name="remarque" class="remarque" placeholder="Ecrire message"></textarea> 
                        </div>
                        <div class="bouton_publier" >
                            <input class="submit" type="submit" name="publier" value="Publier">
                        </div>
                        
                    </form>
                </div>

            </div>
        </div>
        
        <div id="js_reponse">

            <div class="reponses">

                <div class="entete">

                </div>

                <div class="corps">

                </div>

            </div>

        </div>
        

    </section>

    <div id="ecriture"></div>

    <section class="ajouter">

        <div class="portfolio-experiment">
            <a>
                <span class="text" onclick="display()">Ajouter une discussion</span>
                <span class="line -right"></span>
                <span class="line -top"></span>
                <span class="line -left"></span>
                <span class="line -bottom"></span>
            </a>
        </div>


    </section>



    <!-- ---------------------------------------------------------------------------------------------------- -->
  
    <footer class="container_footer">                
                <div style="padding-left: 5%;">
                    <img src="images/images_footer/Vert/LogoVert.png " width="65px"><br>

                    <p class="texte_footer" style="margin-top: 0px;">
                        Cyclean 
                    </p>
                  
                </div>


                <p class="texte_footer">
                    © GREEN SENSE 2021<br>
                    ALL RIGHTS RESERVED
                </p>


                <div style="margin-right: 5%;">

                    <p class="texte_footer" style="margin-bottom: 10px; margin-top: 0px;">
                    Contacts
                    </p>
                    
                    <div>
                        <div class="logo_insta_whatsapp">
                            <img src="images/images_footer/Vert/instaVert.png " width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="images/images_footer/Vert/whatsappVert.png " width="20px"><br>
                            <img src="images/images_footer/Vert/twitterVert.png " width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="images/images_footer/Vert/MailVert.png " width="20px">
                        </div>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/images_footer/Vert/FBVERT.png " width="20px">
                    </div>
                </div>

        </footer>

</body>


</html>