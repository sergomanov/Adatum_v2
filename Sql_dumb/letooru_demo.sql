CREATE TABLE IF NOT EXISTS `commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `mode` text NOT NULL,
  `address` text NOT NULL,
  `vale` text NOT NULL,
  `laststate` text NOT NULL,
  `unixtime` int(11) NOT NULL,
  `cond` text NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1017 ;

--
-- Дамп данных таблицы `commands`
--

INSERT INTO `commands` (`id`, `name`, `mode`, `address`, `vale`, `laststate`, `unixtime`, `cond`, `id_user`) VALUES
(8, 'Включение устройства', 'EML', '00-00-00-00-00-00', 'sergomanov@mail.ru,Включение,тест', '', 0, '0', 3),
(969, 'Включить сигнализацию', 'ACT', '00-00-00-00-00-00', '83,1', '', 0, '0', 2),
(970, 'Пульт нижняя кнопка', 'RF', '74-69-69-2D-30-31', '2683969,24,190', '2683969,24,190', 1426666449, '0', 3),
(973, 'Звук', 'MU', '74-69-69-2D-30-31', '100,10', '', 0, '0', 3),
(984, 'мигаем', 'LED', '74-69-69-2D-30-31', '200,5', '', 0, '0', 3),
(998, '78978978', 'HUM', '74-69-69-2D-30-31', '77', '78', 1426668541, '1', 3),
(1003, 'key30', 'LUM', '74-69-69-2D-30-31', '1', '', 0, '0', 3),
(1005, 'зал', 'KEY', '74-69-69-2D-30-32', '65,1,55', '', 0, '', 2),
(1006, 'СМС', 'SMS', '00-00-00-00-00-00', '79230000000,привет', '', 0, '0', 2),
(1007, 'зал', 'KEY', '74-69-69-2D-30-32', '65,1,55', '', 0, '', 2),
(1008, 'Включить сигнализацию', 'ACT', '00-00-00-00-00-00', '83,1', '', 0, '0', 3),
(1009, 'зал', 'KEY', ' 43-63-63-63-56-99', '65,1,55', '', 0, '', 0),
(1012, 'ggh', 'HUM', '74-69-69-2D-30-31', '69', '51', 1426668588, '2', 3),
(1013, 'Откл устройства', 'ONLINE', '74-69-69-2D-30-77', '0', '0', 1426670968, '0', 3),
(1014, 'Вкл устройства', 'ONLINE', '74-69-69-2D-30-77', '1', '1', 1426670357, '0', 3),
(1015, '', '0', '00-00-00-00-00-00', '', '', 0, '', 2),
(1016, 'Отключение устройства', 'EML', '00-00-00-00-00-00', 'sergomanov@mail.ru,Отключение,тест', '', 0, '0', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `coordinates`
--

CREATE TABLE IF NOT EXISTS `coordinates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idn` text NOT NULL,
  `coor` text NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `coordinates`
--

INSERT INTO `coordinates` (`id`, `idn`, `coor`, `id_user`) VALUES
(1, 'r_left_78', '512', 3),
(2, 'r_top_78', '-465', 3),
(3, 'r_left_149', '659', 3),
(4, 'r_top_149', '-538', 3),
(5, 'tr_left_5', '184', 3),
(6, 'tr_top_5', '-783', 3),
(7, 'tr_left_36', '186', 3),
(8, 'tr_top_36', '-748', 3),
(9, '', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `developments`
--

CREATE TABLE IF NOT EXISTS `developments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` text NOT NULL,
  `vale` text NOT NULL,
  `address` text NOT NULL,
  `unixtime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11627 ;


--
-- Структура таблицы `namedev`
--

CREATE TABLE IF NOT EXISTS `namedev` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `name` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `unixtime` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Дамп данных таблицы `namedev`
--

