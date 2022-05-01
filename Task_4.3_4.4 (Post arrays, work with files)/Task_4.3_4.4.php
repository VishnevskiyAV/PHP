<?php
/* Создайте форму с 5 текстовыми полями и кнопкой "Отправить".*/
/* Данные из 5 текстовых полей должны отправиться в виде массива.*/ 
/* Обработайте полученный массив, выведя из него максимальное и минимальное значение на странице.*/ 
//mailings = $_POST['mailings']?? [];
$p = false;
$arr = $_POST['mailings']?? [];

if (is_numeric(implode('',$arr))) {    
    echo max($arr).'<br>';
    echo min($arr).'<br>'; 
} else echo 'need numbers';

?>
<form name="form_1" action="" method="post">
    <h4>Напишите рассылки, которые Вы хотели бы видеть на нашем сайте:</h4>
    <label>Рассылка 1:</label>
    <input type="text" name="mailings[]" />
    <br />
    <label>Рассылка 2:</label>
    <input type="text" name="mailings[]" />
    <br />
    <label>Рассылка 3:</label>
    <input type="text" name="mailings[]" />
    <br />
    <label>Рассылка 4:</label>
    <input type="text" name="mailings[]" />
    <br />
    <label>Рассылка 5:</label>
    <input type="text" name="mailings[]" />
    <br />
    <input type="submit" value="Отправить" />
</form>

<?php

/* Создайте форму с текстовой областью и тремя кнопками: "Сохранить", "Загрузить" и "Удалить".*/ 
/* Если пользователь вводит в текстовую область какой-то текст и жмёт кнопку "Сохранить", то данный текст должен 
быть сохранён в текстовый файл на сервере, а у пользователя должна появиться строка: "Сохранение прошло успешно".*/

$text = $_POST['text']?? '';
$text = htmlspecialchars($text);
//$file = '1.txt';
$save = $_POST['save']?? false;
if ($save != false ) {
    if (!file_exists('1.txt')) fopen('1.txt', 'x');
    else echo 'Rewriting<br>';
    file_put_contents('1.txt', $text); 
    echo 'Сохранение прошло успешно<br>';
}

/* При нажатии кнопки "Загрузить" в текстовой области должен появиться текст, который был записан до этого в файл. 
Если файла не существует, то вывести строку над формой: "Файл не существует".*/

$load = $_POST['load']?? false;
if ($load != false && file_exists('1.txt')) {
    echo file_get_contents('1.txt');
} 

/* При нажатии кнопки "Удалить" файл должен быть удалён, а у пользователя должна появиться строка: 
"Файл успешно удалён". Если файла не существует, то вывести строку над формой: "Файл не существует".*/ 

$del = $_POST['del']?? false;
if ($del != false && file_exists('1.txt')) { unlink('1.txt'); echo 'Deleted'; }
elseif ($del != false && !file_exists('1.txt')) echo 'No such file';

 
?>
<form name="myform" action="" method="post">
    <label>Ваш комментарий:<label>
    <br />
    <textarea name="text"><?=$text?></textarea>
    <br />
    <input type="submit" name="save" value="Сохранить" />
    <input type="submit" name="load" value="Загрузить" />
    <input type="submit" name="del" value="Удалить" />
</form>
