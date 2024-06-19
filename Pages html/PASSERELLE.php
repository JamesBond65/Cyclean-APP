<?php

include_once 'database.php';
global $db;



$m = "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=G2E1";
echo $m;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$m);


curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($ch);
curl_close($ch);
echo "Raw Data:<br />";
echo("$data");

$data_tab = str_split($data,33);
echo "Tabular Data:<br />";
for($i=0, $size=count($data_tab); $i<$size; $i++){
echo "Trame $i: $data_tab[$i]<br />";
}

//$trame = $data_tab[1];

foreach($data_tab as $trame){
        
    // décodage avec des substring
    $t = substr($trame,0,1);
    $o = substr($trame,1,4);
    // ...
    // décodage avec sscanf


    //Trame 1: 199991301198600491220210622132019 
    //Devient: 1,9999,1,3,01,1986,0049,12,2021,06,22,13,20,19

    //Sachant: type de trame 1,numéro de l'objet 9999,type de requête 1,type de capteur 3,numéro du capteur 01,
    //         la valeur remontée 1986,numéro de la trame 0049,checksum 12,année 2021, mois 06, jour 22,heure 13,minute 20, seconde 19

    list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) = sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
    echo("<br />$t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec<br />");

    


    $datetime = $year."-".$month."-".$day." ".$hour.":".$min.":".$sec;

    echo $datetime." et valeur : ".intval($v);



    $q = $db->prepare("INSERT INTO mesures(Id,NumSerie,TypeCapteur,DateMesure,ValeurMesure) VALUES(:Id,:numSerie,:typeCapteur,:dateTime,:valeur)");

    // compte test, identifiants : JS et jeansucre
    $q->execute([
    'Id' => 114 ,
    'numSerie' => 1 ,
    'typeCapteur'=> 'Gaz' ,
    'dateTime'=> $datetime,
    'valeur' => intval($v), 
    ]);
}
?>