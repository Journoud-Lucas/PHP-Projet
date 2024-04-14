// Fonction pour obtenir le paramètre 'edit' de l'URL
function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
// Utilisation de la fonction pour vérifier la présence de 'edit'
var editParam = getParameterByName('edit');
// Sélection du bouton par son identifiant
var submitButton = document.getElementById('submitButton');
// Modification de la valeur et du name du bouton en fonction de 'edit'
if (editParam !== null) {
    submitButton.value = "Modifier";
    submitButton.name = "modify";
} else {
    submitButton.value = "Ajouter";
    submitButton.name = "add";
}
//Va 2 parent en arrière
function goToParentPage() {
    var currentUrl = window.location.href; // Récupération de l'URL courante
    var urlParts = currentUrl.split('/'); // Découpage de l'URL en plusieurs parties
    // On retire le dernier élément de l'array si l'URL ne termine pas par "/" (nom de fichier ou dernier dossier)
    if (urlParts[urlParts.length - 1] !== "") {
        urlParts.pop();
        urlParts.pop();
    }
    // Reconstruction de l'URL sans le dernier élément
    var parentUrl = urlParts.join('/');
    // Redirection vers l'URL parente
    window.location.href = parentUrl;
}