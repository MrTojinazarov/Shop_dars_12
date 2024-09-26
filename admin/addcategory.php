<?php
session_start();
$con = new PDO("mysql:host=localhost;dbname=market", 'root', 'mr2344');

if(isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['tr'])){
    $name = htmlspecialchars($_POST['name']);
    $tr = htmlspecialchars($_POST['tr']);

    try{
        $sql = "INSERT INTO categories(name, tr) VALUES ('{$name}', '{$tr}')";
        $con->exec($sql);
        header("Location: admin.php");
        exit();
    }catch(PDOException $th){
        header("Location: Category.php");
        exit();
    }
}else{
    header("Location: Category.php");
    exit();
}

?>