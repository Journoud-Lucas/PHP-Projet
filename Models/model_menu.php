<?php // model_menu.php
class ModelePizza
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenirPizzas()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pizzas");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenirPizzaParId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM pizzas WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function ajouterPizza($name, $description, $price, $image_url)
    {
        $stmt = $this->pdo->prepare("INSERT INTO pizzas (name, description, price, image_url) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $image_url]);
    }

    public function supprimerPizza($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM pizzas WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function editerPizza($id, $name, $description, $price, $image_url)
    {
        $stmt = $this->pdo->prepare("UPDATE pizzas SET name = ?, description = ?, price = ?, image_url = ? WHERE id = ?");
        $stmt->execute([$name, $description, $price, $image_url, $id]);
    }
}
?>