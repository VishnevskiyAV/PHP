<?php
/*Сделайте форму с выпадающим списком, куда выведите все часовые пояса 
(разумеется, достаточно только title и id в качестве атрибута value у тега <option>).*/
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'date');

try {
    $pdo = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo 'Ошибка при подключении к базе данных: '.$e->getMessage();
}

$result_set = $pdo->query ('SELECT * FROM `tmeless`');
$row = $result_set->fetchAll(PDO::FETCH_ASSOC);

/*При отправке формы получите информацию о данном часовом поясе из соответствующей таблицы 
и выведите данные во вторую форму на странице с полями: "Название часового пояса" и "Смещение".*/

$timezone = false;
if (isset($_POST['time'])) $timezone = $_POST['time']?? false;

$result = ("SELECT `id`,`offset` FROM `tmeless` WHERE `title` = ? ");
$result = $pdo->prepare($result);
$result->execute([$timezone]);
$result = $result->fetchAll(PDO::FETCH_ASSOC);


/* Далее пользователь может изменить данные в этой форме и нажать кнопку "Сохранить".*/ 
$title = false;
$offset = false;
$id = false;
if (isset($_POST['offset'])) $title = $_POST['title'] ?? false;
if (isset($_POST['title'])) $offset = $_POST['offset'] ?? false;
if (isset($_POST['id'])) $id = $_POST['id'] ?? false;


/* Примите эти новые данные и измените старые значения title и offset на новые у данного часового пояса 
(разумеется, во второй форме потребуется так же хранить id, например, в input с типом hidden).*/

if (is_string($title) && is_numeric($offset)) {
        $offset = $offset * 3600;
        $query = "UPDATE `tmeless` SET `title` = :title, `offset` = :offset WHERE `tmeless`.`id` = :id";
        $query = $pdo->prepare($query);
        $query->execute(['title' => "$title" , 'offset' => "$offset" , 'id' => $id]);
        if ($query->execute() == true) echo 'Изменения внесены'; else  echo $pdo->errorCode().'<br />';
} 

/* Убедитесь, что всё работает правильно.*/ 


/* Перепишите все задания с изменением часовых поясов по выбору пользователя (то есть, снова те же 2 формы), но с использование PDO.*/ 

$pdo = false;

?>
<form name="form_3" action="" method="post">
    <h4>Choose the timezone</h4>
    <select name="time"> 
        <option value=''></option>
        <? foreach ($row as $k => $v) { ?>
        <option value="<?=$v['title']?>"><?=$v['title']?></option>
        <? } ?>
    </select>
    <input type="submit" value="Get the offset" />
</form>
<form name="offset_form" action="" method="post">
    <h4>Можете изменить данные смещения часового пояса:</h4>
    <br>
     Временаая зона: <input type="text" name="title" value = "<?=$timezone?>"/>
    <br />
    <br>
     Смещение (в часах) <input type="text" name="offset" <?php if ($result != false) $off=$result[0]['offset']/3600; else $off = false?> value ="<?=$off?>"/>
    <br>
    <input type="hidden" name="id" value ="<?=$result[0]['id']??false?>" />
    <br />
    <input type="submit" value="Сохранить" />
</form>
