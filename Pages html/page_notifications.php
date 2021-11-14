<?php session_start(); ?>
<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Notifications</title>

        <!-- Importation du fichier header-->
        <script src="jquery.js"></script>
        <script> 
            $(function(){
                $("#header").load("contenu/header.html"); 
            });
        </script> 

        <link rel="stylesheet" href="style_page_notifications.css?v=<?php echo time(); ?>">

    </head>


    
    <body>
        <header>
            <header id="header" class="gris"></header>
            <h1 class="slogan_titre" style="margin-top: -75px;">Notifications </h1>
        </header>



        <section class="margin_total gris padding_total" >

                    
            <?php include 'database.php';
            global $db;
            
            $q = $db->prepare("SELECT * FROM demandesamis WHERE IdReceveur = :IdReceveur");

            $q -> execute(['IdReceveur' => $_SESSION['id']]);

            $resultat = $q->fetchAll(PDO::FETCH_ASSOC); //Convertit le résultat en un tableau et le paramètre PDO enlève les doublons 


            $liste_id = [];
            for($i = 0, $size = count($resultat); $i < $size; ++$i) {
                $ligne = $resultat[$i];

                // Remplit la liste des id de personnes qui te demandent en ami.
                array_push($liste_id,$ligne['IdDemandeur']);

                 
            }
            // print_r($liste_id);
            ?> 
            <!-- sont les demande d'amis <br> -->


            <h1 class="slogan" style="margin-top: 0.5%;padding-top: 2%;">Demandes d'amis:</h1>
            <hr class="separation">



            <?php

            for($i = 0, $size = count($liste_id); $i < $size; ++$i){
                ?>


                <div class="container-flex space box">
                    <img src="images/Deepfake.jpg" width="105px" style="border-radius: 5px;">
                    
                    <p style="align-items: center;">
                    <?php      
                    
                    $q1 = $db->prepare("SELECT pseudo FROM utilisateurs WHERE id = :id");

                    $q1 -> execute(['id' => $liste_id[$i]]);
        
                    $resultat_id = $q1->fetch(); //Convertit le résultat en un tableau

                    $pseudo_demandeur = $resultat_id[0];
                    echo $pseudo_demandeur;
                    
                    ?></p>

                    <!-- On fait comme ça pour l'instant -->

                    <form method="post">
                        <div>
                            <input type="radio" id="choix1" name="choix" value="accepter" checked>
                            <label for="choix1">Accepter</label>
                        </div>

                        <div>
                            <input type="radio" id="choix2" name="choix" value="refuser">
                            <label for="choix2">Refuser</label>
                        </div>
                        <input type="submit" name="choix_ami<?= $i ?>" id="choix_ami<?= $i ?>" value="confirmer">
                    </form>

                    <?php 
                    if(isset($_POST['choix_ami'.$i])){
                        extract ($_POST);
                        
                        // echo (implode(",", $_POST));
                        print_r($_POST);

                        if ($choix == 'accepter'){
                            $q4 = $db->prepare("INSERT INTO amis(Id,IdAmi) VALUES(:Id,:IdAmi)");
                            
                            $q4->execute([
                                'Id'=> $liste_id[$i],
                                'IdAmi'=> $_SESSION['id'],
                            ]);



                        }

                        // Supprime la demande de la base de données
                        $q3 = $db->prepare("DELETE FROM demandesamis WHERE IdDemandeur = :id");

                        $q3 -> execute(['id' => $liste_id[$i]]);

                        header("Refresh:0");

                    }
                    ?>



                </div>

                <?php
            } ?>



            

        </section>
        <!-- On pourrait aussi ajouter une section "mentions j'aime" -->
    </body>

</html>