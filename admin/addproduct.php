<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=market", 'root', 'mr2344');

if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['user_id']) && !empty($_FILES['photo']) && !empty($_POST['category_id']) && !empty($_POST['count'])) {
        $name = ($_POST['name']);
        $price = ($_POST['price']);
        $category_id = ($_POST['category_id']);
        $count = ($_POST['count']);
        $user_id = $_POST['user_id'];
        $premium = $_POST['premium'];

        // echo $name . '<br>';
        // echo $price . '<br>';
        // echo $category_id . '<br>';
        // echo $count . '<br>';
        // echo $user_id . '<br>';

        $data = explode('.', $_FILES['photo']['name']);
        $filepath = $data[0] . '.' . $data[1];
        move_uploaded_file($_FILES['photo']['tmp_name'], 'img/' . $filepath);

        try {
            $sql = "INSERT INTO products (user_id, category_id, name, price, photo, count, premium) VALUES ('{$user_id}', '{$category_id}', '{$name}', '{$price}', 'img/{$filepath}', '{$count}', '{$premium}')";
            $con->exec($sql);

            header("Location: admin.php");
        } catch (PDOException $e) {
            header("Location: Product.php?error=1");
        }
    } else {
        header("Location: addproduct.php");
    }
}
