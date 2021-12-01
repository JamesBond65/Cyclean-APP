<?php session_start(); 

if (empty($_SESSION['id'])){
    header('Location: page_accueil_visiteur.php');
}
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Mon profil</title>
        <link rel="stylesheet" href="style_page_statistiques.css?v=<?php echo time(); ?>">

        <!-- Importation du fichier header-->
        <script src="jquery.js"></script>
        <script> 
            $(function(){
                $("#header").load("contenu/header.html"); 
            });
        </script> 

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>


    <body>

        <?php include 'database.php';
                global $db;


                // Récupère le numéro du dernier trajet de l'utilisateur
                $q = $db->prepare("SELECT MAX(NumSerie) FROM mesures WHERE Id = :Id");

                $q -> execute(['Id' => $_SESSION['id']]);

                $dernierTrajetArray = $q->fetch(); //Convertit le résultat en un tableau et le paramètre PDO enlève les doublons 
                $dernierTrajet = $dernierTrajetArray[0];

                echo $dernierTrajet; 




                

                // Recherche de la moyenne de fréquence cardiaque du dernier trajet

                                
                // $q_moyenneF = $db->prepare("SELECT ROUND(AVG(ValeurMesure),0) from mesures WHERE Id = :id AND TypeCapteur = :capteur AND NumSerie = :numderniertrajet");
                // $q_moyenneF -> execute(['id' => $_SESSION['id'],'capteur' => 'FrequenceC', 'numderniertrajet' => $dernierTrajet]);

                // $moyenneFreqcArray = $q_moyenneF->fetch();
                // $moyenneFreqc = $moyenneFreqcArray[0];

                // echo $moyenneFreqc; 

                $q_DTrajetF = $db->prepare("SELECT ValeurMesure from mesures WHERE Id = :id AND TypeCapteur = :capteur AND NumSerie = :numderniertrajet");
                $q_DTrajetF -> execute(['id' => $_SESSION['id'],'capteur' => 'FrequenceC', 'numderniertrajet' => $dernierTrajet]);
                
                $DTrajetFArray = $q_DTrajetF->fetchAll();

                $DTrajetF = $DTrajetFArray[0];

                echo " Mesure frequence dernier trajet: ".$DTrajetF[0];

                $DataDTrajetFArray = [];

                for($i = 0; $i < count($DTrajetFArray); $i++){
                    array_push($DataDTrajetFArray, $DTrajetFArray[$i][0]);
                }

                $DataDTrajetFArray = array_filter($DataDTrajetFArray);                
                echo " ARRAY AVEC LES MESURESSSSS: ";
                print_r($DataDTrajetFArray);

                $moyenneFreqc = array_sum($DataDTrajetFArray)/count($DataDTrajetFArray);
                $moyenneFreqc =ceil($moyenneFreqc);
                echo " d'où la Moyenne en fréquence cardiaque: ".$moyenneFreqc.". ";













                // Recherche de la moyenne de fréquence sonore du dernier trajet
                $q_DTrajetS = $db->prepare("SELECT ValeurMesure from mesures WHERE Id = :id AND TypeCapteur = :capteur AND NumSerie = :numderniertrajet");
                $q_DTrajetS -> execute(['id' => $_SESSION['id'],'capteur' => 'Sonore', 'numderniertrajet' => $dernierTrajet]);
                
                $DTrajetSArray = $q_DTrajetS->fetchAll();
                $DTrajetS = $DTrajetSArray[0];


                ?><br><br>
                <?php

                echo " Mesure intensité sonore dernier trajet: ".$DTrajetS[0];

                $DataDTrajetSArray = [];

                for($i = 0; $i < count($DTrajetSArray); $i++){
                    array_push($DataDTrajetSArray, $DTrajetSArray[$i][0]);
                }

                $DataDTrajetSArray = array_filter($DataDTrajetSArray);                
                echo " ARRAY AVEC LES MESURESSSSS: ";
                print_r($DataDTrajetSArray);

                $moyenneS = array_sum($DataDTrajetSArray)/count($DataDTrajetSArray);
                $moyenneS = ceil($moyenneS);
                echo " d'où la Moyenne en intensité sonore: ".$moyenneS.". ";
                

                ?><br><br>
                <?php

                

                // Recherche des moyennes du mois

                // On commence par définir le mois pris en compte
                $endDate = date('Y-m-d H:i:s');
                echo " Mois précedent entre ".$endDate;


                $startDate = date("Y-m-d H:i:s",strtotime("-1 month"));
                echo " et ".$startDate."... ";



                // Moyenne en fréquence cardiaque
                $q_moisyenneF = $db->prepare("SELECT ROUND(AVG(ValeurMesure),0) FROM mesures WHERE Id = ? AND TypeCapteur = ? AND DateMesure BETWEEN ? AND ?");

                $q_moisyenneF -> execute([$_SESSION['id'],'FrequenceC',$startDate, $endDate]);


                $moisyenneFArray = $q_moisyenneF->fetch(); //Convertit le résultat en une liste

                $moisyenneF = $moisyenneFArray[0];


                echo "  Moisyenne Cardiaque:".$moisyenneF;

                
                
                
                // Moyenne en fréquence sonore
                $q_moisyenneS = $db->prepare("SELECT ROUND(AVG(ValeurMesure),0) FROM mesures WHERE Id = ? AND TypeCapteur = ? AND DateMesure BETWEEN ? AND ?");

                $q_moisyenneS -> execute([$_SESSION['id'],'Sonore',$startDate, $endDate]);


                $moisyenneSArray = $q_moisyenneS->fetch(); //Convertit le résultat en une liste

                $moisyenneS = $moisyenneSArray[0];
                echo " Moisyenne Sonore:".$moisyenneS;



                ?><br> <?php

                // Recherche des moyennes de l'année

                // On commence par définir l'année prise en compte
                $endDateY = date('Y-m-d H:i:s');
                echo " Année Précente entre ".$endDateY;


                $startDateY = date("Y-m-d H:i:s",strtotime("-1 year"));
                echo " et ".$startDateY."... ";



                // Moyenne en fréquence cardiaque
                $q_YmoyenneF = $db->prepare("SELECT ROUND(AVG(ValeurMesure),0) FROM mesures WHERE Id = ? AND TypeCapteur = ? AND DateMesure BETWEEN ? AND ?");

                $q_YmoyenneF -> execute([$_SESSION['id'],'FrequenceC',$startDateY, $endDateY]);


                $YmoyenneFArray = $q_YmoyenneF->fetch(); //Convertit le résultat en une liste

                $YmoyenneF = $YmoyenneFArray[0];


                echo "  Moyenne Cardiaque année:".$YmoyenneF;


                // Moyenne en fréquence sonore
                $q_YmoyenneS = $db->prepare("SELECT ROUND(AVG(ValeurMesure),0) FROM mesures WHERE Id = ? AND TypeCapteur = ? AND DateMesure BETWEEN ? AND ?");

                $q_YmoyenneS -> execute([$_SESSION['id'],'Sonore',$startDateY, $endDateY]);


                $YmoyenneSArray = $q_YmoyenneS->fetch(); //Convertit le résultat en une liste

                $YmoyenneS = $YmoyenneSArray[0];


                echo "  Moyenne Sonore année:".$YmoyenneS;

                ?>


        <header id="header"></header>


        <section class="bloc_marron space wrap"> 
        
            <h1 class="slogan padd_left">
                Mon profil <br>
                 </h1>

            
            <img src="images/Stats.png" class="imgtop" style="margin-right: 150px;" width="500px">

            
        <div class="boite_utilisateur1">


        </section>



        
        <hr class="cyclean-trait" style="margin-bottom:200px;">




        <!-- LES STATS -->
        <!-- ------------------------------------------------------------ -->

        <section class="container-flex v_center_align" style="flex-basis:100%;justify-content:space-around;margin-bottom:150px;">

        
            <img src="images/Profil.png" class="Image_Profil1 vertical" style="margin-left:2%;">



            <div class="text-center" style="justify-content:space-around;">
                <div style="padding-bottom:80px;">
                    <h1 class="slogan"><?= $_SESSION['pseudo']?><br></h1>

                    <h2 class="titre2"><?= $_SESSION['prenom']?> <?= $_SESSION['Nom']?></h2>
                </div>

                <h2 class="titre2" style="margin:0;padding:0;">A Propos de moi:</h2>
                <p style="text-align:center;margin:0;padding:0;" ><br>
                <?= $_SESSION['APropos']?></p>

            </div>


        </section>

        <hr class="cyclean-trait" style="margin-bottom:200px;">


        <section class="grid center" style="padding-bottom: 200px;"> 

            <!-- Ligne 1 -->

            <div style="width:500px;background-color:white;">


                
            
                <?php 

                function ArrayToJavascript($Data){
                    $DataStr = '[';

                    for($i = 0; $i < count($Data); $i++){

                        $DataStr = $DataStr."'".$Data[$i]."'";

                        if($i != count($Data)-1){
                            $DataStr = $DataStr.',';
                        }
                    }
                    $DataStr = $DataStr.']';
                    return $DataStr;
                }?>




                <canvas id="myChartSonore"></canvas>


                <script>
                    const labels = <?= ArrayToJavascript(range(1,count($DataDTrajetSArray)));?>; // Transforme l'array php en array javascript

                    const data = {
                    labels: labels,
                    datasets: [{
                        label: 'Intensité sonore en fonction du "temps"',
                        backgroundColor: 'rgb(158, 133, 133)',
                        borderColor: 'rgb(158, 133, 133)',
                        data: <?= ArrayToJavascript($DataDTrajetSArray);?>, // Données sur les mesures du dernier trajet
                    }]
                    };

                    const config = {
                    type: 'line',
                    data: data,
                    options: {}
                    };

                    const myChartSonore = new Chart(
                        document.getElementById('myChartSonore'),
                        config
                    );

                </script>
            </div>
            











            <div class="vline margin-sides"></div>
            <hr class="special-cyclean-trait">


            <div class="special-margin">  <!--v_center_align avant-->
                <div class="container-flex v_center_align ">
                    <h1 class="stats text-center"><?= $moyenneS ?></h1> 
                    <h1 class="slogan text-center">db</h1>
                </div>
                
                <h1 class="titre2 text-center">Durant votre dernier trajet,<br> vous avez subit <?= $moyenneS ?> db en moyenne.</h1>

            </div>










            <!-- Ligne 2 -->
            
            <div > <!--v_center_align avant-->
                <h1 class="stats">85</h1>
                <h1 class="titre2 text-center">Polluant principal<br>Pm 2,5</h1>
            </div>
            
            <div class="vline margin-sides"></div>
            <hr class="special-cyclean-trait">
            
            <div class="container-flex special-margin">
                <img src="images/Plan_travail.png" width="300px">  
            </div>


            











            <!-- Ligne 3 -->
            <div style="width:500px;background-color:white;">
            <!-- Graphe qui contient les données de fréquence cardiaque du dernier trajet -->


                <canvas id="myChartFreq"></canvas>

                <script>

                    const labels2 = <?= ArrayToJavascript(range(1,count($DataDTrajetFArray))); ?>; // Transforme l'array php en array javascript
                    
                    const data2 = {
                    labels: labels2,
                    datasets: [{
                        label: 'Fréquence cardiaque en fonction du "temps"',
                        backgroundColor: 'rgb(158, 133, 133)',
                        borderColor: 'rgb(158, 133, 133)',
                        data: <?= ArrayToJavascript($DataDTrajetFArray) ?>, // Données sur les mesures du dernier trajet
                    }]
                    };

                    const config2 = {
                        type: 'line',
                        data: data2,
                        options: {}
                    };

                    const myChartFreq = new Chart(
                        document.getElementById('myChartFreq'),
                        config2
                    );

                </script>
                
            </div>



            <div class="vline margin-sides"></div>
            <hr class="special-cyclean-trait ">

            <div class="special-margin container-flex space v_center_align">
                
                <img src="images/HEART.png" width="150px" style="margin-right:50px;">  

                <div>

                    <div class="container-flex"> <!--v_center_align avant-->
                        <h1 class="stats text-center"><?= $moyenneFreqc ?></h1> 
                        <h1 class="slogan text-center">bpm</h1>
                    </div>
                    
                    <h1 class="titre2 text-center">Durant votre dernier trajet, votre coeur battait à<br> une fréquence moyenne de <?= $moyenneFreqc ?> bpm.</h1>

                </div>    
            </div>






            




            
        </section>

        <section class="container-flex" style="padding-bottom:40px;">  
            <div class="fbasis50 moyenne-box-padd" style="background-color:#927879;">
                <h1 class="moyenne" style="padding-bottom:60px;">Moyennes du dernier mois </h1>

                <div class="container-flex" style="justify-content:space-around;">

                    <div>
                        <h1 class="slogan text-center"><?= $moisyenneS ?></h1>
                        <h2 class="moyenne text-center">DB</h2>
                    </div>

                    <div>
                    <h1 class="slogan text-center">70</h1>
                        <h2 class="moyenne text-center">pm 2.5</h2>
                    </div>

                    <div>
                    <h1 class="slogan text-center"><?= $moisyenneF ?></h1>
                        <h2 class="moyenne text-center">BPM</h2>
                    </div>

                </div>

            </div>
            
            <div class="fbasis50 moyenne-box-padd" style="background-color:#b69797;">
                <h1 class="moyenne" style="padding-bottom:60px;">Moyennes de l'année </h1>
                

                <div class="container-flex" style="justify-content:space-around;">

                    <div>
                        <h1 class="slogan text-center"><?= $YmoyenneS ?></h1>
                        <h2 class="moyenne text-center">DB</h2>
                    </div>

                    <div>
                    <h1 class="slogan text-center">70</h1>
                        <h2 class="moyenne text-center">pm 2.5</h2>
                    </div>

                    <div>
                    <h1 class="slogan text-center"><?= $YmoyenneF ?></h1>
                        <h2 class="moyenne text-center">BPM</h2>
                    </div>

                </div>
                
                
            </div>
        </section>









        <div class="padd_left" style="width:20%;padding-bottom:20px;float:right;text-align:right;padding-right:5%">
            <a href="page_statistiques.php" style="color: white;text-decoration: none;"><h1 class="titre">Détail des trajets</h1></a>
            <hr style="color: white;">
        </div>


        <!-- ------------------------------------------------------------ -->







    <!-- FOOTER -->

    <footer class="container_footer" style="clear: right">                
        <div style="padding-left: 5%;">
            <img src="images/images_footer/Marron/LogoMarron.png" width="65px"><br>

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
                    <img src="images/images_footer/Marron/insta-13.png" width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/images_footer/Marron/whatsapp.png" width="20px"><br>
                    <img src="images/images_footer/Marron/twitter.png" width="20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <img src="images/images_footer/Marron/mail.png" width="20px">
                </div>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/images_footer/Marron/facebook.png " width="20px">
            </div>
        </div>

    </footer>
        
                        
</body>