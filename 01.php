<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP harjutused</title>
</head>
<body>

<h1>Harjutus 05</h1>

<?php
    $p = 20;
    switch ($p) {
        case ($p > 10):
            echo "SUPER!";
            break;
        case ($p>=5 && $p<=9):
            echo "TEHTUD!";
            break;
        case ($p<5):
                echo "KASIN!";
            break;        
        default:
            echo "Punkte pole lisatud";
            break;
    }

?>








    <h1>Harjutused 04</h1>

    <form action="" method="GET">
        Lisa sünniaasta <input type="number"name="synd" min="1900" max="2100" placeholder="2000">
         <input type="submit" value="Leia juubel"><br>
    </form>

<?php
        if (!empty($_GET['synd'])) {
            $aasta = $_GET['synd'];
            $seeAasta = date('Y');
            $vanus = $seeAasta - $aasta;
            if ($vanus % 5 == 0) {
                echo "Sul on juubel!";
            } else {
                    echo "Sul ei ole juubel!";
                }
            }
?>




<br>

    <?php
        $nr1 = 10;
        $nr2 = 1;
        // < > >= <= == 1= TRUE OR FALSE    
        // OR - VÕI || - üks õige
        // AND - NING && -  mõlemad õiged

        if ($nr2 !=0 && $nr1 != 0) {
            $tehe = $nr1 / $nr2;
            echo $tehe;

        } else {
            echo "Nulliga ei saa jagada";
        }

?>



<h1>Harjutused 03</h1>

<!--
    action - fail kuhu saadetakse
    method - kuidas saadetakse, GET on avalik, POST on peidetud

--> 
   <form action="" method="GET">
    Toode 1: <input type="number" name="Toode1"><br>

    Toode 2: <input type="number" name="Toode2"><br>

    Toode 3: <input type="number" name="Toode3"><br>

        <input type="submit" value="Arvuta">
   </form>
   <?php
        //GETiga saatsin, GETiga võtan
        if (!empty($_GET["Toode1"]) && 
        !empty($_GET["Toode2"]) &&
        !empty($_GET["Toode3"])) {

        $t1 = $_GET["Toode1"];
        $t2 = $_GET["Toode2"];
        $t3 = $_GET["Toode3"];
        $kokku = $t1+$t2+$t3;
        

        echo "Toode 1: $t1 tk <br>";
        echo "Toode 2: $t2 tk <br>";
        echo "Toode 3: $t3 tk <br>";
        echo "Kõik kokku: $kokku tk"; 
    } else {
        echo "Kastid on tühjad";
    }


   ?>



<h1>Harjutused 02</h1>

<?php

    $arv1 = 5;   //int    
    $arv2 = 3.14; //float
    $tehe = $arv1 / $arv2; 
    $jaak = $arv1 % $arv2; //jääk


    echo "Vastus: $tehe<br>";
    printf("Vastus:  %d / %0.2f = %0.2f", $arv1, $arv2, $tehe);
    echo "<br>Jääk: $jaak";

?>
















    <h1>Harjutused 01</h1>

    <?php
        /*

        Harjutus 01
        8.2.24
        Lihtsalt harjutan

        */

        $enimi = "Mario";
        $pnimi = "Metshein";
        $vanus = 43;
        $pikkus = 1.8;
        // $enimi = "Maarja";
        $hyydnimi = "THE BOSS";
        $lugu = 'Dr. Alban - "It\'s My Life"';


        
        echo "<p>Tere $enimi \"$hyydnimi\" $pnimi!<br>";
        echo "Vanus: $vanus<br>Pikkus: $pikkus</p>";
        echo '<p>Lemmik lugu on: '.$lugu."</p>"; // punkt on kokkuliitmiseks
        
     ?>

</body>
</html>