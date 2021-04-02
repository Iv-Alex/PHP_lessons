-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 02 2021 г., 06:21
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `comments`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `text`, `timestamp`) VALUES
(1, 'dsgsdfg', 'asdfsdf@dsff.dh', 'dfgsdfgsdfg', '2021-04-01'),
(2, 'dfgsdfgsdfg', 'vanomib@mail.ru', 'rtyertyertyertyerty', '2021-04-01'),
(3, 'dfsd', 'dddd@ddd.rt', 'dfdfgdfgh', '2021-04-01'),
(4, 'sdfsdf', 'korefano@kuzminki48.ru', 'sdfsdf', '2021-04-01'),
(5, 'aaaaaa', 'fffff@ddddd.ru', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2021-04-02'),
(6, 'aaaaaa', 'fffff@ddddd.ru', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2021-04-02'),
(7, 'aaaaaa', 'fffff@ddddd.ru', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2021-04-02'),
(8, 'aaaaaa', 'fffff@ddddd.ru', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2021-04-02'),
(9, 'aaaaaa', 'fffff@ddddd.ru', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2021-04-02'),
(10, 'aaaaaa', 'fffff@ddddd.ru', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2021-04-02'),
(11, 'aaaaaa', 'fffff@ddddd.ru', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2021-04-02'),
(12, 'aaaaaa', 'fffff@ddddd.ru', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2021-04-02'),
(13, 'aaaaaa', 'fffff@ddddd.ru', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2021-04-02'),
(14, 'aaaaaa', 'fffff@ddddd.ru', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2021-04-02'),
(15, 'aaaaaa', 'fffff@ddddd.ru', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '2021-04-02');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timestamp_key` (`timestamp`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
