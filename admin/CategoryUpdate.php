<?php
session_start();
$con = new PDO('mysql:host=localhost;dbname=Market', 'root', 'mr2344');

if (isset($_POST['ok']) && !empty($_POST['id']) && !empty($_POST['name']) && isset($_POST['tr'])  && isset($_POST['active'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $tr = $_POST['tr'];
    $active = $_POST['active'];

    $sql = "UPDATE categories SET name = :name, tr = :tr, active = :active WHERE id = :id";
    $stmt = $con->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':tr' => $tr,
        ':active' => $active,
        ':id' => $id
    ]);

    $_SESSION['success'] = 'Muvaffaqiyatli yangilandi';
    header("Location: CategoriesTable.php");
} else {
    $_SESSION['error'] = 'Yangilashda xatolik yuz berdi';
    header("Location: CategoriesTable.php");
}
?>
