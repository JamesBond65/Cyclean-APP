<?php session_start(); 

if (empty($_SESSION['id'])){
    header('Location: page_accueil_visiteur.php');
}
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Mes Trajets</title>
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

        <section style="float:right;text-align:right;padding-right:8%;width:60%;">

            <h1 class="slogan">Vos trajets</h1>
            
            <hr class="cyclean-trait" style="margin-bottom:60px;float:right;">
        </section>



        
        <section style="clear: right;margin: 7.9% 7.9% 0%;padding-bottom:100px;">



            <div class="padd_inside arrondi" style="background-color:#927879;">
                <div class="container-flex space">
                    <h1 class="titre">Trajet du 11/09/2022</h1>

                    <img id="image1" class="imgflip_right" src="images/fleche.png"  onclick="call('1','container1','image1')">
                </div>

                <div id="container1" style="padding-bottom:200px;display:none">
                    blzlblzblzlblzlbzlb
                </div>

            </div>

              <div class="padd_inside arrondi" style="background-color:#b69797;">
                <div class="container-flex space">
                    <h1 class="titre">Trajet du 09/09/2022</h1>

                    <img id="image2" class="imgflip" src="images/fleche.png" onclick="call('2','container2','image2')">
                </div>

                <div id="container2" style="padding-bottom:200px;display:none">
                    blzlblzblzlblzlbzlb
                </div>
                 
             </div>

             <script>
                // SCRIPT AFIN DE FAIRE DEROULER LES STATS POUR CHAQUE TRAJET DIFFERENT (EN PARAMETRE)

                var open = new Array(60).fill(false);                

                var call = function(Number,elementId,ImageId)
                {
                    var x = document.getElementById(elementId);
                    var y = document.getElementById(ImageId);
                    var num = Number;


                    if (x.style.display === "none") {
                        x.style.display = "block";

                    } else {
                        x.style.display = "none";
                    }

                
                    if(open[num]){
                        y.className = 'imgflip_right';  
                    } else{
                        y.className = 'imgflip_down';
                    }

                    open[num] = !open[num];

                }


            </script>


            
        </section>








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