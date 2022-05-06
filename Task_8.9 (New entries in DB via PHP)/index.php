<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'date');

$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) exit('Ошибка соединения с БД');
$mysqli->set_charset('utf8mb4');

/* Сделайте форму с двумя текстовыми полями: "Часовой пояс" и "Смещение".*/ 
/* Получите данные из формы после её отправки.*/ 
/* Сделайте данные безопасными, проверьте их на корректность.*/ 

if (isset($_POST['reg'])) {
    $timezone = $_POST['timezone']?? false;
    $offset = $_POST['offset']?? false;
    $result = false;
    $error = false;
    if (is_string($timezone) && is_numeric($offset)) {
        if (mb_strlen($timezone) > 2 && $offset != false) {
            $timezone = $mysqli->real_escape_string(htmlspecialchars($timezone));
            $offset = $mysqli->real_escape_string(htmlspecialchars($offset*3600));
            $query = "INSERT INTO `tmeless` (`title`, `offset`) VALUES ('$timezone', '$offset')";
            $result=$mysqli->query($query);
            echo $mysqli->insert_id;
            echo $mysqli->error.'<br />';
        } else $error = 'Неверная часовая зона или не указано смещение'; 
    }else $error = 'Неверная часовая зона или не указано смещение'; 

}

/* Добавьте в таблицу с часовыми поясами новую запись с данными, полученными из формы.*/ 
/* Используя phpMyAdmin, узнайте синтаксис изменения и удаления записей.*/ 
/* Создайте отдельный скрипт, где добавьте произвольную запись в таблицу с часовыми поясами.*/ 

/*$query = "INSERT INTO `tmeless` (`title`, `offset`) VALUES ('South America', '-18000')";
echo $mysqli->query($query);
echo $mysqli->error;

/* Измените значения поля offset и title у добавленной записи. Проверьте это. Безусловно, далее мы обязательно будем рассматривать 
и обновление, и удаление записей. Но мне бы очень хотелось, чтобы Вы научились получать новые знания самостоятельно. 
Поэтому попытайтесь освоить этот материал сами.*/ 

$query = "UPDATE `tmeless` SET `title` = 'South America', `offset` = '-18000' WHERE `tmeless`.`id` = 18"; 
echo $mysqli->query($query);
echo $mysqli->error;

/* Удалите эту запись. Убедитесь, что запись действительно исчезла из таблицы.*/
$mysqli->query("DELETE FROM `tmeless` WHERE `tmeless`.`id` = 18;");

$mysqli->close();

?>
<?php if (isset($result)) { ?>
    <?php if ($result) { ?>
        <p>Запись удачно добавлена!</p>
    <?php } else { ?>
        <p>Error: <?=$error?>!</p>
    <?php } ?>
<?php } ?>

<form name ="reg" action="" method="post">
    <p>
        Часовой пояс:       <input type="text" name="timezone" />
    </p>
    <p>
        Смещение (в часах): <input type="text" name="offset" />
    </p>
    <p>
        <input type="submit" name="reg" value="Отправить" />
    </p>
</form>
