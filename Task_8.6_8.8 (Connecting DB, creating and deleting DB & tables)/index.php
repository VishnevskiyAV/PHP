<?php
/* Подключитесь к своей базе данных, обработав ошибку подключения, а также установив кодировку соединения utf8mb4.*/ 

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'date');

/* Укажите неправильные данные для подключения, чтобы проверить обработку ошибки.*/ 

$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) exit('Ошибка соединения с БД');
echo $mysqli->character_set_name().'<br />';
$mysqli->set_charset('utf8mb4');

/* Создайте через PHP новую базу данных.*/ 
/* Убедитесь, что она появилась.*/ 

$mysqli->query('CREATE DATABASE `database`').'<br />';

/* Удалите через PHP созданную базу данных в 3-м задании.*/ 

$mysqli->query('DROP DATABASE `database`').'<br />';


/*Откройте SQL-файл из упражнения, где Вы делали экспорт своей таблицы из базы данных.*/ 
/* Найдите SQL-запрос, где создаётся таблица с часовыми поясами.*/ 
/* Через PHP создайте новую базу данных и добавьте в неё таблицу с часовыми поясами, используя код, найденный в предыдущем задании.*/ 

$mysqli->query('CREATE DATABASE `time`').'<br />';
$mysqli->close();

$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, 'time');
if ($mysqli->connect_errno) exit('Ошибка соединения с БД');
$mysqli->set_charset('utf8mb4');

$query = "CREATE TABLE `tmeless` (
    `id` int UNSIGNED NOT NULL,
    `title` varchar(255) NOT NULL,
    `offset` int NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    echo $mysqli->query($query).'<br />';
    echo $mysqli->error.'<br />';

$index = "ALTER TABLE `tmeless`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `offset` (`offset`)";
    echo $mysqli->query($index).'<br />';
    echo $mysqli->error.'<br />';

$mysqli->close();

?>