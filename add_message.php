<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить сообщение</title>
</head>
<body>

<h1>Добавить сообщение</h1>

<form method="post" action="save_message.php">
    <label for="title">Заголовок:</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="author">Автор:</label><br>
    <input type="text" id="author" name="author" required><br><br>

    <label for="short_content">Краткое содержание:</label><br>
    <textarea id="short_content" name="short_content" required></textarea><br><br>

    <label for="full_content">Полное содержание:</label><br>
    <textarea id="full_content" name="full_content" required></textarea><br><br>

    <button type="submit">Сохранить сообщение</button>
</form>

</body>
</html>