<?php session_start(); 

if (empty($_SESSION['id'])){
    header('Location: page_accueil_visiteur.php');
}
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Détail des Trajets</title>
        <link rel="stylesheet" href="style_page_statistiques.css?v=<?php echo time(); ?>">

        <!-- Importation du fichier header-->
        <script src="jquery.js"></script>
        <script> 
            $(function(){
                $("#header").load("contenu/header.php"); 
            });
            
        </script> 
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body>

        <?php include 'database.php';
            global $db;
            
            // Récupère l'id du lien
            $id_actuel=$_GET['id'];

            $q = $db ->prepare("SELECT pseudo,Nom,prenom,Extension,Apropos FROM utilisateurs WHERE id = ?");
            $q ->execute([$id_actuel]);
            $information_utilisateur = $q->fetch();


            // Fonction qui a un objet de type Array en PHP renvoie une liste JAVASCRIPT
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
                }

                
                function StatsDuTrajet($Array,$NumTrajet,$capteur){
                    $ReturnedArray=[];

                    foreach ($Array as $value) {
                        
                        if ($value[0]==$NumTrajet and $value[1]==$capteur){
                            array_push($ReturnedArray, array($value[2],$value[3]));
                        }
                    }

                    return $ReturnedArray;
                }

            

            // Si l'utilisateur existe, execute la requete dans la BDD.
            if($information_utilisateur){   



                // Récupère le numéro du dernier trajet de l'utilisateur
                    $q = $db->prepare("SELECT MAX(NumSerie) FROM mesures WHERE Id = :Id");

                    $q -> execute(['Id' => $id_actuel]);

                    $dernierTrajetArray = $q->fetch(); // Convertit le résultat en un tableau et le paramètre PDO enlève les doublons 
                    $dernierTrajet = $dernierTrajetArray[0];


                

                // Récupère les données de tous les trajets
                    $q = $db->prepare("SELECT NumSerie,TypeCapteur,ValeurMesure,DateMesure FROM mesures WHERE Id = ?");

                    $q -> execute([$id_actuel]);

                    $DataArray = $q->fetchAll(); // Convertit le résultat en un tableau et le paramètre PDO enlève les doublons 
            }
        ?>

















        <header id="header"></header>

        <?php 
        // Si le comtpe existe:
        if($information_utilisateur){ 
            ?>

            <section style="float:right;text-align:right;padding-right:8%;width:60%;">



                <h1 class="slogan"><?php 
                    if ($id_actuel==$_SESSION['id']){
                        echo "Vos trajets";
                    }
                    else{
                        echo "Trajets de ".$information_utilisateur[0];
                    }
                    ?></h1>
                
                <hr class="cyclean-trait" style="margin-bottom:60px;float:right;">
            </section>



            
            <section style="clear: right;margin: 7.9% 7.9% 0%;padding-bottom:100px;">

                <?php 
                    if (!$dernierTrajet){?>

                    <h2 class="titre2" style="text-align:center;">Aucune activité récente</h2>

                <?php 
                    }



                for ($i = $dernierTrajet; $i >=1 ; $i--){
                        $DataArrayFreqC = StatsDuTrajet($DataArray,$i,'FrequenceC');

                        $DataArrayFreqCMesure = [];
                        $DataArrayFreqCDate = [];
                        
                        foreach($DataArrayFreqC as $value){
                            array_push($DataArrayFreqCMesure, $value[0]);
                            array_push($DataArrayFreqCDate, $value[1]);
                        }




                        $DataArraySonore = StatsDuTrajet($DataArray,$i,'Sonore');

                        $DataArraySMesure = [];
                        $DataArraySDate = [];
                        
                        foreach($DataArraySonore as $value){
                            array_push($DataArraySMesure, $value[0]);
                            array_push($DataArraySDate,$value[1]);
                        }
                            ?>


                    <div class="padd_inside arrondi" id="main_container<?=$i?>" style="background-color:#927879;" onclick="call('<?=$i?>','container<?=$i?>','image<?=$i?>','textF<?=$i?>','textS<?=$i?>')">
                        <div class="container-flex space v_center_align">
                            <h1 class="titre" style="user-select: none;">Trajet du <?=substr($DataArrayFreqCDate[0], 0, -9);?></h1>

                            <img id="image<?=$i?>" class="imgflip_right" src="images/fleche2.png" width="40px">
                        </div>

                        <div id="container<?=$i?>" style="padding-bottom:200px;display:none;text-align:center;">


                            <div class="graph"><canvas id="ChartF<?=$i?>" ></canvas></div>
                            <h1 id="textF<?=$i?>" class="slogan v_center_align">Fréquence Cardiaque</h1>

                            <script>

                                const labelsF<?=$i?> = <?= ArrayToJavascript($DataArrayFreqCDate);?>; // Transforme l'array php en array javascript
                                
                                const dataF<?=$i?> = {
                                labels: labelsF<?=$i?>,
                                datasets: [{
                                    label: 'Fréquence cardiaque (BPM) en fonction du "temps"',
                                    backgroundColor: 'rgb(158, 133, 133)',
                                    borderColor: 'rgb(158, 133, 133)',
                                    data: <?=ArrayToJavascript($DataArrayFreqCMesure)?>, // Données sur les mesures du dernier trajet
                                }]
                                };

                                const configF<?=$i?> = {
                                    type: 'line',
                                    data: dataF<?=$i?>,
                                    options: {}
                                };

                                const ChartF<?=$i?> = new Chart(
                                    document.getElementById('ChartF<?=$i?>'),
                                    configF<?=$i?>
                                );

                            </script>



                            
                            <div class="graph"><canvas id="ChartS<?=$i?>"></canvas></div>

                                <h1 id="textS<?=$i?>" class="slogan v_center_align">Intensité Sonore</h1>

                                <script>

                                    const labelsS<?=$i?> = <?= ArrayToJavascript($DataArraySDate);?>; // Transforme l'array php en array javascript
                                    
                                    const dataS<?=$i?> = {
                                    labels: labelsS<?=$i?>,
                                    datasets: [{
                                        label: 'Intensité sonore (DB) en fonction du "temps"',
                                        backgroundColor: 'rgb(158, 133, 133)',
                                        borderColor: 'rgb(158, 133, 133)',
                                        data: <?=ArrayToJavascript($DataArraySMesure)?>, // Données sur les mesures du dernier trajet
                                    }]
                                    };

                                    const configS<?=$i?> = {
                                        type: 'line',
                                        data: dataS<?=$i?>,
                                        options: {}
                                    };

                                    const ChartS<?=$i?> = new Chart(
                                        document.getElementById('ChartS<?=$i?>'),
                                        configS<?=$i?>
                                    );

                                </script>



                        </div>
                    </div>

                    <script>
                        // Change la couleur de fond des blocs une fois sur deux. 
                        var x = document.getElementById("main_container<?=$i?>");

                        if (<?=$i?>%2==0){
                            x.style.backgroundColor="#927879";
                        }
                        else{
                            x.style.backgroundColor="#b69797";
                        }

                    </script>   

                    <script>
                        // SCRIPT AFIN DE FAIRE DEROULER LES STATS POUR CHAQUE TRAJET DIFFERENT (EN PARAMETRE) avec comme paramètre:
                        // Le numéro de div, l'id du container et l'id de l'image de la flèche correspondant.
                        
                        var open = new Array(<?=$dernierTrajet?>).fill(false);

                        var call = function(Number,elementId,ImageId,TextId1,TextId2)
                        {
                            var x = document.getElementById(elementId);
                            var y = document.getElementById(ImageId);

                            var z = document.getElementById(TextId1);
                            var t = document.getElementById(TextId2);
                            var num = Number;


                            if (x.style.display === "none") {
                                x.style.display = "block";

                            } else {
                                x.style.display = "none";
                            }

                            // Si on ferme la balise
                            if(open[num]){
                                y.className = 'imgflip_right';  

                                z.style.marginBottom = "0px";
                                t.style.marginBottom = "0px";
                            } 

                            // Si on ouvre la balise
                            else{
                                y.className = 'imgflip_down';

                                // Ajoute des marges en dessous des textes pour espacer

                                z.style.marginBottom = "400px";
                                t.style.marginBottom = "400px";
                                

                            }

                            open[num] = !open[num];

                        }
                    </script>

                <?php
                }
                ?>


                
            </section>
        <?php }

        else{?>
        <h1 class="slogan" style="text-align:center;">
            <?php
            echo "L'utilisateur recherché n'existe pas";

        }
        ?>
        </h1>



















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