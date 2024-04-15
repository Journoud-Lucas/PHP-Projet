<?php // menu.php
//JOURNOUD Lucas / COSTA Julien
//Universit� Lumi�re Lyon 2
// Inclusion des fichiers n�cessaires
require("connect.inc.php"); // Inclut le script pour la connexion � la base de donn�es
require("tbs_class.php");   // Inclut la classe TinyButStrong pour la gestion des templates
require("../Models/model_menu.php"); // Inclut le mod�le de menu pour les interactions avec la base de donn�es

// Cr�ation d'une instance du moteur de template TinyButStrong
$tbs = new clsTinyButStrong;

// Tentative de connexion � la base de donn�es
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $etatConnexion = "Connexion OK"; // Message de succ�s de connexion

} catch (PDOException $erreur) {
    $etatConnexion = "Erreur : " . $erreur->getMessage(); // Gestion des erreurs de connexion
}

// Cr�ation d'une instance du mod�le pour les pizzas
$modele = new ModeleMenu($pdo);
$pizzas = $modele->GetAllMenu(); // Obtention de toutes les pizzas disponibles pour l'affichage
// Charger le template principal
$tbs->LoadTemplate("../Views/menu.html");
$tbs->MergeBlock('bloc', $pizzas); // Fusion du bloc de pizzas dans le template

// Charger le contenu du footer
$footer = file_get_contents('../Views/footer.html');

// Ajout du footer
$tbs->Source .= $footer;

// Affichage du template fusionn�
$tbs->Show();
?>