<?php
session_start();
$con = new PDO('mysql:host=localhost;dbname=Market', 'root', 'mr2344');

if (isset($_POST['ok']) && !empty($_POST['product_id']) && !empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['count']) && !empty($_POST['category_id']) && !empty($_POST['user_id']) && isset($_POST['premium'])) {

    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $price = $_POST['price']; 
    $count = $_POST['count']; 
    $category_id = $_POST['category_id'];
    $premium = $_POST['premium'];
    $photo = isset($_POST['photo']) ? $_POST['photo'] : '';

    if (isset($_FILES['new_photo']) && $_FILES['new_photo']['error'] == 0) {
        $data = pathinfo($_FILES['new_photo']['name']);
        $filePath = $data['filename'] . date('Y-m-d_H-i-s_') . '.' . $data['extension'];
        move_uploaded_file($_FILES['new_photo']['tmp_name'], 'img/' . $filePath);
        $photo = "img/{$filePath}";
    }

    $sql = "UPDATE products SET name = :name, price = :price, count = :count,  category_id = :category_id, user_id = :user_id, photo = :photo, premium = :premium WHERE id = :product_id";
    $stmt = $con->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':price' => $price,
        ':count' => $count,
        ':category_id' => $category_id,
        ':user_id' => $user_id,
        ':photo' => $photo,
        ':product_id' => $product_id,
        ':premium' => $premium
    ]);

    $_SESSION['success'] = 'Muvaffaqiyatli yangilandi';
    header("Location: ProductsTable.php");
} else {
    $_SESSION['error'] = 'Yangilashda xatolik yuz berdi';
    header("Location: ProductsTable.php");
}
?>
