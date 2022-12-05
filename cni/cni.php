<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="css/cni.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php
            $fp = fopen ( "cni.csv" , "r" );
            while (( $data = fgetcsv ( $fp , 1000 , ";" )) !== FALSE ) {
                $profilearray[] = $data;
            }
            $fileLines=file("cni.csv");
            $line=count($fileLines)-1;
            $user = $profilearray[$line];
            if ($user[0]==='m') {
                echo "<p class=sexe>Homme</p>";
            }
            else {
                echo "<p class=sexe>Femme</p>";
            };
            echo "<p class='no'>";
            echo $user[7];
            echo "</p>";
            echo "<img class=photo src=\"";
            echo $user[2];
            echo "\">";
            echo "<p class='dob'>";
            echo $user[1];
            echo "</p>";
            echo "<p class='ville'>";
            echo $user[3];
            echo "</p>";
            echo "<p class='taille'>";
            echo $user[4];
            echo "</p>";
            echo "<p class='nom'>";
            echo $user[5];
            echo "</p>"; 
            echo "<p class='prenom'>";
            echo $user[6];
            echo "</p>"; 
            echo "<p class='signature'>";
            echo $user[6];
            echo "</p>";
            echo "<p class='idf'> IDFRA";
            echo $user[5];
            echo "</p>"; 
            echo "<p class='fin'>";
            echo $user[7];
            echo $user[6];
            echo "</p>";   
            fclose ( $fp );

            ?>
    </body>
</html>
