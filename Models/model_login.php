<?php
class ID
{
    //Attribut
    private $login;
    private $passwd;

    //Méthode
    public function __construct($login, $passwd)
    { //Constructeur
        $this->login = $login;
        $this->passwd = $passwd;
    }
    public function verif($param_login, $param_passwd)
    { //Verif identifiants
        if ($param_login == $this->login && $param_passwd == $this->passwd) {
            return 1;
        } else {
            return 0;
        }
    }
}
?>