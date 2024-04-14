<?php // contact.php
//JOURNOUD Lucas / COSTA Julien
//Université Lumière Lyon 2
require("tbs_class.php");

// Créer une instance de TinyButStrong
$tbs = new clsTinyButStrong;

// Charger le template principal
$tbs->LoadTemplate('../Views/contact.html');

// Charger le contenu du footer
$footer = file_get_contents('../Views/footer.html');

// Ajout du footer
$tbs->Source .= $footer;

// Affichage du template fusionné
$tbs->Show();
?>