<?php // manage_menu.php
//JOURNOUD Lucas / COSTA Julien
//Université Lumière Lyon 2
session_start();
// Vérifier si l'utilisateur est déjà connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Inclusion des fichiers nécessaires
require("connect.inc.php");        // Script pour se connecter à la base de données
require("tbs_class.php");          // Inclusion de la classe TinyButStrong pour la gestion des templates
require("../Models/model_menu.php"); // Inclusion du modèle de données

// Établir la connexion à la base de données avec l'objet PDO
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Création d'une instance du modèle pour gérer les éléments du menu
$modele = new ModeleMenu($pdo);
$tbs = new clsTinyButStrong;

// Traitement des requêtes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ajouter un élément au menu si le bouton ajouter est pressé
    if (isset($_POST['add'])) {
        $modele->addToMenu($_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url']);
    }
    // Supprimer un élément du menu si le bouton supprimer est pressé
    elseif (isset($_POST['delete'])) {
        $modele->deleteElementOfMenuById(($_POST['id']));
    }
    // Modifier un élément du menu si le bouton modifier est pressé
    elseif (isset($_POST['modify'])) {
        $modele->editElementOfMenuById($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url']);
        // Rediriger vers manage_menu.php pour voir les modifications
        header("Location: manage_menu.php");
    }
}

// Récupération de touts les éléments du menu pour l'affichage
$menu = $modele->getAllMenu();

// Traitement de la requête GET pour l'édition d'un élément du menu
$selectedElement = ['id' => '', 'name' => '', 'description' => '', 'price' => '', 'image_url' => ''];
if (isset($_GET['edit'])) {
    $selectedElement = $modele->getElementOfMenuById($_GET['edit']);
}
$tbs->LoadTemplate("../Views/manage_menu.html");     // Chargement du template
$tbs->MergeField('selectedElement', $selectedElement); // Fusion des données de la pizza sélectionnée
$tbs->MergeBlock('bloc', $menu);                       // Fusion des données des pizzas pour le bloc
$tbs->Show();                                          // Affichage du template fusionné
?>