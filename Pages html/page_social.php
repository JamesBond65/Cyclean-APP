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
      <form  method="form">
        <input
          type="text"
          name="search"
          id="search"
          placeholder="Recherche.."

        />
        <input type="submit" class="button" name="search_form" id="search_form" value="recherche">
      

    </form>
    <?php 
            if(isset($_POST['search_form'])){
              echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
                        extract ($_POST);
                        $q = $db->prepare("SELECT pseudo FROM utilisateurs WHERE pseudo = :pseudo");

                        $q->execute(['pseudo' => $search]);

                        $resultat = $q->fetch();
                        echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";}
          ?>

  </body>
</html>
