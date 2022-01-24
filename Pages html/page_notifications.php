<?php session_start(); 

if (empty($_SESSION['id'])){
    header('Location: page_accueil_visiteur.php');
}
?>
<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>Cyclean - Notifications</title>

  <!-- Importation du fichier header-->
  <script src="jquery.js"></script>
  <script>
    $(function() {
      $("#header").load("contenu/header.php");
    });
  </script>

  <link rel="stylesheet" href="style_page_notifications.css?v=<?php echo time(); ?>" />
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

      $q->execute(['IdReceveur' => $_SESSION['id']]);

      $resultat = $q->fetchAll(PDO::FETCH_ASSOC); //Convertit le résultat en un tableau et le paramètre PDO enlève les doublons 


      $liste_id = [];
      for ($i = 0, $size = count($resultat); $i < $size; ++$i) {
        $ligne = $resultat[$i];

        // Remplit la liste des id de personnes qui te demandent en ami.
        array_push($liste_id, $ligne['IdDemandeur']);
      }

      for ($i = 0, $size = count($liste_id); $i < $size; ++$i) {

    ?>

    <div class="container2">
      
      <div class="ligne"></div>

        <?php

            

            $q1 = $db->prepare("SELECT pseudo FROM utilisateurs WHERE id = :id");

            $q1->execute(['id' => $liste_id[$i]]);

            $resultat_id = $q1->fetch(); //Convertit le résultat en un tableau

            $pseudo_demandeur = $resultat_id[0];
            ?>




            <div class="boite">
            <a href="page_profil.php?id=<?= $liste_id[$i] ?>"><img src="<?php require_once('photo_profil.php');
                                                                        echo get_pdp($liste_id[$i]); ?>" class="image"></a>
              <p class="text">
                <?= $pseudo_demandeur ?>
                veut Cyclean avec vous!
              </p>



              <form method="post" class="boite_boutons">

                <input type="submit" name="choix_ami<?= $i ?>" class="button1" value='accepter'>
                <input type="submit" name="choix_ami<?= $i ?>" class="button2" value='refuser'>


              <?php
              if (isset($_POST['choix_ami' . $i])) {
                extract($_POST);

                $choix = $_POST['choix_ami' . $i];


                if ($choix == 'accepter') {


                  $q4 = $db->prepare("INSERT INTO amis(Id,IdAmi) VALUES(:Id,:IdAmi)");

                  $q4->execute([
                    'Id' => $liste_id[$i],
                    'IdAmi' => $_SESSION['id'],
                  ]);


                  // AUTRE SENS

                  $q4 = $db->prepare("INSERT INTO amis(Id,IdAmi) VALUES(:Id,:IdAmi)");

                  $q4->execute([
                    'Id' => $_SESSION['id'],
                    'IdAmi' => $liste_id[$i],
                  ]);
                }

                // Supprime la demande de la base de données
                $q3 = $db->prepare("DELETE FROM demandesamis WHERE IdDemandeur = :id");

                $q3->execute(['id' => $liste_id[$i]]);

                header("Refresh:0");
              }
              ?>
        </div>
      </div>

      <?php } ?>
          

    </section>

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
    </div>

  </footer>

  <!-- On pourrait aussi ajouter une section "mentions j'aime" -->
</body>

</html>