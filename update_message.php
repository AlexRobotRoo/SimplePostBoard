<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $short_content = trim($_POST['short_content']);
    $full_content = trim($_POST['full_content']);

    if (!empty($title) && !empty($author) && !empty($short_content) && !empty($full_content)) {
        $stmt = $pdo->prepare("UPDATE messages SET title = :title, author = :author, short_content = :short_content, full_content = :full_content WHERE id = :id");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':short_content', $short_content);
        $stmt->bindParam(':full_content', $full_content);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    header('Location: view.php?id=' . $id);
} else {
    header('Location: index.php');
}
?>