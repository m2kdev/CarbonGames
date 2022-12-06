<?php

header('Content-Type: application/json');
include_once '..\config\DataBase.php';
$json = json_decode(file_get_contents('php://input'), true);

if (isset($json['username']) and isset($json['password'])){
    $username = htmlspecialchars($json["username"]);
    $password = htmlspecialchars($json["password"]);

    $getUser = $bdd->prepare("SELECT * FROM users WHERE username = ?");
    $getUser->execute(array($username));

    if ($getUser->rowCount() > 0) {
        $user = $getUser->fetch();

        if (password_verify($password, $user['userPassword'])) {
            $result["success"] = true;
        } else {
            $result["success"] = false;
            $result["error"] = "Mot de passe Incorrect";
        }
    } else {
        $result["success"] = false;
        $result["error"] = "Utilisateur introuvable";
    }

} else {
    $result["success"] = false;
   $result["error"] = "Veuillez completez tous les champs...";
}

echo json_encode($result);