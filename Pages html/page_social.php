<?php session_start(); 

if (empty($_SESSION['id'])){
    header('Location: page_accueil_visiteur.php');
}
?>

<!DOCTYPE html>

<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <title>Cyclean - Social </title>
  <link rel="stylesheet" href="style_page_social.css?v=<?php echo time(); ?>" />

  <!-- Importation du fichier header-->
  <script src="jquery.js"></script>
  <script>
    $(function() {
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

  <section class="bloc_violet sous_bloc">
      <h1 class="slogan_pourc padd_left">
        ACTIVITES<br />
        DES UTILISATEURS
      </h1>
      
      <img src="images/Social.png"  class="imgtop" style="margin-right:250px;margin-top:-130px;" width="550px">
  </section>
  <div class="trait" style="margin-bottom:140px;"></div>
  <!-- Recherche utilisateurs -->


  <h1 class="titre_liste">Recherche utilisateur</h1>
  <form method="post">
    <section class="Recherche">
      <div class="ligne">
        <div class="div_1">
          <input type="text" name="search" placeholder="Recherche.." class="Text_Input" required />
        </div>
      </div>
      <input class="search_button" type="submit" name="formsend" value="entrer" hidden />
    </section>
  </form>

  <?php
  if (isset($_POST['formsend'])) {

    extract($_POST);

    $q = $db->prepare("SELECT pseudo, id, IdDemandeur,Extension FROM utilisateurs LEFT JOIN demandesamis ON utilisateurs.id = demandesamis.IdReceveur AND demandesamis.IdDemandeur = ? WHERE pseudo LIKE ? AND id != ?");
    $q->execute([$_SESSION["id"], "%" . $_POST["search"] . "%", $_SESSION["id"]]);
    $resultat = $q->fetchAll();

    if ($resultat) {
      foreach ($resultat as $pseudo_trouve) {
        // METTRE LES RESULTATS DE LA RECHERCHE ET LE HTML CORRESPONDANT
      ?>
        <form method="post">
          <div>
            <div class="tableau">
              <div class="boite1">
              
                <div class="ligne1">
                <a href="page_profil.php?id=<?php echo $pseudo_trouve[1] ?>"><img src="<?php require_once('photo_profil.php');
                        echo get_pdp($pseudo_trouve[1]); ?>" class="images_recherche" /></a>
                <div class=pseudo_trouve>
                <a href="page_profil.php?id=<?php echo $pseudo_trouve[1] ?>" style="text-decoration:none;color:white;"><?php echo $pseudo_trouve[0]; ?></a>
                </div>
            
                <input type="text" name="friendId" value="<?php echo $pseudo_trouve[1] ?>" hidden />
            
                <input type="submit" name="addFriend" value="<?php echo isset($pseudo_trouve["IdDemandeur"]) ? "Déjà demandé" : "Ajouter";  ?>" <?php echo isset($pseudo_trouve["IdDemandeur"]) ? "disabled" : ""; ?> />
                </div>
            </div>
            
            
          </div>
        </form>
    <?php
      }
    } else {
      echo "le compte recherché n'existe pas";
    }
  } else if (isset($_POST["addFriend"])) {
    $q = $db->prepare("INSERT INTO demandesamis (IdDemandeur, IdReceveur) VALUES (?, ?)");
    $q->execute([intval($_SESSION["id"]), intval($_POST["friendId"])]);
  } else { ?>

    <div class="social_trait2" style="margin-top:140px;"></div>

    <!-- liste utilisateurs -->
    <h1 class="titre_liste">Amis cyclean</h1>
    <li class="liste_utilisateurs">
      <?php
      $q = $db->prepare("SELECT * FROM amis LEFT JOIN utilisateurs ON utilisateurs.id = amis.Id WHERE amis.IdAmi = ?");
      $q->execute([$_SESSION["id"]]);
      $resultats = $q->fetchAll();

      $sideType = 1;
      foreach ($resultats as $result) {



      ?>
        <section class="Ligne<?php echo ($sideType = ($sideType + 1) % 2) + 1; ?>">
          <?php
          if ($sideType == 1) {
          ?>
            <a href="page_profil.php?id=<?php echo $result["id"] ?>" style=" margin-left: 10%">
              <img src="<?php require_once('photo_profil.php'); echo get_pdp($result["id"]); ?>" class="Image_Profil1" />
            </a>
          <?php
          }
          ?>
          <div class="boite_utilisateur1">
            <div class="text_1">
              <p class="Pseudo"><?= $result['pseudo'] ?></p>

              <div class="text_2">
                <p class="Prenom"><?php echo $result["prenom"]; ?></p>
                <p class="Nom"><?php echo $result["Nom"]; ?></p>
              </div>
            </div>
            <div class="Trait_vertical"></div>
            <div class="text_utilisateur">
              <p style="font-family: Helvetica">
                <?php echo $result["APropos"]; ?>

              </p>

              <?php

              $max=$db->prepare("SELECT MAX(NumSerie) FROM mesures WHERE Id = ?");
              $max->execute([$result["id"]]);
              $dernier_trajet = $max->fetch()[0];



              $q = $db->prepare("SELECT AVG(ValeurMesure) FROM mesures WHERE mesures.Id = ? AND TypeCapteur = ? AND NumSerie = ? ");
              $q->execute([$result["id"],'FrequenceC',$dernier_trajet]);
              $mesures_freqc = $q->fetch();


              $q1 = $db->prepare("SELECT AVG(ValeurMesure) FROM mesures WHERE mesures.Id = ? AND TypeCapteur = ? AND NumSerie = ? ");
              $q1->execute([$result["id"],'Sonore',$dernier_trajet]);
              $mesures_sonore = $q1->fetch();


              $q2 = $db->prepare("SELECT AVG(ValeurMesure) FROM mesures WHERE mesures.Id = ? AND TypeCapteur = ? AND NumSerie = ? ");
              $q2->execute([$result["id"],'Gaz',$dernier_trajet]);
              $mesures_gaz = $q2->fetch();


              ?>
              <p style="font-family: Helvetica;font-weight:bold;">Moyennes du dernier trajet:</p>
              <p style="font-family: Helvetica"><?= is_null($mesures_freqc[0]) ? 0 : round($mesures_freqc[0]) ;?> BPM<br><?= is_null($mesures_sonore[0]) ? 0 : round($mesures_sonore[0]) ;?> DB<br><?= is_null($mesures_gaz[0]) ? 0 : round($mesures_gaz[0]) ; ?> PPM</p>


            </div>
          </div>
          <?php
          if ($sideType == 0) {
          ?>
            <a href="page_profil.php?id=<?php echo $result["id"] ?>" style="margin-left: 10%">
              <img src="<?php require_once('photo_profil.php'); echo get_pdp($result["id"]); ?>" class="Image_Profil1" />
            </a>
          <?php
          }
          ?>
        </section>
      <?php
      }
      ?>
    </li>

    <!------------------ FOOTER ----------------->

    <footer class="container_footer">
      <div style="padding-left: 5%">
        <img src="images/images_footer/Blanc/LogoGris.png " width="65px" /><br />

        <p class="texte_footer" style="margin-top: 0px">Cyclean</p>
      </div>

      <p class="texte_footer">
        © GREEN SENSE 2021<br />
        ALL RIGHTS RESERVED
      </p>

      <div style="margin-right: 5%">
        <div class="texte_footer" style="margin-bottom: 10px; margin-top: 0px">
          Contacts
        </div>

        <div>
          <div class="logo_insta_whatsapp">
            <img src="images/images_footer/Blanc/instaF.png " width="20px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="images/images_footer/Blanc/WhatsappF.png " width="20px" /><br />
            <img src="images/images_footer/Blanc/TwitterF.png " width="20px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="images/images_footer/Blanc/Mail.F.png " width="20px" />
          </div>

          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/images_footer/Blanc/facebookF.png " width="20px" />
        </div>
      </div>
    </footer>
  <?php } ?>
</body>

</html>