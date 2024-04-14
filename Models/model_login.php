<?php
// JOURNOUD Lucas / COSTA Julien
// Université Lumière Lyon 2

// Classe ID gérant l'authentification des utilisateurs
class ID
{
    private $login;    // Propriété pour conserver le login utilisateur
    private $passwd;   // Propriété pour conserver le mot de passe utilisateur

    // Constructeur de la classe avec initialisation des identifiants
    public function __construct($login, $passwd)
    {
        $this->login = $login;    // Affectation du login à la propriété de la classe
        $this->passwd = $passwd;  // Affectation du mot de passe à la propriété de la classe
    }

    // Fonction de vérification des identifiants utilisateurs
    public function verif($param_login, $param_passwd)
    {
        // Comparaison des identifiants fournis avec ceux enregistrés
        if ($param_login == $this->login && $param_passwd == $this->passwd) {
            return 1;  // Retourne 1 si les identifiants correspondent
        } else {
            return 0;  // Retourne 0 si les identifiants ne correspondent pas
        }
    }
}
?>