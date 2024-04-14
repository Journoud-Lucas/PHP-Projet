<?php // login.php
//JOURNOUD Lucas / COSTA Julien
//Universit� Lumi�re Lyon 2
// D�marrage de la session pour le maintien de la connexion utilisateur
session_start();

// Inclusion des fichiers n�cessaires
require("../Models/model_login.php"); // Inclusion du mod�le pour les fonctionnalit�s de connexion
require("tbs_class.php"); // Inclusion de la biblioth�que TinyButStrong pour la gestion des templates

// Cr�ation d'une instance de TinyButStrong pour la gestion de l'affichage
$TBS = new clsTinyButStrong;

// Chargement du template principal de connexion
$id = new ID('login', 'password');
$message = ""; // Initialisation du message d'erreur
$cible = $_SERVER['PHP_SELF']; // Utilisation de l'URL courante pour le formulaire

// V�rification de l'existence d'une requ�te POST pour le login
if (isset($_POST["login"])) {
    // V�rification des identifiants utilisateurs
    if ($id->verif($_POST["login"], $_POST["passwd"])) {
        // Stockage des informations de connexion dans la session
        $_SESSION["login"] = $_POST["login"];
        $_SESSION["passwd"] = $_POST["passwd"];
        // Redirection vers la page de gestion apr�s une connexion r�ussie
        header("Location: manage_menu.php");
        exit;
    } else {
        // Message d'erreur si les identifiants sont incorrects
        $message = "Login ou mot de passe incorrect";
    }
    // Chargement et affichage du template de message d'erreur
    $TBS->LoadTemplate('../Views/message.html');
    $TBS->show(); // Affichage du r�sultat final
} elseif (!isset($_SESSION["login"])) { // Si l'utilisateur n'est pas d�j� connect�
    // Chargement du template de login pour la connexion
    $TBS->LoadTemplate('../Views/login.html');
    $TBS->show(); // Affichage du formulaire de connexion
} else {
    // Redirection vers la page de gestion si l'utilisateur est d�j� connect�
    header("Location: manage_menu.php");
    exit;
}
?>