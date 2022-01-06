<!DOCTYPE html>


<html>
  <head>
    <meta charset="utf-8">
    <title>Page team</title>
    <link rel="stylesheet" href="style_page_team.css?v=<?php echo time(); ?>">
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

    <section >
      <div class="titre">
        THE CYCLEAN TEAM
      </div> 

      <div class="classement-trait"></div>
      
    </section>

    <section class="corps">
      <div class="poste">
          <h2>Steven Bradley .........................Poste</h2>
          <h2>Mouhamed Sy ..........................Poste</h2>
          <h2>Armand  Bidault .......................Poste</h2>
          <h2>Richard Kienitz ........................Poste</h2>
          <h2>Adrien Frieh .............................Poste</h2>
      </div>
      <div class="image">

        <img src="Images/LogoBlancCut.png" id="logo" width="500px">

      </div>
  </section>



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
