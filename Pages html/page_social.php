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
        $("#header").load("contenu/header.php");
      });
    </script>
  </head>

  <?php
  include 'database.php';
  global $db;
  ?>

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

      <form  method="post">
        <input type="search" name="pseudo" id="pseudo" placeholder="Pseudo" required><br>
        <input type="submit" name="formsend" value="entrer">
    </form>

<?php 
    if(isset($_POST['formsend'])){
        extract($_POST);

        $q = $db ->prepare("SELECT pseudo FROM utilisateurs WHERE pseudo LIKE ?");
        $q -> execute(["%$pseudo%"]);
        $resultat = $q ->fetchAll();

        if($resultat){
            foreach ($resultat as $pseudo_trouve){
              // ICI METTRE LES RESULTATS DE LA RECHERCHE ET LE HTML CORRESPONDANT
              ?>  
              <div style="">
              <?php
              echo $pseudo_trouve[0];?>
              </div>
              <?php

















            }
        }

        else{
            echo "le compte recherché n'existe pas";
        }
    }

    else {?>



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
      <?php } ?>
  </body>

</html>
