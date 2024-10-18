<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Поиск пользователя в базе данных
    $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Старт сессии и сохранение данных о пользователе
        session_start();
        $_SESSION['user_id'] = $user['id'];
        
        // Перенаправление на index.html
        header('Location: index.html');  // Редирект на index.html после успешного входа
        exit();
    } else {
        echo 'Invalid email or password!';
    }
}
?>
