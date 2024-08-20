<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message</title>
</head>
<body>
    <?php
    include 'db.php';

    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM messages WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $message = $stmt->fetch();

    if ($message) {
        echo "<h1>{$message['title']}</h1>";
        echo "<p>By: {$message['author']}</p>";
        echo "<p>{$message['full_content']}</p>";
        
        $comments_stmt = $pdo->prepare("SELECT * FROM comments WHERE message_id = :id ORDER BY created_at DESC");
        $comments_stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $comments_stmt->execute();
        $comments = $comments_stmt->fetchAll();

        echo "<h2>Комментарии:</h2>";

        if (count($comments) > 0) {
            foreach ($comments as $comment) {
                echo "<p><strong>{$comment['author']}</strong>: {$comment['comment']}</p>";
            }
        } else {
            echo "<p>Комментариев нет.</p>";
        }
        
        echo "<a href='edit_message.php?id={$message['id']}'>Редактировать сообщение</a>";
    } else {
        echo "<p>Сообщение не найдено.</p>";
    }
    ?>
</body>
</html>