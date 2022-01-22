<?php session_start(); 
?>


<!DOCTYPE html>
    <html>
        <?php include_once 'database.php'; ?>
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


            <div style="margin-bottom:100px;"> 
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


            <?php 
                if($_SESSION['utilisateur']=='Administrateur'){
                ?>
                    
                    <article class="article_container" style="margin-bottom:150px;">
                        <form method="post" style="margin-left:70px;text-align:center;">
                            <h1 style="text-align:center;margin-bottom:15px;">Ajouter une publication</h1>
                            <input type="text" name="titre" class="text" id="titre" placeholder="Titre..."><br>
                            <textarea style="resize:none;height:200px;" class="text" name="contenu" id="contenu" placeholder="Contenu de la publication...."></textarea><br>
                            <input type="submit" name="formsend" id="formsend" value="Ajouter">
                        </form>
                    </article>


                <?php   
                if(isset($_POST['formsend'])){
                    extract($_POST);

                    if(!empty($titre) && !empty($contenu)){
                        $q=$db->prepare("INSERT INTO news(pseudo,contenu,titre) VALUES(?,?,?)");
                        $q->execute([$_SESSION['pseudo'],$contenu,$titre]);
                    }
                }

                

                }
            ?>

            <section>


                <?php 
                $q = $db->prepare("SELECT contenu,pseudo,date,titre FROM news ORDER BY date DESC"); //
                $q->execute();
                $news_total = $q->fetchall();
                
                foreach($news_total as $news){
                ?>

                    <article class="article_container" style="margin-bottom:90px;text-align:center;">
                        <h1 style="margin-bottom:40px;"><?= $news[3]; ?></h1>
                        <p class="article_content" style="margin-bottom:100px;text-align:left;"><?= wordwrap(nl2br($news[0]), 90, "<br />\n",true); ?></p>

                        <p style="float:right;text-align:right;">Publié par <?= $news[1]; ?> le <?= $news[2]; ?> </p>

                    </article>

                <?php } ?>


            </section>

            
        </body>
    </html>
