<!DOCTYPE html>

<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Cyclean - A Propos</title>
    <link rel="stylesheet" href="style_page_Propos.css" />

    <!-- Importation du fichier header-->
    <script src="jquery.js"></script>
    <script>
      $(function () {
        $("#header").load("contenu/header.php");
      });
    </script>
  </head>

  <body>
    <header id="header"></header>

    <!-- Page a Propos -->
    <h1 class="titre">A Propos</h1>
    <section class="container">
      <div class="trait1"></div>
      <div class="Partie1">
        <img src="images/VELOFINAL-5.png" class="ImageVelo1" />
        <div class="Image_text">
          <p class="text1">
            L'entreprise GREENSENSE a pour objectif de participer à la réduction du réchauffement climatique<br></br>
            Nous pensons que nous pouvons apporter notre aide à cette mission en changeant les habitudes quotidiennes des individus<br></br>
            C'est pourquoi nous avons créé CYCLEAN.
          </p>
          <!--<img src="images/Social.png" class="Im1" />-->
          <div class="trait2"></div>
        </div>
      </div>

      <div class="Partie2">
        <div class="Image_text2">
          <p class="text1">
            Le but de l'application CYCLEAN est de proner l'utilisation du vélo pour se déplacer et pour motiver les utilisateurs, nous avons créer une compétitions entre eux.<br></br>
            L'idée est simple, effcuter des courses "vertes", c'est-à-dire des courses dans des endroits non pollueé et avec une faible nuisance sonore pour marquer le plus de points. 
          </p>
          <div class="trait3"></div>
        </div>

        <img src="images/VELOFINAL-5.png" class="ImageVelo2" />
      </div>
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
