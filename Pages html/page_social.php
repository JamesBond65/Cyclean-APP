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

  <section class="bloc_violet">
    <div class="sous_bloc">
      <h1 class="slogan">
        ACTIVITES<br />
        DES UTILISATEURS
      </h1>

      <div class="image_Social">
        <img src="images/Social.png" width="450px" />
      </div>
    </div>
    <div class="social_trait"></div>
  </section>

  <!-- Recherche utilisateurs -->
  <h1 class="titre_liste">Recherche utilisateur</h1>
  <form method="post">
    <section class="Recherche">
      <div class="ligne">
        <div class="div_1">
          <input type="text" name="search" placeholder="Recherche.." class="Text_Input" required />
        </div>
        <div class="div_2">
          <p class="text_amis">AMIS SEULEMENT :</p>
          <label class="switch">
            <input type="checkbox" name="friends_only" checked />
            <span class="slider round"></span>
          </label>
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
                        echo get_pdp($pseudo_trouve[1],$pseudo_trouve[3]); ?>" class="images_recherche" /></a>
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

    <div class="social_trait2"></div>

    <!-- liste utilisateurs -->
    <h1 class="titre_liste">Cyclean friends</h1>
    <li class="liste_utilisateurs">
      <?php
      $q = $db->prepare("SELECT * FROM amis LEFT JOIN utilisateurs ON utilisateurs.id = amis.Id LEFT JOIN mesures ON amis.Id = mesures.Id WHERE amis.IdAmi = ?");
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
              <img src="<?php require_once('photo_profil.php'); 
                        echo get_pdp($result["id"],$result['Extension']); ?>" class="Image_Profil1" />
            </a>
          <?php
          }
          ?>
          <div class="boite_utilisateur1">
            <div class="text_1">
              <p class="Pseudo"><?= $result['pseudo'] ?></p>

              <div class="text_2">
                <p class="Prenom"><?php echo $result["Prenom"]; ?></p>
                <p class="Nom"><?php echo $result["Nom"]; ?></p>
              </div>
            </div>
            <div class="Trait_vertical"></div>
            <div class="text_utilisateur">
              <p style="font-family: Helvetica">
                <?php echo $result["APropos"]; ?>
              </p>

              <?php
              $q = $db->prepare("SELECT * FROM mesures WHERE mesures.Id = ? ORDER BY DateMesure ASC");
              $q->execute([$result["id"]]);
              $mesures = $q->fetchAll();
              $bpm = 0;
              $sonore = 0;
              foreach ($mesures as $mesure) {
                if ($mesure["TypeCapteur"] == "FrequenceC")
                  $bpm = $mesure["ValeurMesure"];
                else if ($mesure["TypeCapteur"] == "Sonore")
                  $sonore = $mesure["ValeurMesure"];
              }
              ?>
              <p style="font-family: Helvetica"><?php echo $bpm ?> bpm</p>
              <p style="font-family: Helvetica"><?php echo $sonore ?> db</p>
              <p style="font-family: Helvetica">
                Activité en hausse de 10% depuis la semaine dernière
              </p>
            </div>
          </div>
          <?php
          if ($sideType == 0) {
          ?>
            <a href="page_profil.php?id=<?php echo $result["id"] ?>" style="margin-left: 10%">
              <img src="<?php echo strlen($result["Extension"]) > 0 ? "uploads/profile_" . $result["id"] . "." . $result["Extension"] : "images/user.svg"; ?>" class="Image_Profil1" />
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