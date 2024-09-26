<?php
session_start();
require 'func.php';

$con = new PDO('mysql:host=localhost;dbname=market', 'root', 'mr2344');

if (isset($_POST['login'])) {
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $con->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['loggedin'] = true;

            if(!empty($user['role']) && $user['role'] == 'admin'){
                header("Location: admin.php");
                exit();
            }elseif(!empty($user['role']) && $user['role'] == 'user'){
                header("Location: admin.php");
                exit();
            }
            exit();
        } else {
            $_SESSION['error'] = "Email yoki parol noto'g'ri!";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Email va parol maydonlari bo'sh bo'lmasligi kerak!";
        header("Location: login.php");
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <section class="vh-80 bg-image"
            style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100 mt-5 mb-5">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center mb-5">Kirish</h2>
                                    
                                    <?php if (isset($_SESSION['error'])): ?>
                                        <script>
                                            alert("<?= $_SESSION['error']; ?>");
                                        </script>
                                        <?php unset($_SESSION['error']); ?>
                                    <?php endif; ?>

                                    <form action="login.php" method="POST">
                                        <div class="form-outline mb-4">
                                            <input type="email" name="email" id="formEmail" class="form-control form-control-lg" required />
                                            <label class="form-label" for="formEmail">Emailingiz</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="password" id="formPassword" class="form-control form-control-lg" required />
                                            <label class="form-label" for="formPassword">Parol</label>
                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit" name="login" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Kirish</button>
                                        </div>
                                    </form>
                                    <div class="text-center mt-4">
                                        <p>Ro'yxatdan o'tmaganmisiz? <a href="regs.php">Ro'yxatdan o'ting</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>

