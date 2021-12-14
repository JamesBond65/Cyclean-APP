<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Page des classements</title>
        <link rel="stylesheet" href="style_page_classements.css?v=<?php echo time(); ?>">

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






       <!--Classement des utilisateurs + image-->

        <section class="bloc_vert">

            <h1 class="slogan">
                CLASSEMENT<br> DES UTILISATEURS</h1>

            <div class="image_empreinte">
                <img src="images/Empreinte.png" width="500px">
           </div>
            
           <div class="classement-trait"></div>

       </section>

       <!--END Classement des utilisateurs + image-->

       

       

       <!----------------------------BLOC PODIUM------------------------->
       
       <?php

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include_once 'database.php';

        $sql = "SELECT * FROM   utilisateurs ORDER BY CreditsCyclean DESC";

        /*$sql = "SELECT * FROM 'utilisateurs' ORDER BY Points DESC";*/
        $requete = $db->query($sql);
        $utilisateurs = $requete->fetchall();

        //$tableau_pseudos = [];

       foreach ($utilisateurs as $un_utilisateur) {
            
            $tableau_pseudos[] = $un_utilisateur['pseudo'];
            $tableau_points[] = $un_utilisateur['CreditsCyclean'];
                
            }

        ?>


       <section class="bloc_podium">
        
            <div class="section_contenu" >
                <div class="un_deux_trois">
                    01
                </div>

                <div class="un_deux_trois">
                    02
                </div>

                <div class="un_deux_trois">
                    03
                </div>
            </div>

            <div class="section_contenu trait">

            </div>

            <div class="section_contenu">
                <div class="pseudos">

                    <?php echo $tableau_pseudos[0]; ?>

                </div>

                <div class="pseudos">

                    <?php echo $tableau_pseudos[1]; ?>
                
                </div>

                <div class="pseudos">

                    <?php echo $tableau_pseudos[2]; ?>

                </div>
            </div>

            <div class="section_contenu" >
               
                <div class="points_cyclean">

                    <?php echo $tableau_points[0] . " Cy"; ?>

                </div>

                <div class="points_cyclean">

                    <?php echo $tableau_points[1] . " Cy"; ?>

                </div>

                <div class="points_cyclean">

                    <?php echo $tableau_points[2] . " Cy"; ?>
                    
                </div>
            </div>
        
       </section>
       
        <!--------------------------END BLOC PODIUM---------------------->
       
        <!----------------------------Classement personnel------------------------->


         <section class="classement_personnel">
                
            <div class="photo_de_profil">
                <img src="images/Profil utilisateurs/Emplacement profil.png" width="250px" >
            </div>

            <div class="informations_personelles">
               
                <div class="emplacement_informations" >
                                            
                    <div class="titres" >
                            Pseudo
                        </div>

                        <div class="titres">
                            Cy Point
                        </div>

                        <div class="titres">
                            Classement
                        </div>

                        <div class="titres">
                            Meilleure stat
                        </div>


                </div>


                <div class="boites" >
                    
                    <div class="rectangles">
                        
                        <div class="rectangles_titres">

                            <?php echo $tableau_pseudos[0]; ?>

                        </div>

                        <div class="rectangles_titres">

                        <?php echo $tableau_pseudos[1]; ?>

                        </div>

                        <div class="rectangles_titres">

                        <?php echo $tableau_pseudos[2]; ?>

                        </div>

                        <div class="rectangles_titres">

                            <?php echo $tableau_pseudos[3]; ?>

                        </div>

                    </div>

                    <div class="rectangles">
                        
                        <div class="rectangles_titres">

                            <?php echo $tableau_points[0];?>

                        </div>

                        <div class="rectangles_titres">

                            <?php echo $tableau_points[1];?>

                        </div>

                        <div class="rectangles_titres">

                            <?php echo $tableau_points[2];?>
                            
                        </div>

                        <div class="rectangles_titres">

                            <?php echo $tableau_points[3];?>

                        </div>

                    </div>

                    <div class="rectangles">
                        
                        <div class="rectangles_titres">


                        </div>

                        <div class="rectangles_titres">

                        </div>

                        <div class="rectangles_titres">

                        </div>

                        <div class="rectangles_titres">

                        </div>

                    </div>

                    <div class="rectangles">
                        
                        <div class="rectangles_titres">


                        </div>

                        <div class="rectangles_titres">

                        </div>

                        <div class="rectangles_titres">

                        </div>

                        <div class="rectangles_titres">

                        </div>

                    </div>
                    
                    


                </div>
            </div>
                
             



        </section>


            <!----------------------------END Classement personnel------------------------->


        <footer class="container_footer">                
                <div style="padding-left: 5%;">
                    <img src="images/images_footer/Vert/LogoVert.png " width="65px"><br>

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
                            <img src="images/images_footer/Vert/instaVert.png " width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="images/images_footer/Vert/whatsappVert.png " width="20px"><br>
                            <img src="images/images_footer/Vert/twitterVert.png " width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <img src="images/images_footer/Vert/MailVert.png " width="20px">
                        </div>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/images_footer/Vert/FBVERT.png " width="20px">
                    </div>
                </div>

        </footer>

    </body>
</html>