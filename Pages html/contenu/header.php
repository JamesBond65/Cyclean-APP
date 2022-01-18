<?php session_start(); ?>
<header class="container-flex space padding_total">
  <nav style="padding-top:2%">
    <a href="page_accueil.php">
      <img src="images/LogoBlanc.png " width="50px"/>
    </a>
  </nav>

  <nav style="margin-right: 2.5%;z-index:1;">
    <ul class="navigation">
      <li><img src="images/Langages.png" width="30px" /><br /></li>
      <li>
        <a href="page_notifications.php">Notifications <br /></a>
      </li>
      <li>
        <a href="page_profil.php?id=<?= $_SESSION['id'] ?>">Mon Profil<br /></a>
      </li>
      <li>
        <a href="page_social.php">Social<br /></a>
      </li>
      <li>
        <a href="page_classement.php">Classement <br /></a>
      </li>

      <li>
        <a href="page_faq.php">Forum<br /></a>
      </li>

      <li>
        <a href="page_contact.php">Contact<br /></a>
      </li>



      <li>
        <a href="page_parametres.php">Paramètres<br /></a>
      </li>
      <li>
        <a href="page_deconnexion.php">Déconnexion<br /></a>
      </li>
    </ul>
  </nav>
</header>
