<?php session_start(); 
?>


<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <link rel="stylesheet" href="style_page_news.css?v=<?php echo time(); ?>">

            <link href="url(fonts/StrongConcrete-Bold.otf)">

            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

            <title> Cyclean - News </title>

            <!-- Importation du fichier header-->
            <script src="jquery.js"></script>
            
            <script> 
            $(function(){
                $("#header").load("contenu/header.php"); 
            });
            </script> 

         
        </head>
        <?php 
        if (empty($_SESSION['id'])){?>

            <header class="container-flex space gris padding_total" style="">

                    <a href="page_accueil_visiteur.php"><nav style="padding-top: 2%;"><img src="images/LogoBlanc.png " width="50px"></nav></a>
        
                    <nav style="margin-right: 2.5%; margin-top:-43px;">
                        <ul class="navigation">
                            <li><img src="images/Langages.png" width="30px"/><br /></li>
                            <li><a href="page_sign_up.php">S'inscrire<br></a></li>
                            <li><a href="page_sign_in.php">Se connecter<br></a></li>
                        </ul>
                    </nav>
    
            </header>

        <?php 
        }
        else{?>
            <header id="header" class="gris"></header>

        <?php }
        ?>

        <body>

            <div> 
                <header class="header">

                  
                    <div class="header__content">
                      <h1 class="title">NEWS</h1>
                      <nav class="nav__socials">
                        <i class="nav__item fab fa-instagram"></i>
                        <i class="nav__item fab fa-twitter"> </i>
                        <i class="nav__item fab fa-facebook"></i>
                        <i class="nav__item fab fa-whatsapp"></i>
                        <i class="nav__item fas fa-envelope"></i>
                      </nav>
                    </div>
                  </header>

                 
            </div>

            <section>
              <article class="article_container" style="margin-bottom:200px;">
                <p class="article_content">
                    Des nouvelles de la boites ou un nouveau projet ici avec des infos. Il peut y avoir des update<br>
                    Du projet en cours.Pour rapprocher le client avec le projet et la team derrière le projet.<br>
                    Par la suite il peut même y avoir des updates d’autres entreprise en relation avec nous ou <br>
                    Bien des start up afin de leur donner un appuie médiatique  
                </p>
                
                <img src="images/graph.png" class="graph" width=10% height=5% >
            </article>



            <article class="article_container">
                <p class="article_content">
                    Des nouvelles de la boites ou un nouveau projet ici avec des infos. Il peut y avoir des update<br>
                    Du projet en cours.Pour rapprocher le client avec le projet et la team derrière le projet.<br>
                    Par la suite il peut même y avoir des updates d’autres entreprise en relation avec nous ou <br>
                    Bien des start up afin de leur donner un appuie médiatique  
                </p>
            </article>
         </section>

            
        </body>
    </html>
