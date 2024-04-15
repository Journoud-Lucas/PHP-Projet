<?php // menu.php
//JOURNOUD Lucas / COSTA Julien
//Université Lumière Lyon 2
// Inclusion des fichiers nécessaires
require("connect.inc.php"); // Inclut le script pour la connexion à la base de données
require("tbs_class.php");   // Inclut la classe TinyButStrong pour la gestion des templates
require("../Models/model_menu.php"); // Inclut le modèle de menu pour les interactions avec la base de données

// Création d'une instance du moteur de template TinyButStrong
$tbs = new clsTinyButStrong;

// Tentative de connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $etatConnexion = "Connexion OK"; // Message de succès de connexion

} catch (PDOException $erreur) {
    $etatConnexion = "Erreur : " . $erreur->getMessage(); // Gestion des erreurs de connexion
}

// Création d'une instance du modèle pour les pizzas
$modele = new ModeleMenu($pdo);
$pizzas = $modele->GetAllMenu(); // Obtention de toutes les pizzas disponibles pour l'affichage
// Charger le template principal
$tbs->LoadTemplate("../Views/menu.html");
$tbs->MergeBlock('bloc', $pizzas); // Fusion du bloc de pizzas dans le template

// Charger le contenu du footer
$footer = file_get_contents('../Views/footer.html');

// Ajout du footer
$tbs->Source .= $footer;

// Affichage du template fusionné
$tbs->Show();
?>