<?php // home.php
//JOURNOUD Lucas / COSTA Julien
//Universit� Lumi�re Lyon 2
require("tbs_class.php"); // Inclure le script de la classe TinyButStrong pour la gestion des templates

// Cr�er une nouvelle instance de TinyButStrong
$tbs = new clsTinyButStrong;

// Charger le template principal
$tbs->LoadTemplate('../Views/home.html');

// Charger le contenu du footer � partir d'un fichier HTML
$footer = file_get_contents('../Views/footer.html');

// Ajout du footer
$tbs->Source .= $footer;

// Affichage du template fusionn�
$tbs->Show();
?>