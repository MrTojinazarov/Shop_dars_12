<?php
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function checkStrongPassword($password) {
    $errors = [];
    if (strlen($password) < 8) {
        $errors[] = "Parol kamida 8 ta belgidan iborat bo'lishi kerak.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Parolda kamida bitta katta harf bo'lishi kerak.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Parolda kamida bitta kichik harf bo'lishi kerak.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Parolda kamida bitta raqam bo'lishi kerak.";
    }

    return $errors;
}
?>
