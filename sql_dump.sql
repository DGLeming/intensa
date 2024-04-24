-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Хост: sql8.freesqldatabase.com
-- Время создания: Апр 24 2024 г., 07:50
-- Версия сервера: 5.5.62-0ubuntu0.14.04.1
-- Версия PHP: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sql8701332`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bans`
--

CREATE TABLE `bans` (
  `ip` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `lids`
--

CREATE TABLE `lids` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `lids`
--

INSERT INTO `lids` (`id`, `date`, `email`, `name`, `phone`, `city`, `ip`) VALUES
(38, '2024-04-24 06:46:25', 'dglemingg@gmail.com', 'Зайцев Кирилл Александрович', '+79028465203', 'Tula', '127.0.0.1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bans`
--
ALTER TABLE `bans`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lids`
--
ALTER TABLE `lids`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bans`
--
ALTER TABLE `bans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `lids`
--
ALTER TABLE `lids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
