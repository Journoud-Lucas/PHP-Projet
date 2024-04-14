<?php // menu.php
require("connect.inc.php");
require("tbs_class.php");
require("../Models/model_menu.php");

// Moteur de template
$tbs = new clsTinyButStrong;

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $etatConnexion = "Connexion OK";

} catch (PDOException $erreur) {
    $etatConnexion = "Erreur : " . $erreur->getMessage();
}

$modele = new ModelePizza($pdo);
$pizzas = $modele->obtenirPizzas();

// Chargement et préparation du template
$tbs->LoadTemplate("../Views/menu.html");
$tbs->MergeBlock('bloc', $pizzas);

// Charger le contenu du footer
$footer = file_get_contents('../Views/footer.html');

// Ajouter le footer au template principal
$tbs->Source .= $footer;

$tbs->Show();
?>