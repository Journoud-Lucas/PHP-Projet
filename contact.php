<?php
require("tbs_class.php");

// Créer une instance de TinyButStrong
$tbs = new clsTinyButStrong;

// Charger le template principal
$tbs->LoadTemplate('contact.html');

// Charger le contenu du footer
$footer = file_get_contents('footer.html');

// Ajouter le footer au template principal
$tbs->Source .= $footer;

// Afficher le résultat final
$tbs->Show();
?>