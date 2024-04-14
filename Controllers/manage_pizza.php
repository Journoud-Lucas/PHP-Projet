<?php // manage_pizza.php
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

// Création d'une instance du modèle pour gérer les pizzas
$modele = new ModelePizza($pdo);
$tbs = new clsTinyButStrong;

// Traitement des requêtes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ajouter une nouvelle pizza si le bouton ajouter est pressé
    if (isset($_POST['add'])) {
        $modele->ajouterPizza($_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url']);
    }
    // Supprimer une pizza si le bouton supprimer est pressé
    elseif (isset($_POST['deletePizza'])) {
        $modele->supprimerPizza(($_POST['id']));
    }
    // Modifier une pizza si le bouton modifier est pressé
    elseif (isset($_POST['modify'])) {
        $modele->editerPizza($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url']);
        // Rediriger vers manage_pizzas.php pour voir les modifications
        header("Location: manage_pizza.php");
    }
}

// Récupération de toutes les pizzas pour l'affichage
$pizzas = $modele->obtenirPizzas();

// Traitement de la requête GET pour l'édition d'une pizza
$selectedPizza = ['id' => '', 'name' => '', 'description' => '', 'price' => '', 'image_url' => ''];
if (isset($_GET['edit'])) {
    $selectedPizza = $modele->obtenirPizzaParId($_GET['edit']);
}
$tbs->LoadTemplate("../Views/manage_pizzas.html");  // Chargement du template
$tbs->MergeField('selectedPizza', $selectedPizza);  // Fusion des données de la pizza sélectionnée
$tbs->MergeBlock('bloc', $pizzas);                  // Fusion des données des pizzas pour le bloc
$tbs->Show();                                       // Affichage du template fusionné
?>