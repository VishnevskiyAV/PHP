<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'date');

function printResultSet(mysqli_result $result_set) {
    $table = [];
    while ($row = $result_set->fetch_assoc()) {
        $table[] = $row;
    }return $table;
}

$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($mysqli->connect_errno) exit('Ошибка соединения с БД');
$mysqli->set_charset('utf8mb4');

/* Получите массив всех часовых поясов в таблице.*/ 

$result_set = $mysqli->query ('SELECT * FROM `tmeless`');
printResultSet($result_set);

/* Выведите их title в форме у пользователя в виде списка (select).*/ 
// Вывел сразу в форме

/* После выбора пользователем элемента списка и отправки формы необходимо из таблицы вытащить 
соответствующее смещение для данного часового пояса и вывести его пользователю в формате: "Смещение от Гринвича: offset секунд".*/ 
$timezone = false;
if (isset($_POST['time'])) $timezone = $_POST['time']?? false;


$result = $mysqli->query("SELECT `offset` FROM `tmeless` WHERE `title` = '$timezone'");
$result = printResultSet($result);


$mysqli->close();
?>
<form name="form_3" action="" method="post">
    <h4>Choose the timezone</h4>
    <select name="time" multiple="multiple"> 
        <? foreach ($result_set as $k=>$v) { ?>
        <option value="<?=$v['title']?>"><?=$v['title']?></option>
        <? } ?>
    </select>
    <input type="submit" value="Get the offset" />
</form>
<?php echo 'Смещение от Гринвича:'.$result[0]['offset'].' секунд' ?>