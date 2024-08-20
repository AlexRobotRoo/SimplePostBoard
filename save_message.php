<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $short_content = trim($_POST['short_content']);
    $full_content = trim($_POST['full_content']);

    if (!empty($title) && !empty($author) && !empty($short_content) && !empty($full_content)) {
        $stmt = $pdo->prepare("INSERT INTO messages (title, author, short_content, full_content) VALUES (:title, :author, :short_content, :full_content)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':short_content', $short_content);
        $stmt->bindParam(':full_content', $full_content);
        $stmt->execute();
    }

    header('Location: index.php');
} else {
    header('Location: add_message.php');
}
?>