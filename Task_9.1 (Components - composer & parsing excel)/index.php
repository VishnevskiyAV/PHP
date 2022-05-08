<?php
/* Установите SimpleXLS с помощью Composer.*/ 
/* Создайте Excel-файл с двумя столбцами: слово на русском и его перевод на английский.*/ 
/* Заполните созданную таблицу, добавив несколько строк.*/ 
/* Создайте форму на странице с выпадающим списком, где пользователь сможет выбрать слово на русском языке.*/ 
/*Добавьте в выпадающий список все русские слова из созданного файла (разумеется, это надо делать уже через 
парсинг Excel-файла на PHP), отсортированные по алфавиту.*/ 
require_once 'vendor/autoload.php';

function parsingRu(string $file) : array {
    $russian = [];
    if ($xls = SimpleXLS::parseFile($file)) {
        foreach ($xls->rows() as $v) {
            if ($v[0] != 'Русский') {
                $russian[] = $v[0];
           }
        }
    } else {
        echo SimpleXLS::parseError();
    }
   return $russian;
}

$arr_ru = parsingRu('Eng.xls');
natsort($arr_ru);
/* При отправке формы найдите это слово в Excel-файле и выведите его английский перевод на страницу 
(разумеется, всё это надо делать на PHP).*/

function parsingEn(string $file, string $trans) : string  {
    $english = [];
    if ($xls = SimpleXLS::parseFile($file)) {
        foreach ($xls->rows() as $v) {
            if ($v[0] == $trans) {
                $english[] = $v[1];
           }
        }
    } else {
        echo SimpleXLS::parseError();
    }
   return implode($english);
}

$trans = false;
if (isset($_POST['trans'])) {
    $trans = $_POST['trans'] ?? false;
    $en = parsingEn('Eng.xls', $trans);
}

?>
<form name="form_3" action="" method="post">
    <h4>Перевод слов на Английский</h4>
    <select name="trans"> 
        <option value=''></option>
        <?php foreach($arr_ru as $v) { ?>
        <option value="<?=$v?>"><?=$v?></option>
        <?php } ?>   
    </select>
    <input type="submit" value="Получить перевод" />
</form>
<p> <b><?=$trans?></b> на английском будет: <?=$en?> </p>