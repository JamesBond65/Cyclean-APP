<?php session_start(); 

if (empty($_SESSION['id'])){
    header('Location: page_accueil_visiteur.php');
}
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Accueil</title>
        <link rel="stylesheet" href="style_page_accueil.css?v=<?php echo time(); ?>">
        <link rel = "icon" href = "images/LogoBlancCut1.png">

        <!-- Importation du fichier header-->
        <script src="jquery.js"></script>
        <script> 
        $(function(){
            $("#header").load("contenu/header.php"); 
        });
        </script> 
    </head>


    <body>

        
        <header id="header" class="gris" style="position:relative; z-index:10"></header>








        <section id="bloc_gris" class="wrap" style="margin-top: -70px;z-index:1">

            <div id="cyclean" style="margin-top: -25px;z-index:3">
                    
                <h1 class="slogan" style="padding-bottom: 50px;word-wrap: break-word;">
                    CYCLEAN<br>
                    FOR<br>
                    ENVIRONMENT</h1>

                <hr class="cyclean-trait">

                <a href="page_team.php"><h2 class="titre2">L'équipe  ➔ </h2></a>
                <a href="page_news.php"><h2 class="titre2">News  ➔ </h2></a>
                
            </div>

            <img src="images/VELOFINAL-5.png" id="velo" class="imgtop" width="900px" style="z-index:2;right: 0;margin-bottom: -10%;overflow:hidden;position: absolute;"> 

            <script>
                var container = document.getElementById('bloc_gris');
                var windowHeight = window.innerHeight;
                var windowWidth = window.innerWidth;
                var scrollArea = 2000 - windowHeight;
                var velo = document.getElementById('velo');

                // update position of square 1 and square 2 when scroll event fires.
                window.addEventListener('scroll', function() {
                    var scrollTop = window.pageYOffset || window.scrollTop;
                    var scrollPercent = scrollTop/scrollArea || 0;

                    velo.style.left = scrollPercent*window.innerWidth + 'px';
                });

            </script>
            </section>







        
        <section class="container-flex wrap center" style="z-index:4;">

            <a href="page_profil.php?id=<?= $_SESSION['id']?>" class="couleur_stats_accueil flex-3box index1">

                <h1 class="titre">Mon profil<hr class="home"></h1>

                <img src="images/Stats.png" width="300px" class="center-img" style="margin-bottom:120px;">                    


                <h2 class="titre2" style="margin-bottom:50px;">Voir ses statistiques en temps réel ➔</h2>
            </a>



            <a href="page_social.php" class="couleur_activites_accueil flex-3box index1">

                <h1 class="titre">Social<hr class="home"></h1>
                

                <img src="images/Social.png" width="280px" class="center-img" style="margin-bottom:120px;" >


                <h2 class="titre2" style="margin-bottom:50px;">Consulter les activités de ses proches ➔</h2>
            </a>



            <a href="page_classement.php" class="couleur_classement_accueil flex-3box index1">

                <h1 class="titre">Classement<hr class="home"></h1>

                <img src="images/Empreinte.png" width="300px" class="center-img" style="margin-bottom:130px;margin-top: 110px;">

                <h2 class="titre2" style="margin-bottom:50px;">Comparer son score avec le monde ➔</h2>
            </a>

        </section>













        <section class="velo-container">

            <div class="border">

                <a href="page_apropos.php"><h1 class="titre"> À propos</h1></a>
            
                <h2 class="titre2"> À propos du produit cyclean</h2>
                <p><br></p>

            </div>
            
            <div class="border">

                <a href="page_parametres.php"><h1 class="titre">Paramètres</h1></a>

                <h2 class="titre2">Modifier les paramètres de son compte</h2>

                <p><br></p>
            </div>

            
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
                ALL RIGHTS RESERVED<br>
                <br>
                <a style="color:#B4BDCB" href="page_cgu.php">MENTIONS LEGALES</a>
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