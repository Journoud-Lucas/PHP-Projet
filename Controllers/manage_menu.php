<?php // manage_menu.php
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

// Cr�ation d'une instance du mod�le pour g�rer les �l�ments du menu
$modele = new ModeleMenu($pdo);
$tbs = new clsTinyButStrong;

// Traitement des requ�tes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ajouter un �l�ment au menu si le bouton ajouter est press�
    if (isset($_POST['add'])) {
        $modele->addToMenu($_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url']);
    }
    // Supprimer un �l�ment du menu si le bouton supprimer est press�
    elseif (isset($_POST['delete'])) {
        $modele->deleteElementOfMenuById(($_POST['id']));
    }
    // Modifier un �l�ment du menu si le bouton modifier est press�
    elseif (isset($_POST['modify'])) {
        $modele->editElementOfMenuById($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url']);
        // Rediriger vers manage_menu.php pour voir les modifications
        header("Location: manage_menu.php");
    }
}

// R�cup�ration de touts les �l�ments du menu pour l'affichage
$menu = $modele->getAllMenu();

// Traitement de la requ�te GET pour l'�dition d'un �l�ment du menu
$selectedElement = ['id' => '', 'name' => '', 'description' => '', 'price' => '', 'image_url' => ''];
if (isset($_GET['edit'])) {
    $selectedElement = $modele->getElementOfMenuById($_GET['edit']);
}
$tbs->LoadTemplate("../Views/manage_menu.html");     // Chargement du template
$tbs->MergeField('selectedElement', $selectedElement); // Fusion des donn�es de la pizza s�lectionn�e
$tbs->MergeBlock('bloc', $menu);                       // Fusion des donn�es des pizzas pour le bloc
$tbs->Show();                                          // Affichage du template fusionn�
?>