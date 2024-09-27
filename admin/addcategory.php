<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=market", 'root', 'mr2344');

if(isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['tr'])  && !empty($_POST['active'])){
    $name = htmlspecialchars($_POST['name']);
    $tr = htmlspecialchars($_POST['tr']);
    $active = htmlspecialchars($_POST['active']);

    try{
        $sql = "INSERT INTO categories(name, tr, active) VALUES ('{$name}', '{$tr}', '{$active}')";
        $con->exec($sql);
        header("Location: CategoriesTable.php");
        exit();
    }catch(PDOException $th){
        header("Location: CategoriesTable.php");
        exit();
    }
}else{
    header("Location: CategoriesTable.php");
    exit();
}

?>