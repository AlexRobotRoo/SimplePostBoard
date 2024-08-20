<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message_id = $_POST['message_id'];
    $author = trim($_POST['author']);
    $comment = trim($_POST['comment']);

    if (!empty($message_id) && !empty($author) && !empty($comment)) {
        $stmt = $pdo->prepare("INSERT INTO comments (message_id, author, comment) VALUES (:message_id, :author, :comment)");
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
    }

    header('Location: view.php?id=' . $message_id);
} else {
    header('Location: index.php');
}
?>