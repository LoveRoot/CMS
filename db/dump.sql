-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 02 2014 г., 18:01
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `p_id` int(5) NOT NULL,
  `author` varchar(90) CHARACTER SET cp1251 NOT NULL,
  `text` text CHARACTER SET cp1251 NOT NULL,
  `date` varchar(70) NOT NULL,
  `email` varchar(120) CHARACTER SET cp1251 NOT NULL,
  `ip` varchar(120) CHARACTER SET cp1251 NOT NULL,
  `hidden` int(5) NOT NULL,
  `id_post` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `p_id`, `author`, `text`, `date`, `email`, `ip`, `hidden`, `id_post`) VALUES
(20, 19, 'root', 'требуя, чтобы к ним вышел генеральный директор клуба Денис Маслов. В сотрудников полиции прилетели бутылки и петарды.\n\nТипа того', '1401028545', '', '192.168.1.34', 0, 3),
(19, 0, 'custom', 'Фанаты «Крыльев» после игры бросали на футбольное поле шарфы и другую атрибутику клуба, а позже кричали «Выходи!», требуя, чтобы к ним вышел \r\nгенеральный директор клуба Денис Маслов. В сотрудников полиции прилетели\r\n бутылки и петарды.', '1401028522', '', '192.168.1.34', 0, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `config`
--

INSERT INTO `config` (`id`, `config`) VALUES
(1, 'a:2:{s:6:"params";a:4:{s:9:"site_name";s:38:"ROOT_CMS - Название сайта";s:11:"description";s:38:"ROOT_CMS - Описание сайта";s:8:"keywords";s:38:"ROOT_CMS - Ключевые слова";s:8:"template";s:7:"default";}s:4:"save";s:18:"Применить";}');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  `police` int(11) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `police`, `permissions`) VALUES
(1, 'Администратор', 1, 'a:2:{s:4:"site";N;s:5:"admin";a:8:{s:7:"options";a:1:{s:6:"status";s:2:"on";}s:5:"pages";a:1:{s:6:"status";s:2:"on";}s:5:"users";a:1:{s:6:"status";s:2:"on";}s:6:"groups";a:1:{s:6:"status";s:2:"on";}s:7:"mailing";a:1:{s:6:"status";s:2:"on";}s:6:"slider";a:1:{s:6:"status";s:2:"on";}s:11:"application";a:1:{s:6:"status";s:2:"on";}s:6:"events";a:1:{s:6:"status";s:2:"on";}}}'),
(2, 'Модератор', 0, 'a:2:{s:4:"site";N;s:5:"admin";a:8:{s:7:"options";a:1:{s:6:"status";s:2:"on";}s:5:"pages";a:1:{s:6:"status";s:2:"on";}s:5:"users";a:1:{s:6:"status";s:2:"on";}s:6:"groups";a:1:{s:6:"status";s:2:"on";}s:7:"mailing";a:1:{s:6:"status";s:2:"on";}s:6:"slider";a:1:{s:6:"status";s:2:"on";}s:11:"application";a:1:{s:6:"status";s:2:"on";}s:6:"events";a:1:{s:6:"status";s:2:"on";}}}'),
(3, 'Опытный пользователь', 0, ''),
(4, 'Пользователь', 0, ''),
(8, 'Своя группа', 0, ''),
(9, 'Гость', 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) NOT NULL,
  `theme` varchar(40) NOT NULL,
  `type` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `respons` int(5) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `views` int(5) NOT NULL,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `mail`
--

