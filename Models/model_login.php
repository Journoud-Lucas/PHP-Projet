<?php
// JOURNOUD Lucas / COSTA Julien
// Universit� Lumi�re Lyon 2

// Classe ID g�rant l'authentification des utilisateurs
class ID
{
    private $login;    // Propri�t� pour conserver le login utilisateur
    private $passwd;   // Propri�t� pour conserver le mot de passe utilisateur

    // Constructeur de la classe avec initialisation des identifiants
    public function __construct($login, $passwd)
    {
        $this->login = $login;    // Affectation du login � la propri�t� de la classe
        $this->passwd = $passwd;  // Affectation du mot de passe � la propri�t� de la classe
    }

    // Fonction de v�rification des identifiants utilisateurs
    public function verif($param_login, $param_passwd)
    {
        // Comparaison des identifiants fournis avec ceux enregistr�s
        if ($param_login == $this->login && $param_passwd == $this->passwd) {
            return 1;  // Retourne 1 si les identifiants correspondent
        } else {
            return 0;  // Retourne 0 si les identifiants ne correspondent pas
        }
    }
}
?>