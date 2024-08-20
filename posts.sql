-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 20 2024 г., 11:32
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `posts`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `message_id`, `author`, `comment`, `created_at`) VALUES
(9, 6, 'Кот', 'Не были мы ни в какой Таити...', '2024-08-20 06:54:45'),
(10, 3, 'Скептик', 'Ага, ага...', '2024-08-20 06:55:15'),
(11, 3, 'Оптимист', 'Ура, беру кредит, на взлёёёт!', '2024-08-20 06:55:43'),
(12, 5, 'Ценитель', 'МММ, пальчики оближешь', '2024-08-20 06:56:05'),
(13, 4, 'Фифи', 'А моей кошечке не понравилось(((', '2024-08-20 06:57:10'),
(15, 3, 'Хомячок', 'УРААААА!', '2024-08-20 08:19:13'),
(16, 3, 'Крокодил', 'Ищу друзей', '2024-08-20 08:30:17');

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `short_content` text NOT NULL,
  `full_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `title`, `author`, `short_content`, `full_content`, `created_at`) VALUES
(3, 'Bitcoin будет расти', 'Криптанец', 'Взлетаем до небес', 'До конца этого года биток взлетит в цене, будет круто. Но это не точно', '2024-08-20 06:40:41'),
(4, 'Лучшие товары для кошек', 'МамаКош', 'Подарки, которые точно понравятся вашему питомцу', 'Новая когтеточка это супер. А рассчёска просто класс!', '2024-08-20 06:40:41'),
(5, 'Рецпет жареной картошки', 'СуперПовар', 'Такой картошки вы еще не пробовали', 'Режем, сушим, солим, жарим и немного красного вина.', '2024-08-20 06:40:41'),
(6, 'Таити - райский остров', 'ТревелМен', 'Как я слетал на Таити.', 'Супер пляжи, доброжелательные местные, а отели дорогие(.', '2024-08-20 06:40:41');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
