<?php
session_start();
$con = new PDO('mysql:host=localhost;dbname=Market', 'root', 'mr2344');

if (isset($_POST['ok']) && !empty($_POST['product_id']) && !empty($_POST['user_id']) && isset($_POST['premium'])) {

    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $premium = $_POST['premium'];

    $sql = "UPDATE products SET premium = :premium WHERE id = :product_id";
    $stmt = $con->prepare($sql);
    $stmt->execute([
        ':product_id' => $product_id,
        ':premium' => $premium
    ]);

    $_SESSION['success'] = 'Muvaffaqiyatli yangilandi';
    header("Location: UsersProducts.php");
} else {
    $_SESSION['error'] = 'Yangilashda xatolik yuz berdi';
    header("Location: UsersProducts.php");
}
?>
