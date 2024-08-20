<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
</head>
<body>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'db.php';

    $limit = 3;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Забираем сообщения из БД
    $stmt = $pdo->prepare("SELECT * FROM messages ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Забираем комменты для всех сообщений из БД
    $message_ids = array_column($messages, 'id');
    $comments = [];
    if (!empty($message_ids)) {
        $inQuery = implode(',', array_fill(0, count($message_ids), '?'));
        $comments_stmt = $pdo->prepare("SELECT * FROM comments WHERE message_id IN ($inQuery) ORDER BY created_at DESC");
        $comments_stmt->execute($message_ids);
        $fetched_comments = $comments_stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($fetched_comments as $comment) {
            $comments[$comment['message_id']][] = $comment;
        }
    }

    // Отображаем сообщения
    foreach ($messages as $message) {
        echo "<h2>{$message['title']}</h2>";
        echo "<p>{$message['short_content']}</p>";
        echo "<a href='view.php?id={$message['id']}'>Полная версия</a>";

        echo "<h3>Комментарии:</h3>";
        if (!empty($comments[$message['id']])) {
            foreach ($comments[$message['id']] as $comment) {
                echo "<p><strong>{$comment['author']}</strong>: {$comment['comment']}</p>";
            }
        } else {
            echo "<p>Нет комментариев.</p>";
        }

        // Форма для оставления комментариев
        echo "<form method='post' action='add_comment.php'>";
        echo "<input type='hidden' name='message_id' value='{$message['id']}'>";
        echo "<label for='author'>Никнейм:</label>";
        echo "<input type='text' name='author' id='author' required><br><br>";
        echo "<label for='comment'>Комментарий:</label>";
        echo "<textarea name='comment' id='comment' required></textarea><br><br>";
        echo "<button type='submit'>Оставить комментарий</button>";
        echo "</form>";
        echo "<hr>";
    }

    // Пагинация
    $total = $pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();
    $total_pages = ceil($total / $limit);

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='index.php?page=$i'>$i</a> ";
    }
    ?>
</body>
</html>