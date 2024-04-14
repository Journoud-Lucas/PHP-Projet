<?php // model_menu.php
// JOURNOUD Lucas / COSTA Julien
// Universit� Lumi�re Lyon 2

// Classe ModelePizza g�rant les op�rations en base de donn�es pour les pizzas
class ModelePizza
{
    private $pdo; // Propri�t� stockant l'instance PDO pour les interactions avec la base de donn�es

    // Constructeur qui initialise l'instance PDO
    public function __construct($pdo)
    {
        $this->pdo = $pdo; // Assignation de l'instance PDO pass�e en param�tre � la propri�t� de la classe
    }

    // Fonction pour obtenir toutes les pizzas de la base de donn�es
    public function obtenirPizzas()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pizzas"); // Pr�paration de la requ�te SQL
        $stmt->execute(); // Ex�cution de la requ�te
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retour des r�sultats sous forme de tableau associatif
    }

    // Fonction pour obtenir une pizza par son identifiant
    public function obtenirPizzaParId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pizzas WHERE id = :id"); // Pr�paration de la requ�te avec param�tre
        $stmt->execute(['id' => $id]); // Ex�cution de la requ�te avec passage du param�tre id
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retour du r�sultat sous forme de tableau associatif
    }

    // Fonction pour ajouter une nouvelle pizza � la base de donn�es
    public function ajouterPizza($name, $description, $price, $image_url)
    {
        $stmt = $this->pdo->prepare("INSERT INTO pizzas (name, description, price, image_url) VALUES (?, ?, ?, ?)"); // Pr�paration de la requ�te d'insertion
        $stmt->execute([$name, $description, $price, $image_url]); // Ex�cution de la requ�te avec les valeurs fournies
    }

    // Fonction pour supprimer une pizza par son identifiant
    public function supprimerPizza($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM pizzas WHERE id = ?"); // Pr�paration de la requ�te de suppression
        $stmt->execute([$id]); // Ex�cution de la requ�te avec le param�tre id
    }

    // Fonction pour �diter une pizza existante dans la base de donn�es
    public function editerPizza($id, $name, $description, $price, $image_url)
    {
        $stmt = $this->pdo->prepare("UPDATE pizzas SET name = ?, description = ?, price = ?, image_url = ? WHERE id = ?"); // Pr�paration de la requ�te de mise � jour
        $stmt->execute([$name, $description, $price, $image_url, $id]); // Ex�cution de la requ�te avec les nouvelles valeurs et l'id sp�cifi�
    }
}
?>