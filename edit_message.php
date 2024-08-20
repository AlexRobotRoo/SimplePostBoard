<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать сообщение</title>
</head>
<body>
    <?php
    include 'db.php';

    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM messages WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $message = $stmt->fetch();

    if ($message):
    ?>
    <h1>Редактировать сообщение</h1>

    <form method="post" action="update_message.php">
        <input type="hidden" name="id" value="<?php echo $message['id']; ?>">

        <label for="title">Заголовок:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $message['title']; ?>" required><br><br>

        <label for="author">Автор:</label><br>
        <input type="text" id="author" name="author" value="<?php echo $message['author']; ?>" required><br><br>

        <label for="short_content">Краткое содержание:</label><br>
        <textarea id="short_content" name="short_content" required><?php echo $message['short_content']; ?></textarea><br><br>

        <label for="full_content">Полное содержание:</label><br>
        <textarea id="full_content" name="full_content" required><?php echo $message['full_content']; ?></textarea><br><br>

        <button type="submit">Сохранить изменения</button>
    </form>

    <?php else: ?>
        <p>Message not found.</p>
    <?php endif; ?>
</body>
</html>