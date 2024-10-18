<?php
try {
    $db = new PDO('sqlite:users.db');  // Укажите путь к вашей базе данных
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}
?>
