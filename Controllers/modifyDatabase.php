<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require("connect.inc.php");
require("tbs_class.php");
require("../Models/model_menu.php");

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
$modele = new ModelePizza($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $modele->ajouterPizza($_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url']);
    } elseif (isset($_POST['deletePizza'])) {
        $modele->supprimerPizza($_POST['id']);
    } elseif (isset($_POST['modify'])) {
        $modele->editerPizza($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url']);
        header("Location: modifyDatabase.php");
    }
}

$pizzas = $modele->obtenirPizzas();
$selectedPizza = ['id' => '', 'name' => '', 'description' => '', 'price' => '', 'image_url' => ''];
if (isset($_GET['edit'])) {
    $selectedPizza = $modele->obtenirPizzaParId($_GET['edit']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gestion des Pizzas</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($selectedPizza['id']); ?>">
        <p>
            <label>Nom:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($selectedPizza['name']); ?>">
        </p>
        <p>
            <label>Description:</label>
            <input type="text" name="description" value="<?php echo htmlspecialchars($selectedPizza['description']); ?>">
        </p>
        <p>
            <label>Prix:</label>
            <input type="text" name="price" value="<?php echo htmlspecialchars($selectedPizza['price']); ?>">
        </p>
        <p>
            <label>URL de l'image:</label>
            <input type="text" name="image_url" value="<?php echo htmlspecialchars($selectedPizza['image_url']); ?>">
        </p>
        <p>
            <input type="submit" name="<?php echo $selectedPizza['id'] ? 'modify' : 'add'; ?>" value="<?php echo $selectedPizza['id'] ? 'Modifier' : 'Ajouter'; ?>">
        </p>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($pizzas as $pizza): ?>
        <tr>
            <td><?php echo $pizza['id']; ?></td>
            <td><?php echo $pizza['name']; ?></td>
            <td><?php echo $pizza['description']; ?></td>
            <td><?php echo $pizza['price']; ?></td>
            <td><img src="<?php echo $pizza['image_url']; ?>" height="50" width="50"></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $pizza['id']; ?>">
                    <input type="submit" name="deletePizza" value="Supprimer">
                    <a href="?edit=<?php echo $pizza['id']; ?>">Modifier</a>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>