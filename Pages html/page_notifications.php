<?php session_start(); ?>
<!DOCTYPE html>

<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <title>Cyclean - Notifications</title>

    <!-- Importation du fichier header-->
    <script src="jquery.js"></script>
    <script>
      $(function () {
        $("#header").load("contenu/header.html");
      });
    </script>

    <link
      rel="stylesheet"
      href="style_page_notifications.css?v=<?php echo time(); ?>"
    />
  </head>

  <body>

    <header id="header"></header>

    
    <section>
      <h1 class="titre">Notifications</h1>
      <div class="trait"></div>
    </section>




    <section class="container1">
      <?php 
      include 'database.php';
      global $db;
      
      $q = $db->prepare("SELECT * FROM demandesamis WHERE IdReceveur = :IdReceveur");

      $q -> execute(['IdReceveur' => $_SESSION['id']]);

      $resultat = $q->fetchAll(PDO::FETCH_ASSOC); //Convertit le résultat en un tableau et le paramètre PDO enlève les doublons 


      $liste_id = [];
      for($i = 0, $size = count($resultat); $i < $size; ++$i) {
          $ligne = $resultat[$i];

          // Remplit la liste des id de personnes qui te demandent en ami.
          array_push($liste_id,$ligne['IdDemandeur']);

           
      }

      for($i = 0, $size = count($liste_id); $i < $size; ++$i){
          ?>

        <div class="container2">
          <div class="ligne">
          <img src="images/Profil.png" class="image">
            <div class="boite">
              <p class="text">
                <?php      
                          
                $q1 = $db->prepare("SELECT pseudo FROM utilisateurs WHERE id = :id");

                $q1 -> execute(['id' => $liste_id[$i]]);
    
                $resultat_id = $q1->fetch(); //Convertit le résultat en un tableau

                $pseudo_demandeur = $resultat_id[0];
                echo $pseudo_demandeur;?> 
                veut Cyclean avec vous!
              </p>


              
              <div class="boite_boutons">
              <button class="button1">Accepter</button>
              <button class="button2">Refuser</button>
            </div>
          </div>

          </div>
        </div>

        <?php } ?>

    </secion>

    <footer class="container_footer">                
      <div style="padding-left: 5%;">
          <img src="images/images_footer/Blanc/LogoGris.png" width="65px"><br>

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
                  <img src="images/images_footer/Blanc/instaF.png" width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <img src="images/images_footer/Blanc/WhatsappF.png" width="20px"><br>
                  <img src="images/images_footer/Blanc/TwitterF.png" width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <img src="images/images_footer/Blanc/Mail.F.png" width="20px">
              </div>

              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/images_footer/Blanc/facebookF.png " width="20px">
          </div>
      </div>

</footer>

    <!-- On pourrait aussi ajouter une section "mentions j'aime" -->
  </body>
</html>
