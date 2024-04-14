<?php // login.php
//JOURNOUD Lucas / COSTA Julien
//Université Lumière Lyon 2
// Démarrage de la session pour le maintien de la connexion utilisateur
session_start();

// Inclusion des fichiers nécessaires
require("../Models/model_login.php"); // Inclusion du modèle pour les fonctionnalités de connexion
require("tbs_class.php"); // Inclusion de la bibliothèque TinyButStrong pour la gestion des templates

// Création d'une instance de TinyButStrong pour la gestion de l'affichage
$TBS = new clsTinyButStrong;

// Chargement du template principal de connexion
$id = new ID('login', 'password');
$message = ""; // Initialisation du message d'erreur
$cible = $_SERVER['PHP_SELF']; // Utilisation de l'URL courante pour le formulaire

// Vérification de l'existence d'une requête POST pour le login
if (isset($_POST["login"])) {
    // Vérification des identifiants utilisateurs
    if ($id->verif($_POST["login"], $_POST["passwd"])) {
        // Stockage des informations de connexion dans la session
        $_SESSION["login"] = $_POST["login"];
        $_SESSION["passwd"] = $_POST["passwd"];
        // Redirection vers la page de gestion après une connexion réussie
        header("Location: manage_menu.php");
        exit;
    } else {
        // Message d'erreur si les identifiants sont incorrects
        $message = "Login ou mot de passe incorrect";
    }
    // Chargement et affichage du template de message d'erreur
    $TBS->LoadTemplate('../Views/message.html');
    $TBS->show(); // Affichage du résultat final
} elseif (!isset($_SESSION["login"])) { // Si l'utilisateur n'est pas déjà connecté
    // Chargement du template de login pour la connexion
    $TBS->LoadTemplate('../Views/login.html');
    $TBS->show(); // Affichage du formulaire de connexion
} else {
    // Redirection vers la page de gestion si l'utilisateur est déjà connecté
    header("Location: manage_menu.php");
    exit;
}
?>