-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 29 2017 г., 19:59
-- Версия сервера: 5.6.34
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mem`
--

-- --------------------------------------------------------

--
-- Структура таблицы `memes_items`
--

CREATE TABLE `memes_items` (
  `id` int(11) NOT NULL,
  `post_type` varchar(100) NOT NULL,
  `cat` varchar(100) NOT NULL,
  `date` int(11) NOT NULL,
  `wall_id` varchar(50) NOT NULL,
  `gid` int(11) NOT NULL,
  `text` text NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `attachments` text NOT NULL,
  `attachment_hash` varchar(255) NOT NULL,
  `item_hash` varchar(255) NOT NULL,
  `text_hash` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL,
  `reposts` int(11) NOT NULL,
  `rating` float NOT NULL,
  `bad_post` int(11) NOT NULL,
  `good_post` int(11) NOT NULL,
  `ignore_post` int(11) NOT NULL,
  `un` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `memes_items`
--
ALTER TABLE `memes_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `memes_items`
--
ALTER TABLE `memes_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
