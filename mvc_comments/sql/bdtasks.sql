-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 07 2021 г., 09:43
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
-- База данных: `iv_alex`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(258) NOT NULL,
  `text` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `email`, `text`, `status`) VALUES
(1, 'Mikhail', 'test@test.ru', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.dfg sdfg sdgsdf\r\n        Asperiores, debitis? Illum ullam eligendi exercitationem! Sunt esse reiciendis,\r\n        minus nemo sed totam in laboriosam. Ducimus, saepe. Ipsum vel aliquam sint quia!\r\n        FOOBAR', 2),
(2, 'Mikhail', 'test1@test.ru', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. ffffgsdfgsdg\r\n        Asperiores, debitis? Illum ullam eligendi exercitationem! Sunt esse reiciendis,\r\n        minus nemo sed totam in laboriosam. Ducimus, saepe. Ipsum vel aliquam sint quia!\r\n        FOOBAR', 2),
(3, 'Mikhail', 'test@test.ru', '        FOOBAR fffsdfsdfg dfgsdfg fsdfg asd s dgxbxbcvbxcvbxcvb', 2),
(15, 'uga', 'znanie@logycon.ru', 'Перевод с английского, немецкого, французского, испанского, польского, турецкого и других языков на русский и обратно. Возможность переводить ...', 0),
(16, 'uga', 'vanomib@mail.ru', 'Создание функционирующего веб-прv zxcv zxcvиложения – это только полдела. Современные онлайн-сервисы и веб-приложения, помимо собственного контента, хранят данные пользователей. Защита этих данных зависит от правильно написанного кода с точки зрения надёжности и безопасности.', 2),
(17, 'vanomib', 'vanomib@mail.ru', 'Яндекс - поисковая система и интернет-портал. Поиск по интернету и другие сервисы: карты и навигатор, транспорт и такси, погода, новости, музыка, ..', 0),
(18, 'jlhjkl', 'korefano@kuzminki48.ru', 'fhjfgjjhfg gfsdfgsdfg', 2),
(19, 'admin', 'vanomib@mail.ru', 'dfgsfdfgsdgsdfg', 0),
(20, '34525245', 'znanie@logycon.ru', '43253adadf', 0),
(21, 'admin', 'vanomib@mail.ru', '4325235235235', 0),
(22, 'admin', 'vanomib@mail.ru', '4325235235235fafsf', 2),
(23, 'admin', 'vanomib@mail.ru', '4325235235235', 0),
(24, 'uga', 'dfgsdf@dfdfgsfgsdfgf.ru', 'hfghdfhg df df dfh', 0),
(25, 'admin', 'vanomib@mail.ru', '<script>alert(\'xss\');</script>', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `task_status`
--

CREATE TABLE `task_status` (
  `id` int(11) NOT NULL,
  `binary_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `setting` enum('unactive','in_form','on_edit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task_status`
--

INSERT INTO `task_status` (`id`, `binary_id`, `status`, `setting`) VALUES
(1, 1, 'Выполнено', 'in_form'),
(2, 2, 'Отредактировано администратором', 'on_edit'),
(3, 4, 'Additional status 1', 'unactive'),
(4, 8, 'Additional status 2', 'unactive'),
(5, 16, 'Additional status 3', 'unactive'),
(6, 32, 'Additional status 4', 'unactive');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd_hash` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `auth_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `updated`, `name`, `email`, `pwd_hash`, `role`, `auth_token`) VALUES
(4, '2021-03-07 06:39:07', 'admin', 'temp@logycon.ru', '$2y$10$2pGmHdVkL8chssD5P/fJxutusuxgMO4oNxXiLhB.o0dHjt24E2Jt2', 'admin', '3f5f0d09d9ce66a8333f2b2e8fc6e59e946938985c9d3709af4a2f972bca6e93005dfb527a4b9202'),
(5, '2021-03-07 06:41:17', 'uga', 'new_dir@logycon.ru', '$2y$10$cDSup73FTMxEFWUtc8ndo.VbE/N60dX/fgewlfwgC1NqqUdAawKSu', 'admin', '4d3e299351d0cdc341741ed3daf71d2555a63009c632dd6ac00ccca563d3c54274f67f21e297203e');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `task_status`
--
ALTER TABLE `task_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
