<!DOCTYPE html>


<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Cyclean - Team</title>
        <link rel="stylesheet" href="style_page_team.css?v=<?php echo time(); ?>">
        <!-- Importation du fichier header-->
        <script src="jquery.js"></script>
        <script> 
	        $(function(){
	            $("#header").load("contenu/header.php"); 
	        });
        </script> 

    </head>
  
  
    <body>
        <?php
        include 'database.php';require('photo_profil.php'); 
        global $db;
        ?>
    
    <?php 
        if (empty($_SESSION['id'])){?>

            <header class="container-flex space gris padding_total" style=" margin-top:43px;">

                    <a href="page_accueil_visiteur.php"><nav style="padding-top: 2%;"><img src="images/LogoBlanc.png " width="50px"></nav></a>
        
                    <nav style="margin-right: 2.5%;">
                        <ul class="navigation">
                            <li><img src="images/Langages.png" width="30px"/><br /></li>
                            <li><a href="page_sign_up.php">S'inscrire<br></a></li>
                            <li><a href="page_sign_in.php">Se connecter<br></a></li>
                        </ul>
                    </nav>
    
            </header>

        <?php 
        }
        else{?>
            <header id="header" class="gris"></header>
        <?php }
        ?>
	
        <section >
            <div class="titre">
                THE CYCLEAN TEAM
            </div> 

            <div class="classement-trait"></div>
        
        </section>

        <section class="corps" style="position:relative;">
            <div class="poste">
                <div style="display:flex;"><a href="page_profil.php?id=1"><img class="image" src="<?php echo get_pdp(1);?>"></a><h2>Steven Bradley ............................ PDG de GREEN SENSE</h2></div>
                <div style="display:flex;"><img class="image" src="<?php echo get_pdp(1);?>"><h2>Armand  Bidault .......................... Graphiste</h2></a></div>
                <div style="display:flex;"><a href="page_profil.php?id=55"><img class="image" src="<?php echo get_pdp(55  );?>"></a><h2>Richard Kienitz ........................ Développeur full stack</h2></a></div>
                <div style="display:flex;"><a href="page_profil.php?id=42"><img class="image" src="<?php echo get_pdp(42);?>"></a><h2>Adrien Frieh ............................. Expert en formulaire</h2></a></div>
                <div style="display:flex;"><a href="page_profil.php?id=71"><img class="image" src="<?php echo get_pdp(71);?>"></a><h2>Mouhamed Sy .........................</h2></a></div>
            </div>

                <img class="imgtop" style="right:0;bottom:0;position:absolute;" src="images/LogoBlancCut1.png" id="logo" width="500px">

        </section>


<!------------------ FOOTER ----------------->

        <footer class="container_footer">                
            <div style="padding-left: 5%;">
            <img src="images/images_footer/Blanc/LogoGris.png " width="65px"><br>

            <p class="texte_footer" style="margin-top: 0px;">
                Cyclean 
            </p>
            
            </div>


            <p class="texte_footer">
            © GREEN SENSE 2021<br>
            ALL RIGHTS RESERVED
            </p>


            <div style="margin-right: 5%;">

            <div class="texte_footer" style="margin-bottom: 10px; margin-top: 0px;">
                Contacts
            </div>
            
            <div>
                <div class="logo_insta_whatsapp">
                <img src="images/images_footer/Blanc/instaF.png " width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="images/images_footer/Blanc/WhatsappF.png " width="20px"><br>
                <img src="images/images_footer/Blanc/TwitterF.png " width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="images/images_footer/Blanc/Mail.F.png " width="20px">
                </div>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/images_footer/Blanc/facebookF.png " width="20px">
            </div>
            </div>

        </footer>

    </body>
</html>
