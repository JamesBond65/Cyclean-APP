<?php session_start(); 

$_SESSION['creation_compte'] = "" ; 
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8" />    
    </head>

<body>
    
<?php
include 'database.php';
global $db;
?>


<h1>Test</h1>

    <form  method="post">
        <input type="search" name="pseudo" id="pseudo" placeholder="Pseudo" required><br>
        <input type="submit" name="formsend" value="entrer">
    </form>

<?php 
    if(isset($_POST['formsend'])){
        extract($_POST);

<<<<<<< HEAD
        $q = $db ->prepare("SELECT pseudo FROM utilisateurs WHERE pseudo LIKE ?");
        $q -> execute(["%$pseudo%"]);
        $resultat = $q ->fetchAll();

        if($resultat){
            foreach ($resultat as $pseudo_trouve){
                echo $pseudo_trouve[0];?><br><?php
            }
        }

        else{
            echo "le compte recherché n'existe pas";

        }
    }

?>   
=======
        $q = $db ->prepare("SELECT pseudo FROM utilisateurs WHERE pseudo = :pseudo ");

        $q -> execute(['pseudo'=> $pseudo]);
        $resultat = $q ->fetch();

        if($resultat){
            echo $resultat;
        }
        
        else{
            echo"le compte rechercher n'existe pas";

        }
    }
                
?>       
>>>>>>> 5251a5019dc4efa9272be310bb1c495159b9b1d3
</body>
</html>