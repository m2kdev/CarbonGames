<?php
    $k = $_GET['MODE'];
    $s = $_POST['sexe'];
    if($k === "RN") {
        $fp = fopen("prenom.csv", 'r');
        while(($data = fgetcsv($fp, 1000, ";")) !== false) {
            $profilearray[] = $data;
        }
        do {
            $prenom = $profilearray[rand(1, 11626)];
        } while ($prenom[1] !== $s);
        $fp = fopen("patronymes.csv", 'r');
        while(($data = fgetcsv($fp, 1000, ";")) !== false) {
            $profilearraya[] = $data;
        }
        $nom = $profilearraya[rand(1, 879422)];
        fclose($fp);
        $list = array($_POST['sexe'],$_POST['date'],$_POST['photo'],$_POST['city'],$_POST['taille'],$nom[0],$prenom[0],rand(1000000000000,1000000000000000));
        $fp = fopen("cni.csv",'a+');
        fputcsv($fp,$list, ";");
        fclose($fp);
    }
    header('Location: cni.php');
?>