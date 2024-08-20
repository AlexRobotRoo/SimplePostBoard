<?php
$host = 'localhost';
$db = 'posts';
$user = 'test23devs';
$pass = '123devs';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Соединение с БД выполнено успешно!";
} catch (PDOException $e) {
    die("Ошибка. Не удалось подключиться к БД" . $e->getMessage());
}
?>