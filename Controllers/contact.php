<?php // contact.php
//JOURNOUD Lucas / COSTA Julien
//Universit� Lumi�re Lyon 2
require("tbs_class.php");

// Cr�er une instance de TinyButStrong
$tbs = new clsTinyButStrong;

// Charger le template principal
$tbs->LoadTemplate('../Views/contact.html');

// Charger le contenu du footer
$footer = file_get_contents('../Views/footer.html');

// Ajout du footer
$tbs->Source .= $footer;

// Affichage du template fusionn�
$tbs->Show();
?>