-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 08 2022 г., 17:26
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `date`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tmeless`
--

CREATE TABLE `tmeless` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `offset` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tmeless`
--

INSERT INTO `tmeless` (`id`, `title`, `offset`) VALUES
(16, 'New York', -14400),
(17, 'Australia', 36000),
(20, 'Rus\\Msk', 10800);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tmeless`
--
ALTER TABLE `tmeless`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `offset` (`offset`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tmeless`
--
ALTER TABLE `tmeless`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
