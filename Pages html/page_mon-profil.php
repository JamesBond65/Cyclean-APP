<?php session_start(); 

if (empty($_SESSION['id'])){
    header('Location: page_accueil_visiteur.php');
}
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Mon profil</title>
        <link rel="stylesheet" href="style_page_statistiques.css?v=<?php echo time(); ?>">

        <!-- Importation du fichier header-->
        <script src="jquery.js"></script>
        <script> 
            $(function(){
                $("#header").load("contenu/header.html"); 
            });
        </script> 
    </head>


    <body>





        <header id="header"></header>


        <section class="bloc_marron space wrap"> 
        
            <h1 class="slogan padd_left">
                Mon profil <br>
                 </h1>

            
            <img src="images/Stats.png" class="imgtop" style="margin-right: 150px;" width="500px">

            
        <div class="boite_utilisateur1">


        </section>



        
        <hr class="cyclean-trait" style="margin-bottom:200px;">




        <!-- LES STATS -->
        <!-- ------------------------------------------------------------ -->

        <section class="container-flex v_center_align" style="flex-basis:100%;justify-content:space-around;margin-bottom:150px;">

        
            <a href="page_mon-profil.php" style="margin-left:2%;">
                <img src="images/Profil.png" class="Image_Profil1">
            </a>

            <div class="boite_utilisateur1 container-flex" style="flex-basis:80%;justify-content:space-around;">
                <div>
                    <p style="text-align:center;" class="Pseudo"><?= $_SESSION['pseudo']?></p>
                    <p style="text-align:center;"class="Prenom titre"><?= $_SESSION['prenom']?> <?= $_SESSION['Nom']?></p>
                </div>

                <p style="text-align:center;" ><span class="titre">A Propos de moi:</span><br>
                <?= $_SESSION['APropos']?>
                </p>

            </div>


        </section>


        <section class="grid center" style="padding-bottom: 200px;"> 

            <!-- Ligne 1 -->

            <img src="images/graph.png" width="300px">

            <div class="vline margin-sides"></div>
            <hr class="special-cyclean-trait">


            <div class="special-margin">  <!--v_center_align avant-->
                <div class="container-flex v_center_align ">
                    <h1 class="stats text-center">86</h1> 
                    <h1 class="slogan text-center">db</h1>
                </div>
                
                <h1 class="titre2 text-center">Durant votre dernier trajet,<br> vous avez subit 86db en moyenne.</h1>

            </div>










            <!-- Ligne 2 -->
            
            <div > <!--v_center_align avant-->
                <h1 class="stats">85</h1>
                <h1 class="titre2 text-center">Polluant principal<br>Pm 2,5</h1>
            </div>
            
            <div class="vline margin-sides"></div>
            <hr class="special-cyclean-trait">
            
            <div class="container-flex special-margin">
                <img src="images/Plan_travail.png" width="300px">  
            </div>


            











            <!-- Ligne 3 -->

            <img src="images/HEART.png" width="300px">  
            <div class="vline margin-sides"></div>
            <hr class="special-cyclean-trait ">

            <div class="special-margin">
                <div class="container-flex"> <!--v_center_align avant-->
                    <h1 class="stats text-center">70</h1> 
                    <h1 class="slogan text-center">bpm</h1>
                </div>
                
                <h1 class="titre2 text-center">Durant votre dernier trajet, votre coeur battait à<br> une fréquence moyenne de 70 bpm.</h1>

            </div>






            




            
        </section>

        <section class="container-flex" style="padding-bottom:40px;">  
            <div class="fbasis50 moyenne-box-padd" style="background-color:#927879;">
            <h1 class="moyenne">Moyenne du dernier mois </h1>

            </div>
            
            <div class="fbasis50 moyenne-box-padd" style="background-color:#b69797;">
            <h1 class="moyenne">Moyenne de l'année </h1>
                
            </div>
        </section>









        <div class="padd_left" style="width:20%;padding-bottom:20px;float:right;text-align:right;padding-right:5%">
            <a href="page_statistiques.php" style="color: white;text-decoration: none;"><h1 class="titre">Détail des trajets</h1></a>
            <hr style="color: white;">
        </div>


        <!-- ------------------------------------------------------------ -->







    <!-- FOOTER -->

    <footer class="container_footer" style="clear: right">                
        <div style="padding-left: 5%;">
            <img src="images/images_footer/Marron/LogoMarron.png" width="65px"><br>

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
                    <img src="images/images_footer/Marron/insta-13.png" width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/images_footer/Marron/whatsapp.png" width="20px"><br>
                    <img src="images/images_footer/Marron/twitter.png" width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/images_footer/Marron/mail.png" width="20px">
                </div>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/images_footer/Marron/facebook.png " width="20px">
            </div>
        </div>

    </footer>
        
                        
</body>