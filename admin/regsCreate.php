<?php
session_start();
require 'func.php';

$con = new PDO('mysql:host=localhost;dbname=market', 'root', 'mr2344');

if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_c'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_c = $_POST['password_c'];

        if ($password !== $password_c) {
            $_SESSION['error'] = "Parollar mos emas!";
            header("Location: regs.php");
            exit();
        }

        $password_errors = checkStrongPassword($password);
        if (!empty($password_errors)) {
            $_SESSION['error'] = implode(" ", $password_errors);
            header("Location: regs.php");
            exit();
        }

        $check_email = $con->prepare("SELECT * FROM users WHERE email = ?");
        $check_email->execute([$email]);
        if ($check_email->rowCount() > 0) {
            $_SESSION['error'] = "Bu email avvaldan ro'yxatdan o'tgan!";
            header("Location: regs.php");
            exit();
        }

        $hashed_password = hashPassword($password);

        try {
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $con->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashed_password
            ]);
            $_SESSION['loggedin'] = true;
            $_SESSION['user_name'] = $name;
            $_SESSION['success'] = "Ro'yxatdan muvaffaqiyatli o'tdingiz";
            header("Location: admin.php");
        } catch (PDOException $th) {
            header("Location: regsCreate.php");
            echo "Xatolik yuz berdi: " . $th->getMessage();
        }
    } else {
        $_SESSION['error'] = "Barcha maydonlarni to'ldiring!";
        header("Location: regs.php");
    }
}
?>
