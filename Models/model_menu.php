<?php // model_menu.php
// JOURNOUD Lucas / COSTA Julien
// Université Lumière Lyon 2

// Classe ModeleMenu gérant les opérations en base de données pour les pizzas
class ModeleMenu
{
    private $pdo; // Propriété stockant l'instance PDO pour les interactions avec la base de données

    // Constructeur qui initialise l'instance PDO
    public function __construct($pdo)
    {
        $this->pdo = $pdo; // Assignation de l'instance PDO passée en paramètre à la propriété de la classe
    }

    // Fonction pour obtenir touts les éléménts du menu
    public function getAllMenu()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu"); // Préparation de la requête SQL
        $stmt->execute(); // Exécution de la requête
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retour des résultats sous forme de tableau associatif
    }

    // Fonction pour obtenir un élément du menu par son identifiant
    public function getElementOfMenuById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM menu WHERE id = :id"); // Préparation de la requête avec paramètre
        $stmt->execute(['id' => $id]); // Exécution de la requête avec passage du paramètre id
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retour du résultat sous forme de tableau associatif
    }

    // Fonction pour ajouter un élément du menu à la base de données
    public function addToMenu($name, $description, $price, $image_url)
    {
        $stmt = $this->pdo->prepare("INSERT INTO menu (name, description, price, image_url) VALUES (?, ?, ?, ?)"); // Préparation de la requête d'insertion
        $stmt->execute([$name, $description, $price, $image_url]); // Exécution de la requête avec les valeurs fournies
    }

    // Fonction pour supprimer un élément du menu par son identifiant
    public function deleteElementOfMenuById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM menu WHERE id = ?"); // Préparation de la requête de suppression
        $stmt->execute([$id]); // Exécution de la requête avec le paramètre id
    }

    // Fonction pour éditer un élément existant du menu dans la base de données
    public function editElementOfMenuById($id, $name, $description, $price, $image_url)
    {
        $stmt = $this->pdo->prepare("UPDATE menu SET name = ?, description = ?, price = ?, image_url = ? WHERE id = ?"); // Préparation de la requête de mise à jour
        $stmt->execute([$name, $description, $price, $image_url, $id]); // Exécution de la requête avec les nouvelles valeurs et l'id spécifié
    }
}
?>