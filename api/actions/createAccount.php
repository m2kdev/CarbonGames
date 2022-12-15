<?php
session_start();
header('Content-Type: application/json');
include_once '..\config\DataBase.php';
$json = json_decode(file_get_contents('php://input'), true);
if(isset($_POST['username']) && isset($_POST['password'])) {
    $json = $_POST;
};
$result = [];

if (isset($json['username']) and isset($json['password']) and isset($json['mail']) and isset($json['date'])){
    $username = htmlspecialchars($json["username"]);
    $password = htmlspecialchars($json["password"]);
    $mail = htmlspecialchars($json["mail"]);
    $date = htmlspecialchars($json["date"]);
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    if ($username == "" or $password = "") {
        $result["success"] = false;
        $result["error"] = "Le mot de passe et/ou le nom d'utilisateur est vide";
    } else  {
        $checkIfUsernameExists = $bdd->prepare('SELECT * FROM users WHERE username = ?');
        $checkIfUsernameExists->execute(array($username));

        if ($checkIfUsernameExists->rowCount() > 0) {
            $result["success"] = false;
            $result['error'] = "Cet identifiant existe déja";
        } else {
            try {
                $createAccount = $bdd->prepare("INSERT INTO `users` (`id`,`username`,`userPassword`, `mail`,`birth`) VALUES (NULL, ?, ?, ?, ?);");
                $createAccount->execute(array($username, $passwordHashed, $mail, $date));
                $result["success"] = true;
            } catch (Exception $e) {
                $result["success"] = false;
                $result["error"] = "erreur lors de la création du compte...";
            }
        }
    }
} else {
    $result["success"] = false;
    $result["error"] = "Veuillez completez tous les champs...";
}
if($result['success']) {
    $_SESSION['created']=true;
    header('location:  ..\..\ledeepcoin\login\login.php');
} else{
    $_SESSION['result'] = $result;
    header('location:  ..\..\ledeepcoin\login\register.php');
};
echo json_encode($result);
?>