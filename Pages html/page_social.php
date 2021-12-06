<!DOCTYPE html>

<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Cyclean - Social</title>
    <link rel="stylesheet" href="style_page_social.css?v=<?php echo time(); ?>" />

    <!-- Importation du fichier header-->
    <script src="jquery.js"></script>
    <script>
      $(function () {
        $("#header").load("contenu/header.html");
      });
    </script>
  </head>

  <body>
    <header id="header"></header>

    <!-- haut de page -->

    <section class="bloc_violet">
      <div class="sous_bloc">
        <h1 class="slogan">
          ACTIVITES<br>
          DES UTILISATEURS
        </h1>

        <div class="image_Social">
          <img src="images/Social.png" width="450px" />
        </div>
      </div>
      <div class="social_trait"></div>
    </section>



    <!-- liste utilisateurs -->

    <li class="liste_utilisateurs">
      <section class="Ligne1">
        <div class="boite_utilisateur1">
          <div class="text_1">
            <p class="Pseudo">Leopoldo</p>
            <div class="text_2">
              <p class="Prenom">Leo</p>
              <p class="Nom">Poldo</p>
            </div>
          </div>
          <div class="Trait_vertical"></div>
          <div class="text_utilisateur">
            <p>
              Un paragraphe avec des informations sur l'utilisateur avec les
              donnés de son compte
            </p>
            <p>300 bpm</p>
            <p>22 km</p>
            <p>Activité en hausse de 10% depuis la semaine dernière</p>
          </div>
        </div>
        <a href="page_mon-profil.php" style="margin-left: 10%">
          <img src="images/Profil.png" class="Image_Profil1" />
        </a>
      </section>

      <section class="Ligne2">
        <a href="page_mon-profil.php" style="margin-right: 10%">
          <img src="images/Profil.png" class="Image_Profil2" />
        </a>
        <div class="boite_utilisateur1">
          <div class="text_1">
            <p class="Pseudo">Leopoldo</p>
            <div class="text_2">
              <p class="Prenom">Leo</p>
              <p class="Nom">Poldo</p>
            </div>
          </div>
          <div class="Trait_vertical"></div>
          <div class="text_utilisateur">
            <p>
              Un paragraphe avec des informations sur l'utilisateur avec les
              donnés de son compte
            </p>
            <p>300 bpm</p>
            <p>22 km</p>
            <p>Activité en hausse de 10% depuis la semaine dernière</p>
          </div>
        </div>
      </section>
    </li>








    

    <!-- FOOTER -->

    <footer class="container_footer">
      <div style="padding-left: 5%">
        <img
          src="images/images_footer/Violet/LogoViolet.png"
          width="65px"
        /><br />

        <p class="texte_footer" style="margin-top: 0px">Cyclean</p>
      </div>

      <p class="texte_footer">
        © GREEN SENSE 2021<br />
        ALL RIGHTS RESERVED
      </p>

      <div style="margin-right: 5%">
        <p class="texte_footer" style="margin-bottom: 0px; margin-top: 0px">
          Contacts
        </p>

        <div>
          <div class="logo_insta_whatsapp">
            <img
              src="images/images_footer/Violet/instaV-1.png"
              width="20px"
            />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img
              src="images/images_footer/Violet/WhatsappV..png"
              width="20px"
            /><br />
            <img
              src="images/images_footer/Violet/twitterV.png"
              width="20px"
            />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="images/images_footer/Violet/mailV.png" width="20px" />
          </div>

          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img
            src="images/images_footer/Violet/fbV5.png "
            width="20px"
          />
        </div>
      </div>
    </footer>
  </body>
</html>
