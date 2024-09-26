<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

include 'header.php';
?>

<div class="container-fluid">

</div>

<?php
include 'footer.php';
?>