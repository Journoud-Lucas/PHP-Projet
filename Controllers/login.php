<?php
session_start();

require("../Models/model_login.php");
require("tbs_class.php");

$TBS = new clsTinyButStrong;
$id = new ID('login', 'password');
$message = "";
$cible = $_SERVER['PHP_SELF'];

if (isset($_POST["login"])) {
    if ($id->verif($_POST["login"], $_POST["passwd"])) {
        $_SESSION["login"] = $_POST["login"];
        $_SESSION["passwd"] = $_POST["passwd"];
        // Redirection vers la page modifyDatabase.php apr�s connexion r�ussie
        header("Location: modifyDatabase.php");
        exit; // Important pour �viter l'ex�cution de toute sortie apr�s redirection
    } else {
        $message = "Login ou mot de passe incorrect";
    }
    $TBS->LoadTemplate('../Views/message.html');
    $TBS->show();
} elseif (!isset($_SESSION["login"])) {
    $TBS->LoadTemplate('../Views/login.html');
    $TBS->show();
} else {
    header("Location: modifyDatabase.php"); // Redirection si la session est actuellement active
    exit;
}
?>