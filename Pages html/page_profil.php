<?php session_start(); 

if (empty($_SESSION['id'])){
    header('Location: page_accueil_visiteur.php');
}
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Profil</title>
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

            function CountRange($start,$end,$array){
                //  Renvoie le nombre d'élement de la liste array compris entre les deux bornes start et end
                $count = 0;
                foreach($array as $element){
                    if ($start<$element && $element<$end){
                        ++$count;
                    }
                }
                return $count;
            }









            // CHOPE L'ID du lien et recupère les infos du compte en question.
            $id_actuel=$_GET['id'];
            $q = $db ->prepare("SELECT pseudo,Nom,prenom,Extension,Apropos,Compte FROM utilisateurs WHERE id = ?");
            $q ->execute([$id_actuel]);
            $information_utilisateur = $q->fetch();


            // Si l'utilisateur existe, execute la requete dans la BDD.
            if($information_utilisateur){

                




                    // servira à vérifier si on est amis avec la personne concernée plus tard
                    $q = $db->prepare("SELECT * FROM amis WHERE Id = ? AND IdAmi = ? ");
                    $q->execute([$id_actuel,$_SESSION['id']]);
                    $amis = $q->fetch();



                    // Récupère le numéro du dernier trajet de l'utilisateur
                    $q = $db->prepare("SELECT MAX(NumSerie) FROM mesures WHERE Id = :Id");
                    $q -> execute(['Id' => $id_actuel]);

                    $dernierTrajetArray = $q->fetch(); // Convertit le résultat en un tableau et le paramètre PDO enlève les doublons 
                    $dernierTrajet = $dernierTrajetArray[0];
                    global $dernierTrajet;

                    // Si on a fait un trajet auparavant
                    if($dernierTrajet!=null){
                    
                        // Récupère Mesures FREQUENCIELLES du dernier trajet
                        $q_DTrajetF = $db->prepare("SELECT ValeurMesure from mesures WHERE Id = :id AND TypeCapteur = :capteur AND NumSerie = :numderniertrajet");
                        $q_DTrajetF -> execute(['id' => $id_actuel,'capteur' => 'FrequenceC', 'numderniertrajet' => $dernierTrajet]);
                        
                        $DTrajetFArray = $q_DTrajetF->fetchAll();

                        $DTrajetF = $DTrajetFArray[0];


                        // Création Liste contenant uniquement les données
                        $DataDTrajetFArray = [];

                        for($i = 0; $i < count($DTrajetFArray); $i++){
                            array_push($DataDTrajetFArray, $DTrajetFArray[$i][0]);
                        }

                        $DataDTrajetFArray = array_filter($DataDTrajetFArray);            


                    
                        // Calcul de la moyenne de cette liste de données
                        $moyenneFreqc = array_sum($DataDTrajetFArray)/count($DataDTrajetFArray);
                        $moyenneFreqc =ceil($moyenneFreqc);














                        // Récupère Mesures SONORES fréquence du dernier trajet
                        $q_DTrajetS = $db->prepare("SELECT ValeurMesure from mesures WHERE Id = :id AND TypeCapteur = :capteur AND NumSerie = :numderniertrajet");
                        $q_DTrajetS -> execute(['id' => $id_actuel,'capteur' => 'Sonore', 'numderniertrajet' => $dernierTrajet]);
                        
                        $DTrajetSArray = $q_DTrajetS->fetchAll();
                        $DTrajetS = $DTrajetSArray[0];






                        // Création Liste contenant uniquement les données concernées
                        $DataDTrajetSArray = [];
                        for($i = 0; $i < count($DTrajetSArray); $i++){
                            array_push($DataDTrajetSArray, $DTrajetSArray[$i][0]);
                        }

                        $DataDTrajetSArray = array_filter($DataDTrajetSArray);                



                        // Calcul de la moyenne de cette liste de données
                        $moyenneS = array_sum($DataDTrajetSArray)/count($DataDTrajetSArray);
                        $moyenneS = ceil($moyenneS);









                        // Récupère mesures de concentration de CO₂ du dernier trajet
                        $q_DTrajetG = $db->prepare("SELECT ValeurMesure from mesures WHERE Id = :id AND TypeCapteur = :capteur AND NumSerie = :numderniertrajet");
                        $q_DTrajetG -> execute(['id' => $id_actuel,'capteur' => 'Gaz', 'numderniertrajet' => $dernierTrajet]);
                        
                        $DTrajetGArray = $q_DTrajetG->fetchAll();
                        $DTrajetG = $DTrajetGArray[0];






                        // Création Liste contenant uniquement les données concernées
                        $DataDTrajetGArray = [];
                        for($i = 0; $i < count($DTrajetSArray); $i++){
                            array_push($DataDTrajetGArray, $DTrajetGArray[$i][0]);
                        }

                        $DataDTrajetGArray = array_filter($DataDTrajetGArray);                


                        // Calcul de la moyenne de cette liste de données
                        $moyenneG = array_sum($DataDTrajetGArray)/count($DataDTrajetGArray);
                        $moyenneG = ceil($moyenneG);

                    













                    

                        // Recherche des MOYENNES DU MOIS

                        // On commence par définir le mois précédent
                        $endDate = date('Y-m-d H:i:s');

                        $startDate = date("Y-m-d H:i:s",strtotime("-1 month"));




                        // Moyenne en fréquence cardiaque
                        $q_moisyenneF = $db->prepare("SELECT ROUND(AVG(ValeurMesure),0) FROM mesures WHERE Id = ? AND TypeCapteur = ? AND DateMesure BETWEEN ? AND ?");

                        $q_moisyenneF -> execute([$id_actuel,'FrequenceC',$startDate, $endDate]);


                        $moisyenneFArray = $q_moisyenneF->fetch(); //Convertit le résultat en une liste
                        $moisyenneF = $moisyenneFArray[0];


                    
                    
                        // Moyenne en fréquence sonore
                        $q_moisyenneS = $db->prepare("SELECT ROUND(AVG(ValeurMesure),0) FROM mesures WHERE Id = ? AND TypeCapteur = ? AND DateMesure BETWEEN ? AND ?");

                        $q_moisyenneS -> execute([$id_actuel,'Sonore',$startDate, $endDate]);


                        $moisyenneSArray = $q_moisyenneS->fetch(); //Convertit le résultat en une liste
                        $moisyenneS = $moisyenneSArray[0];



                        // Moyenne en concentration CO2
                        $q_moisyenneG = $db->prepare("SELECT ROUND(AVG(ValeurMesure),0) FROM mesures WHERE Id = ? AND TypeCapteur = ? AND DateMesure BETWEEN ? AND ?");

                        $q_moisyenneG -> execute([$id_actuel,'Gaz',$startDate, $endDate]);


                        $moisyenneGArray = $q_moisyenneG->fetch(); //Convertit le résultat en une liste
                        $moisyenneG = $moisyenneGArray[0];















                        // Recherche des moyennes de l'année

                        // On commence par définir l'année précédente
                        $endDateY = date('Y-m-d H:i:s');

                        $startDateY = date("Y-m-d H:i:s",strtotime("-1 year"));



                        // Moyenne de l'année en FREQUENCE CARDIAQUE
                        $q_YmoyenneF = $db->prepare("SELECT ROUND(AVG(ValeurMesure),0) FROM mesures WHERE Id = ? AND TypeCapteur = ? AND DateMesure BETWEEN ? AND ?");

                        $q_YmoyenneF -> execute([$id_actuel,'FrequenceC',$startDateY, $endDateY]);


                        $YmoyenneFArray = $q_YmoyenneF->fetch(); //Convertit le résultat en une liste
                        $YmoyenneF = $YmoyenneFArray[0];



                        // Moyenne de l'année en intensité SONORE
                        $q_YmoyenneS = $db->prepare("SELECT ROUND(AVG(ValeurMesure),0) FROM mesures WHERE Id = ? AND TypeCapteur = ? AND DateMesure BETWEEN ? AND ?");

                        $q_YmoyenneS -> execute([$id_actuel,'Sonore',$startDateY, $endDateY]);


                        $YmoyenneSArray = $q_YmoyenneS->fetch(); //Convertit le résultat en une liste
                        $YmoyenneS = $YmoyenneSArray[0];


                        // Moyenne de l'année en concentration de CO₂
                        $q_YmoyenneG = $db->prepare("SELECT ROUND(AVG(ValeurMesure),0) FROM mesures WHERE Id = ? AND TypeCapteur = ? AND DateMesure BETWEEN ? AND ?");

                        $q_YmoyenneG -> execute([$id_actuel,'Gaz',$startDateY, $endDateY]);


                        $YmoyenneGArray = $q_YmoyenneG->fetch(); //Convertit le résultat en une liste
                        $YmoyenneG = $YmoyenneGArray[0];







                    }
                }
                ?>


                <header id="header"></header>


                <?php             
                // Si l'utilisateur existe, continue et  affiche la page.
                if($information_utilisateur){?>

                    <section class="bloc_marron space"> 
                    
                        <h1 class="slogan_pourc padd_left">
                            <?php 
                            if($id_actuel==$_SESSION['id']){
                                echo "Mon profil";}
                            else{
                                echo "Profil de ".$information_utilisateur[0];
                            }
                                ?>
                            </h1>

                        
                        <img src="images/Stats.png" class="imgtop" style="margin-right:250px;margin-top:-130px;" width="600px">


                    </section>



                    <div class="trait" style="margin-bottom:200px;"></div>




                    <!-- LES STATS -->
                    <!-- ------------------------------------------------------------ -->


                    <section class="container-flex v_center_align" style="flex-basis:100%;justify-content:space-around;margin-bottom:150px;">

                        <img src="<?php require_once('photo_profil.php'); 
                        echo get_pdp($id_actuel,$information_utilisateur['Extension']);?>" class="Image_Profil1 vertical" style="margin-left:2%;">





                        <div class="text-center" style="justify-content:space-around;">
                            <div style="padding-bottom:80px;">
                                <h1 class="slogan_pourc"><?= $information_utilisateur['pseudo']?><br></h1>

                                <h2 class="titre2"><?= $information_utilisateur['prenom']?> <?= $information_utilisateur['Nom']?></h2>


                                <?php 
                                if($id_actuel!=$_SESSION['id']){
                                        if($_SESSION['utilisateur']=='Administrateur'){?>

                                            <form method="post" action="">
                                            <input type="submit" id="SupprimerCompte" name="SupprimerCompte" value="<?php echo "Supprimer le compte"?>" onclick="return confirm('Etes-vous sûr de vouloir supprimer le compte?')"/>
                                            </form>
                                        <?php
                                        if(isset($_POST['SupprimerCompte'])){
                                            $q = $db->prepare("DELETE from utilisateurs WHERE id = ?");
                                            $q->execute([$id_actuel]);        
                                        }    
                                    
                                    
                                    }




                                        if ($amis){
                                            echo '<h2 class="titre2">Vous êtes amis</h2>';
                                        }

                                        else{
                                            $q = $db->prepare("SELECT * FROM demandesamis WHERE IdReceveur = ? AND IdDemandeur = ? ");
                                            $q->execute([$id_actuel,$_SESSION['id']]);
                                            $existence_demande = $q->fetch();
                                            // Vérifie si on a déjà envoyé une demande d'amis à cette personne
                                            ?>
                                                                                                            <!-- corriger qui existe $pseudo_trouve["IdDemandeur"] -->
                                            <form method="post" action="">
                                                <input type="submit" id="addFriend" name="addFriend" value="<?php echo $existence_demande ?  "Supprimer la demande d'amis" : "Envoyer une demande d'amis" ;  ?>"/>
                                            </form>
        
                                            <?php 
                                            if (isset($_POST["addFriend"])) {
                                                // Si on a déjà envoyé une demande, la supprime
                                                if ($existence_demande){
                                                    $q = $db->prepare("DELETE FROM demandesamis WHERE IdDemandeur = ? AND IdReceveur = ?  ");
                                                    $q->execute([intval($_SESSION["id"]), intval($id_actuel)]);
                                                    echo "<meta http-equiv='refresh' content='0'>";
                                                    
                                                }
                                                // Si on a pas encore envoyé de demande, en envoie une.
                                                else{
                                                    $q = $db->prepare("INSERT INTO demandesamis (IdDemandeur, IdReceveur) VALUES (?, ?)");
                                                    $q->execute([intval($_SESSION["id"]), intval($id_actuel)]);
                                                    echo "<meta http-equiv='refresh' content='0'>";
                                                }
                                            }
                                        }

                                    
                                    }
                                ?>
                            
                            
                            </div>

                            <h2 class="titre2" style="margin:0;padding:0;">A Propos de moi:</h2>
                            <p style="text-align:center;margin:0;padding:0;" ><br>
                            <?php 
                                // Ajoute des retours à la ligne automatiques et nl2br ceux de base.
                                $newtext = wordwrap(nl2br($information_utilisateur['Apropos']), 60, "<br />\n",true);
                                echo $newtext;
                            ?></p>

                        </div>

                        


                    </section>

                    <hr class="cyclean-trait" style="margin-bottom:400px;">





















                    <h1 class="slogan_pourc" style="padding-bottom: 2.5%;padding-left: 3.2%;padding-right: 2%;">
                            Dernier Trajet<br>
                        </h1>
                    
                    <hr class="cyclean-trait" style="margin-bottom:50px;">


                    <?php 
                    if($dernierTrajet!=null && (($information_utilisateur['Compte']=="publique") || ( $information_utilisateur['Compte']=="prive" && ($amis || $id_actuel == $_SESSION['id'] || $_SESSION['utilisateur']=="Administrateur"))) ){?>


                        <section class="grid center" style="padding-bottom: 300px;"> 

                            <!-- Ligne 1 -->

                            <div class="graph">





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
                                    <h1 class="stats text-center" style="margin-right:10px;"><?= $moyenneS ?></h1> 
                                    <h1 class="slogan text-center" >db</h1>
                                </div>
                                
                                <h1 class="titre2 text-center">Durant votre dernier trajet,<br> vous avez subit <?= $moyenneS ?> db en moyenne.</h1>

                            </div>










                            <!-- Ligne 2 -->
                            
                            <div style="text-align:center;"> <!--v_center_align avant-->
   
                                <div class="container-flex v_center_align" style="justify-content:center;">
                                    <h1 class="stats text-center" style="margin-right:10px;"><?= $moyenneG ?></h1> 
                                    <h1 class="slogan text-center">ppm</h1>
                                </div>
                                <h1 class="titre2 text-center">Durant votre dernier trajet,<br> la concentration de CO₂ dans l'air était de <?= $moyenneG ?> ppm en moyenne<br></h1>
                            </div>
                            
                            <div class="vline margin-sides"></div>
                            <hr class="special-cyclean-trait">
                            
                            <div class="container-flex special-margin">


                                <!-- $DataDTrajetGArray -->

                                <div>
                                    <canvas id="myChartGaz" style="color:white;"></canvas>
                                    <script>
                                        
                                        
                                        const dataGaz = {
                                        labels: ['Bonne (<600 ppm)','Normale (600-1200 ppm)','Mauvaise (> 1200 ppm)'],
                                        datasets: [{
                                            label: "Répartition de la qualité de l'air",
                                            data: [<?= CountRange(0,600,$DataDTrajetGArray) ?>, <?= CountRange(601,1200,$DataDTrajetGArray) ?>, <?= CountRange(1201,9000,$DataDTrajetGArray) ?>],
                                            backgroundColor: [
                                            'rgb(146,193,146)',
                                            'rgb(54, 162, 235)',
                                            'rgb(255, 205, 86)'
                                            ],
                                            color: 'rgb(255, 0, 0)',
                                            
                                            borderColor: 'rgb(255, 255, 255)',
                                            hoverOffset: 4
                                        }]};

                                        const configGaz = {
                                            type: 'doughnut',
                                            data: dataGaz,
                                            scaleFontColor: "#FFFFFF",
                                            options: {
                                                
                                                plugins: {
                                                    title: {
                                                        display: true,
                                                        text: "Qualité de l'air lors du dernier trajet",
                                                        color: "#FFF"
                                                    },
                                                    label:{
                                                        color:"#FFF"
                                                    }
                                           
                                                }
                                            }

                                        };

            
                                        
                                        const myChartGaz = new Chart(document.getElementById('myChartGaz'),configGaz);
                                    </script>
                                </div>


                            </div>


                            











                            <!-- Ligne 3 -->
                            <div class="graph">
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

                                    <div class="container-flex  v_center_align"> <!--v_center_align avant-->
                                        <h1 class="stats text-center" style="margin-right:10px;"><?= $moyenneFreqc ?></h1> 
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
                                    <h1 class="slogan text-center"><?= $moisyenneG ?></h1>
                                        <h2 class="moyenne text-center">ppm</h2>
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
                                    <h1 class="slogan text-center"><?= $YmoyenneG ?></h1>
                                        <h2 class="moyenne text-center">ppm</h2>
                                    </div>

                                    <div>
                                    <h1 class="slogan text-center"><?= $YmoyenneF ?></h1>
                                        <h2 class="moyenne text-center">BPM</h2>
                                    </div>

                                </div>
                                
                                
                            </div>
                        </section>









                        <div class="padd_left" style="width:20%;padding-bottom:20px;float:right;text-align:right;padding-right:5%">
                            <a href="statistiques.php?id=<?= $id_actuel ?>" style="color: white;text-decoration: none;"><h1 class="titre">Détail des trajets</h1></a>
                            <hr style="color: white;">
                        </div>
                        
                    <?php } 

                    elseif ($information_utilisateur['Compte']=="prive" && !($amis || $id_actuel == $_SESSION['id'] || $_SESSION['utilisateur']=="Administrateur")){?>
                        <h2 class="titre2" style="text-align:center;">Ce compte est privé.</h2>

                    <?php }
                    else{?>
                        <h2 class="titre2" style="text-align:center;">Aucune activité récente.</h2>
                        
                        <?php }
                    ?>

                    <!-- ------------------------------------------------------------ -->

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