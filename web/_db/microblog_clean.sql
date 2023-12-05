-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 05 2023 г., 15:01
-- Версия сервера: 5.7.42
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `microblog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `title` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Title',
  `content` text COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Content',
  `date` date NOT NULL COMMENT 'Data',
  `author_id` int(11) NOT NULL COMMENT 'Author ID',
  `status` varchar(10) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Article Status',
  `access` varchar(10) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL COMMENT 'Article Access',
  `category_id` int(11) DEFAULT NULL COMMENT 'Articlee Category ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL COMMENT 'Category ID',
  `name` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Category Name',
  `slug` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Category Slug'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(1, 'Uncategorized', 'uncategorized');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(65) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Full User Name',
  `login` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'User Login',
  `pass` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Passwords',
  `role` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL COMMENT 'Role'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `pass`, `role`) VALUES
(1, 'Nikolay Ivanovich Makartov', 'nikolay', '123', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Category ID', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