INSERT INTO `namedev` (`id`, `address`, `name`, `id_user`, `unixtime`, `state`) VALUES
(14, '74-69-69-2D-30-32', 'Спальня', 2, 1426656876, 0),
(16, '00-00-00-00-00-00', 'Сервер', 0, 0, 0),
(26, ' 43-63-63-63-56-99', 'Комн серв', 1, 0, 0),
(29, '74-69-69-2D-30-31', 'Работа', 3, 1426729044, 1),
(30, '74-69-69-2D-30-77', 'Работа77', 3, 1426670351, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `run`
--

CREATE TABLE IF NOT EXISTS `run` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `vale` text NOT NULL,
  `unixtime` int(11) NOT NULL,
  `run` int(11) NOT NULL,
  `mode` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=180 ;

--
-- Структура таблицы `scheduler`
--

CREATE TABLE IF NOT EXISTS `scheduler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `switch` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `time` text NOT NULL,
  `weekdays` text NOT NULL,
  `monthdays` text NOT NULL,
  `month` text NOT NULL,
  `timer` text NOT NULL,
  `timein` text NOT NULL,
  `timeout` text NOT NULL,
  `conditions` text NOT NULL,
  `commands` text NOT NULL,
  `timerun` int(11) NOT NULL,
  `ico` text NOT NULL,
  `drivers` text NOT NULL,
  `color` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=156 ;

--
-- Дамп данных таблицы `scheduler`
--

INSERT INTO `scheduler` (`id`, `switch`, `id_user`, `name`, `type`, `time`, `weekdays`, `monthdays`, `month`, `timer`, `timein`, `timeout`, `conditions`, `commands`, `timerun`, `ico`, `drivers`, `color`) VALUES
(6, 1, 2, 'Еженедельно', '6', '13:10:51', '1,3,4,5,6', '', '', '', '', '', '', '', 1426684297, '', '', ''),
(7, 1, 2, 'Ежемесячно', '7', '12:10:51', '', '1,2,3,27,31', '', '', '', '', '', '973', 1425298253, '', '', ''),
(63, 1, 3, 'По сигналу ', '4', '', '', '', '', '', '1424354135', '1424354136', '9', '8,973', 1426666449, '', '', ''),
(70, 1, 3, 'По таймеру', '1', '', '', '', '', '360', '1424354115', '1460731430', '', '984', 1426729039, '', '', ''),
(78, 0, 3, 'Мигаем', '3', '', '', '', '', '', '', '', '1005', '984', 0, ' icon-lamp', '', '#78cf50'),
(83, 0, 1, 'Один раз', '2', '', '', '', '', '', '1425047145', '', '', '8', 1426668550, '', '', ''),
(84, 0, 1, 'Ежедневно', '5', '13:16:51', '', '', '', '', '', '', '', '973', 1425309411, '', '', ''),
(109, 0, 1, 'Год', '8', '15:07:42', '', '27', '2', '', '', '', '', '970', 1425050644, '', '', ''),
(133, 0, 3, '74-69-69-2D-30-31', '10', '', '', '', '', '', '', '', '', '', 0, '', '5,36', '#5367ce'),
(136, 0, 1, 'Камера в зале', '9', '', '', '', '', '', '', '', '', '', 0, '', '192.189.12.12/img.php', ''),
(142, 0, 1, 'Бра в зале', '3', '', '', '', '', '', '', '', '1005', '1004', 0, 'icon-crown', '', '#2a45d1'),
(144, 0, 0, '', '0', '', '', '', '', '1', '', '', '', '', 0, '', '', ''),
(149, 0, 3, 'Мигаем7', '3', '', '', '', '', '', '', '', '1005', '984,984', 0, ' icon-lamp', '', '#78cf50'),
(151, 1, 3, 'сигнал hum>77', '4', '', '', '', '', '', '1422798915', '1487429030', '998', '1008,1007,973', 1426668541, '', '', ''),
(152, 1, 3, 'сигнал hum>79', '4', '', '', '', '', '', '1422798915', '1487429030', '1012', '973', 1426668588, '', '', ''),
(154, 1, 3, 'отклю', '4', '', '', '', '', '', '1422798935', '1549029336', '1013', '1016', 1426670968, '', '', ''),
(155, 1, 3, 'вклю', '4', '', '', '', '', '', '1422798935', '1549029336', '1014', '8', 1426670357, '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id_sess` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` int(5) NOT NULL,
  `code_sess` varchar(15) NOT NULL,
  `user_agent_sess` varchar(255) NOT NULL,
  `date_sess` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `used_sess` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_sess`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Структура таблицы `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` text NOT NULL,
  `name` text NOT NULL,
  `namevalue1` text NOT NULL,
  `namevalue2` text NOT NULL,
  `namevalue3` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `ico` text NOT NULL,
  `symbol` text NOT NULL,
  `regim` int(11) NOT NULL,
  `color` text NOT NULL,
  `tchart` int(11) NOT NULL,
  `control` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Дамп данных таблицы `type`
--

INSERT INTO `type` (`id`, `mode`, `name`, `namevalue1`, `namevalue2`, `namevalue3`, `id_user`, `type`, `ico`, `symbol`, `regim`, `color`, `tchart`, `control`) VALUES
(1, 'LUM', 'Освещённость', 'Овещённость', '', '', 1, 1, 'icon-lamp', 'L', 1, '#78cf50', 0, 0),
(2, 'TEM', 'Температура', 'Температура', '', '', 1, 1, ' icon-temperatire', 'С°', 1, '#c23c2a', 0, 0),
(3, 'HUM', 'Влажность', 'Влажность', '', '', 3, 1, 'icon-tint', '%', 1, '#3f2ac2', 0, 0),
(4, 'EML', 'Отправка E-mail сообщения', 'Адрес E-mail', 'Заголовок письма', 'Текст письма', 0, 3, 'icon-mail-7', '', 3, '', 0, 0),
(5, 'P', 'Давление', 'Давление', '', '', 3, 1, 'icon-hammer', 'Па', 1, '#9c7d30', 0, 0),
(6, 'MU', 'Звуковой сигнал', 'Частота сигнала', 'Длительность', '', 2, 2, 'icon-bullhorn', '', 3, '#435cd9', 0, 0),
(7, 'BEEP', 'Уровень шума', 'Уровень шума', '', '', 3, 1, 'icon-sound-1', '', 1, '#23222b', 0, 0),
(8, 'IR', 'ИК Пульт', 'Производитель', 'Код устройства', 'Частота шины', 1, 3, 'icon-keyboard', '', 0, '', 0, 0),
(9, 'ACT', 'Активация правил', 'Номер правила', 'Состояние правила', '', 0, 2, 'icon-shuffle-3', '', 3, '#b539bf', 1, 0),
(10, 'KEY', 'Нажатие кнопки', 'Номер реле', 'Состояние устройства (ON , OFF, Яркость от 0 до 10000)', 'Длительность ', 3, 3, 'icon-keyboard', '', 0, '', 1, 0),
(16, 'LED', 'Световая сигнализация', 'Длительность(милсек)', 'Количество', '', 3, 2, 'icon-lamp-1', '', 3, '#bbc452', 0, 0),
(17, 'iBN', 'iButton ключ', 'Тип ключа', 'Код устройства', '', 3, 2, 'icon-key', '', 1, '#2ec7ab', 1, 0),
(18, 'PIR', 'Движение', 'Движение', '', '', 2, 1, 'icon-ticket-2', '', 1, '', 0, 0),
(19, 'RF', 'Радиомодуль 315Мгц.', 'Код устройства', 'Частота шины', 'Длительность сигнала', 2, 3, 'icon-signal-3', '', 0, '', 0, 0),
(24, 'LUM', 'Освещённость', 'Овещённость', '', '', 2, 1, 'icon-lamp', 'L', 1, '#78cf50', 0, 0),
(25, 'KEY', 'Нажатие кнопки', 'Номер реле', 'Состояние устройства (ON , OFF, Яркость от 0 до 10000)', 'Длительность ', 2, 3, 'icon-keyboard', '', 0, '#d61a8b', 1, 0),
(27, 'TEM', 'Температура', 'Температура', '', '', 2, 1, ' icon-temperatire', 'С°', 1, '#c23c2a', 0, 0),
(29, 'P', 'Давление', 'Давление', '', '', 2, 1, 'icon-hammer', 'Па', 1, '#9c7d30', 0, 0),
(33, 'LED', 'Световая сигнализация', 'Длительность(милсек)', 'Количество', '', 2, 2, 'icon-lamp-1', '', 3, '#bbc452', 0, 0),
(34, 'HUM', 'Влажность', 'Влажность', '', '', 2, 1, 'icon-tint', '%', 1, '#3f2ac2', 0, 0),
(35, 'LUM', 'Освещённость', 'Овещённость', '', '', 3, 1, 'icon-lamp', 'L', 1, '#78cf50', 0, 0),
(36, 'TEM', 'Температура', 'Температура', '', '', 3, 1, ' icon-temperatire', 'С°', 1, '#c23c2a', 0, 0),
(37, 'RF', 'Радиомодуль 315Мгц.', 'Код устройства', 'Частота шины', 'Длительность сигнала', 3, 3, 'icon-signal-3', '', 0, '', 0, 0),
(38, 'PIR', 'Движение', 'Движение', '', '', 3, 1, 'icon-ticket-2', '', 1, '', 0, 0),
(39, 'MU', 'Звуковой сигнал', 'Частота сигнала', 'Длительность', '', 3, 2, 'icon-bullhorn', '', 3, '#435cd9', 0, 0),
(40, 'IR', 'ИК Пульт', 'Производитель', 'Код устройства', 'Частота шины', 3, 3, 'icon-keyboard', '', 0, '', 0, 0),
(41, 'SMS', 'Отправка SMS сообщения', 'Номер телефона', 'Текст сообщения', '', 0, 2, 'icon-mobile-alt', '', 3, '#a52cb0', 0, 0),
(42, 'KEY', 'Нажатие кнопки', 'Номер реле', 'Состояние устройства (ON , OFF, Яркость от 0 до 10000)', 'Длительность ', 1, 3, 'icon-keyboard', '', 0, '', 1, 0),
(43, 'ONLINE', 'Устройство в сети', 'Состояние устройства (0-выкл, 1-вкл)', '', '', 0, 1, 'icon-share-squared', '', 1, '#5cd90f', 0, 0),
(44, '', '', '', '', '', 2, 4, 'icon-mail', '', 3, '#5367ce', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `login_user` varchar(60) NOT NULL,
  `passwd_user` varchar(255) NOT NULL,
  `mail_user` varchar(255) NOT NULL,
  `key_user` varchar(10) NOT NULL,
  `timezone` int(11) NOT NULL,
  `img` text NOT NULL,
  `calendar` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login_user`, `passwd_user`, `mail_user`, `key_user`, `timezone`, `img`, `calendar`) VALUES
(0, 'Система', '', '', '', 0, '', 0),
(1, 'admin', '53a2e0f8485a1da00509e3cc6bf40e0b', 'sergomanov@mail.ru', 'yA4gAjQ4xC', 0, '/feditor/attached/image/20150313/20150313102144_79301.jpg', 0),
(2, 'demo', '53a2e0f8485a1da00509e3cc6bf40e0b', 'demo@demo.ru', 'yA4gAjQ4xC', 25200, '/feditor/attached/image/20150313/20150313102144_79301.jpg	', 1),


