<?php // manage_pizza.php
//JOURNOUD Lucas / COSTA Julien
//Universit� Lumi�re Lyon 2
session_start();
// V�rifier si l'utilisateur est d�j� connect�, sinon rediriger vers la page de connexion
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Inclusion des fichiers n�cessaires
require("connect.inc.php");        // Script pour se connecter � la base de donn�es
require("tbs_class.php");          // Inclusion de la classe TinyButStrong pour la gestion des templates
require("../Models/model_menu.php"); // Inclusion du mod�le de donn�es

// �tablir la connexion � la base de donn�es avec l'objet PDO
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Cr�ation d'une instance du mod�le pour g�rer les pizzas
$modele = new ModelePizza($pdo);
$tbs = new clsTinyButStrong;

// Traitement des requ�tes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ajouter une nouvelle pizza si le bouton ajouter est press�
    if (isset($_POST['add'])) {
        $modele->ajouterPizza($_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url']);
    }
    // Supprimer une pizza si le bouton supprimer est press�
    elseif (isset($_POST['deletePizza'])) {
        $modele->supprimerPizza(($_POST['id']));
    }
    // Modifier une pizza si le bouton modifier est press�
    elseif (isset($_POST['modify'])) {
        $modele->editerPizza($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url']);
        // Rediriger vers manage_pizzas.php pour voir les modifications
        header("Location: manage_pizza.php");
    }
}

// R�cup�ration de toutes les pizzas pour l'affichage
$pizzas = $modele->obtenirPizzas();

// Traitement de la requ�te GET pour l'�dition d'une pizza
$selectedPizza = ['id' => '', 'name' => '', 'description' => '', 'price' => '', 'image_url' => ''];
if (isset($_GET['edit'])) {
    $selectedPizza = $modele->obtenirPizzaParId($_GET['edit']);
}
$tbs->LoadTemplate("../Views/manage_pizzas.html");  // Chargement du template
$tbs->MergeField('selectedPizza', $selectedPizza);  // Fusion des donn�es de la pizza s�lectionn�e
$tbs->MergeBlock('bloc', $pizzas);                  // Fusion des donn�es des pizzas pour le bloc
$tbs->Show();                                       // Affichage du template fusionn�
?>