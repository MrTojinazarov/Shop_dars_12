.<?php
session_start();
    $con = new PDO("mysql:host=localhost;dbname=market", 'root', 'mr2344');
    if(isset($_POST['ok']) && !empty($_POST['id'])){
        $id = $_POST['id'];

        $sql = "DELETE FROM categories where id= '{$id}'";
        $con->exec($sql);

        $_SESSION['success'] = "Muvaffaqqtiyatli o'chirildi";
        header("Location: CategoriesTable.php");
    }
?>