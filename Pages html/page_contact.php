<?php session_start(); 

if (empty($_SESSION['id'])){
    header('Location: page_accueil_visiteur.php');
}
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Cyclean - Contact</title>
        <link rel="stylesheet" href="style_page_accueil.css?v=<?php echo time(); ?>">

        <!-- Importation du fichier header-->
        <script src="jquery.js"></script>
        <script> 
        $(function(){
            $("#header").load("contenu/header.php"); 
        });
        </script> 
    </head>


    <body style="background-color:#B2BDCC;">
        <?php include 'database.php';
            global $db;
        ?>


        <header id="header" class="gris"></header>

        <form method="post" style="width:500px;margin-left:auto;margin-right:auto">
            <h2 style="text-align:center;">Contacter les administrateurs par courriel</h3>

            <hr style="color:white;">

            <h3>Objet</h3>
            <input type="text" id="objet" name="objet" style="width:100%;background-color:#B2BDCC;margin-bottom:10px;color:white;border: solid 1px white;" required>

            <h3>Message</h3>
            <textarea style="resize:none;width:100%;height:250px;background-color:#B2BDCC;margin-bottom:30px;color:white;border: solid 1px white;" id="contenu" name="contenu" required></textarea>

            <input type="submit" name="contact_post" id="contact_post">

        </form>

        <?php
        if(isset($_POST['contact_post'])){
            extract($_POST);
                $contenu = str_replace("\n.", "\n..", $contenu);
                // $contenu = wordwrap($contenu, 70, "\r\n");

                mail('cyclean@outlook.fr', $_SESSION['pseudo'].' - '.$objet, $contenu);
                mail('ad.cyclean@gmail.com', $_SESSION['pseudo'].' - '.$objet, $contenu);


        }
        ?>


    </body>