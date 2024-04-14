<?php // model_menu.php
// JOURNOUD Lucas / COSTA Julien
// Université Lumière Lyon 2

// Classe ModelePizza gérant les opérations en base de données pour les pizzas
class ModelePizza
{
    private $pdo; // Propriété stockant l'instance PDO pour les interactions avec la base de données

    // Constructeur qui initialise l'instance PDO
    public function __construct($pdo)
    {
        $this->pdo = $pdo; // Assignation de l'instance PDO passée en paramètre à la propriété de la classe
    }

    // Fonction pour obtenir toutes les pizzas de la base de données
    public function obtenirPizzas()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pizzas"); // Préparation de la requête SQL
        $stmt->execute(); // Exécution de la requête
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retour des résultats sous forme de tableau associatif
    }

    // Fonction pour obtenir une pizza par son identifiant
    public function obtenirPizzaParId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pizzas WHERE id = :id"); // Préparation de la requête avec paramètre
        $stmt->execute(['id' => $id]); // Exécution de la requête avec passage du paramètre id
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retour du résultat sous forme de tableau associatif
    }

    // Fonction pour ajouter une nouvelle pizza à la base de données
    public function ajouterPizza($name, $description, $price, $image_url)
    {
        $stmt = $this->pdo->prepare("INSERT INTO pizzas (name, description, price, image_url) VALUES (?, ?, ?, ?)"); // Préparation de la requête d'insertion
        $stmt->execute([$name, $description, $price, $image_url]); // Exécution de la requête avec les valeurs fournies
    }

    // Fonction pour supprimer une pizza par son identifiant
    public function supprimerPizza($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM pizzas WHERE id = ?"); // Préparation de la requête de suppression
        $stmt->execute([$id]); // Exécution de la requête avec le paramètre id
    }

    // Fonction pour éditer une pizza existante dans la base de données
    public function editerPizza($id, $name, $description, $price, $image_url)
    {
        $stmt = $this->pdo->prepare("UPDATE pizzas SET name = ?, description = ?, price = ?, image_url = ? WHERE id = ?"); // Préparation de la requête de mise à jour
        $stmt->execute([$name, $description, $price, $image_url, $id]); // Exécution de la requête avec les nouvelles valeurs et l'id spécifié
    }
}
?>