INSERT INTO `mail` (`id`, `author`, `theme`, `type`, `message`, `respons`, `date_time`, `views`, `link`) VALUES
(1, 'Сергей', 'Форма обратной связи', 'Жалоба', 'Не работает форма обратной связи', 0, '2013-06-21 07:22:52', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `mailing`
--

CREATE TABLE IF NOT EXISTS `mailing` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `status` varchar(2) NOT NULL,
  `secret` text NOT NULL,
  `id_group` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `mailing`
--

INSERT INTO `mailing` (`id`, `email`, `status`, `secret`, `id_group`) VALUES
(1, 'web-mastack@yandex.ru', '1', '093f65e080a295f8076b1c5722a46aa2', 1),
(2, 'developers@region-media-yug.ru', '1', '32bb90e8976aab5298d5da10fe66f21d', 0),
(3, 'seo@region-media-yug.ru', '1', 'a684eceee76fc522773286a895bc8436', 0),
(4, 'OERMAKOV@DOPTEHNIKA.RU', '1', '35f4a8d465e6e1edc05f3d8ab658c551', 24);

-- --------------------------------------------------------

--
-- Структура таблицы `mailing_groups`
--

CREATE TABLE IF NOT EXISTS `mailing_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Дамп данных таблицы `mailing_groups`
--

INSERT INTO `mailing_groups` (`id`, `name`) VALUES
(1, 'Моя группа');

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  `caption` varchar(90) NOT NULL,
  `status` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `name`, `caption`, `status`, `sort`) VALUES
(1, 'options', 'Настройки', 1, 0),
(2, 'pages', 'Страницы', 1, 0),
(3, 'users', 'Учётные записи', 1, 0),
(4, 'groups', 'Группы для учётных записей', 1, 0),
(5, 'mailing', 'Рассылки', 1, 0),
(6, 'slider', 'Ротатор изображений', 1, 0),
(7, 'application', 'Заявки', 1, 0),
(8, 'events', 'События на сайте', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `online`
--

CREATE TABLE IF NOT EXISTS `online` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user` varchar(90) CHARACTER SET cp1251 NOT NULL,
  `os` varchar(90) CHARACTER SET latin1 NOT NULL,
  `ip` varchar(90) CHARACTER SET latin1 NOT NULL,
  `browser` varchar(90) NOT NULL,
  `referer` text CHARACTER SET latin1 NOT NULL,
  `page` varchar(90) NOT NULL,
  `time` varchar(90) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=267695 ;

--
-- Дамп данных таблицы `online`
--

INSERT INTO `online` (`id`, `user`, `os`, `ip`, `browser`, `referer`, `page`, `time`) VALUES
(267694, 'root', 'Linux / UNIX', '127.0.0.1', 'Mozilla Firefox', '???????', '/favicon.ico', '1407600287');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `h1` varchar(80) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `keywords` varchar(80) NOT NULL,
  `short_content` text NOT NULL,
  `full_content` text NOT NULL,
  `noindex` int(2) NOT NULL,
  `status` int(2) NOT NULL,
  `is_catalog` int(2) NOT NULL,
  `page_type` varchar(20) NOT NULL,
  `template` varchar(30) NOT NULL,
  `sort` int(5) NOT NULL,
  `p_id` int(5) NOT NULL,
  `system` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `h1`, `title`, `description`, `keywords`, `short_content`, `full_content`, `noindex`, `status`, `is_catalog`, `page_type`, `template`, `sort`, `p_id`, `system`) VALUES
(1, 'Главная', 'Главная', 'Главная страница', 'Главная страница', 'Главная страница', 'Главная страница', '', 0, 1, 1, 'main', 'default', 0, 0, 1),
(2, 'Новости', 'Новости', 'Новости', 'Новости', 'Новости', 'Новости', '', 0, 1, 1, 'news', 'news', 0, 1, 0),
(3, 'Новости2', 'Новости2', 'Новости2', '', '', 'Подновости', '', 0, 1, 1, 'news', 'news', 0, 0, 0),
(4, 'Погода', 'Погода', 'Погода', '', '', '', '', 0, 0, 1, 'html', '', 0, 0, 0),
(6, 'Тест', 'Тест', 'Тест', '', '', '', '', 0, 1, 0, 'news', '', 0, 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(70) NOT NULL,
  `module` varchar(60) NOT NULL,
  `action` int(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `login` varchar(90) CHARACTER SET utf8 NOT NULL,
  `password` text CHARACTER SET utf8 NOT NULL,
  `email` varchar(90) CHARACTER SET utf8 NOT NULL,
  `ip` varchar(90) NOT NULL,
  `is_reg` varchar(120) NOT NULL,
  `status` int(5) NOT NULL,
  `groups` int(5) NOT NULL,
  `police` int(4) NOT NULL,
  `security` varchar(190) NOT NULL,
  `salt` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=169 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `ip`, `is_reg`, `status`, `groups`, `police`, `security`, `salt`) VALUES
(1, 'root', 'tt1JLPQ5hbV.A ', 'web-mastack@yandex.ru', '192.168.1.34', '', 1, 1, 1, 'c5d9d37a87e654c20ce1cb661f9815b5f3a34807', 'tttfd'),
(162, 'test', '17DEoLCrgxu5g', 'web-mastack121@yandex.ru', '192.168.1.34', '1401382270', 1, 2, 0, '87dcabcc79489d75081ad9d337c04589cbdbdf2b', '177785387657ece4ff');

-- --------------------------------------------------------

--
-- Структура таблицы `user_properties`
--

CREATE TABLE IF NOT EXISTS `user_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `patronymic` varchar(80) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `avatar` varchar(30) NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `user_properties`
--

INSERT INTO `user_properties` (`id`, `name`, `patronymic`, `lastname`, `city`, `country`, `phone`, `description`, `avatar`, `p_id`) VALUES
(6, '', '', '', '', '', '', '', 'logo.jpg', 1),
(7, 'Сергей', '', 'Новоселецкий', 'Краснодар', 'Россия', '', 'Дополнительная информация о себе', '', 162);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
