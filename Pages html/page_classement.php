<?php session_start(); 

if (empty($_SESSION['id'])){
    header('Location: page_accueil_visiteur.php');
}
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Page des classements</title>
        <link rel="stylesheet" href="style_page_classements.css?v=<?php echo time(); ?>">
        <link rel = "icon" href = "images/LogoBlancCut1.png">
        <!-- Importation du fichier header-->
        <script src="jquery.js"></script>
        <script> 
            $(function(){
                $("#header").load("contenu/header.php"); 
            });
        </script> 
    </head>


    
    <body>
       
        <header id="header"></header>


       <!--Classement des utilisateurs + image-->

        <section class="bloc_vert space">
            <h1 class="slogan_pourc padd_left">
                CLASSEMENT<br> DES UTILISATEURS</h1>
            <img src="images/Empreinte.png" class="imgtop" style="margin-right:250px;"  width="600px">
       </section>
       <div class="classement-trait" style="margin-bottom:230px;"></div>

       <!--END Classement des utilisateurs + image-->

       

       

       <!----------------------------BLOC PODIUM------------------------->
       
       <?php
        session_start();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include_once 'database.php';


        $sql = "SELECT * FROM amis INNER JOIN utilisateurs WHERE amis.idAmi = utilisateurs.id ORDER BY CreditsCyclean DESC";


        $requete = $db->query($sql);
        $tableau = $requete->fetchall();

        $tableau_pseudos=[];
        $tableau_points=[];
        $tableau_ids=[];

       foreach ($tableau as $un_utilisateur) {

            if ($_SESSION['id'] == $un_utilisateur['Id']){

                $tableau_pseudos[] = $un_utilisateur['pseudo'];
                $tableau_points[] = $un_utilisateur['CreditsCyclean'];
                $tableau_ids[] = $un_utilisateur['IdAmi'];
     
            }
        }

        // Rajoute soi-même s'il y a des éléments
        if(count($tableau_points)!=0 && $_SESSION['cyclean']>min($tableau_points) ){
            for ($i = 0; $i < count($tableau_points);$i++){
                echo $i;
                if($_SESSION['cyclean']>$tableau_points[$i] || (!($_SESSION['cyclean']>$tableau_points[$i]) && $i==$tableau_points) ){
                    array_splice($tableau_points, $i, 0, array($_SESSION['cyclean']) );
                    array_splice($tableau_pseudos, $i, 0, array($_SESSION['pseudo']) );
                    array_splice($tableau_ids, $i, 0, array($_SESSION['id']) );
                    break;
                }
            }
        }
        else{
            array_push($tableau_points, $_SESSION['cyclean']);
            array_push($tableau_pseudos, $_SESSION['pseudo']);
            array_push($tableau_ids, $_SESSION['id']);
        }



        /*echo count($tableau_pseudos);*/

        /*echo $_SESSION['id'];*/

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

                    <?php 
                    if (isset($tableau_pseudos[0])){
                        echo $tableau_pseudos[0];

                    }
                    else{
                        echo "";
                    }
                    ?>

                </div>

                <div class="pseudos">

                    <?php 
                    if (isset($tableau_pseudos[1])){
                        echo $tableau_pseudos[1];

                    }
                    else{
                        echo "";
                    }
                     ?>
                    
                
                </div>

                <div class="pseudos">

                    <?php if (isset($tableau_pseudos[2])){
                        echo $tableau_pseudos[2];
                    }
                    else{
                        echo "";
                    }
                    ?>

                </div>
            </div>

            <div class="section_contenu" >
               
                <div class="points_cyclean">

                    <?php 
                    if (isset($tableau_points[0])){
                        echo $tableau_points[0] . " Cy";
                    }
                    else{
                        echo "";
                    }
                    ?>

                </div>

                <div class="points_cyclean">

                    <?php 
                    if (isset($tableau_points[1])){
                        echo $tableau_points[1] . " Cy";
                    }
                    else{
                        echo "";
                    }
                    ?>

                </div>

                <div class="points_cyclean">

                    <?php 
                    if (isset($tableau_points[2])){
                        echo $tableau_points[2] . " Cy";
                    }
                    else{
                        echo "";
                    }
                    ?>
                    
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

                
                    <div class="titres">
                            Classement
                    </div>

                                            
                    <div class="titres" >
                        Pseudo
                    </div>

                    <div class="titres">
                        Cy Point
                    </div>


                </div>


                <div class="boites" >

                
                    <div class="rectangles">

                        <?php 
                            
                        for ($i = 0; $i < count($tableau_pseudos); $i++) {
                                
                            ?>

                            <div class="rectangles_titres">
                                <?= ($i+1) ?>

                            </div>

                            <?php
                        }?>    
                        

                    </div>
                    
                    <div class="rectangles">

                        <?php 
                        
                        for ($i = 0; $i < count($tableau_pseudos); $i++) {
                            
                            ?>

                            <div class="rectangles_titres">

                                <?php echo '<a href="page_profil.php?id='.$tableau_ids[$i].'">'.$tableau_pseudos[$i].'</a>';?>


                            </div>

                            <?php
                        }?>
                        

                    </div>

                    <div class="rectangles">

                        <?php 
                            
                            for ($i = 0; $i < count($tableau_pseudos); $i++) {
                                
                                ?>

                                <div class="rectangles_titres">

                                    <?php echo $tableau_points[$i];?>

                                </div>

                                <?php
                            }?>
                             
                        

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

                    <p class="texte_footer" style="margin-bottom: 10px; margin-top: 0px;">
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