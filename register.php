<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Проверка на совпадение паролей
    if ($password != $confirm_password) {
        echo 'Passwords do not match!';
        exit();
    }

    // Хеширование пароля
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Проверка наличия пользователя
    $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo 'User with this email already exists!';
        exit();
    }

    // Вставка нового пользователя
    $stmt = $db->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
    if ($stmt->execute([$email, $hashed_password])) {
        // Перенаправление на index.html после успешной регистрации
        header('Location: index.html');
        exit();
    } else {
        echo 'Error during registration!';
    }
}
?>
