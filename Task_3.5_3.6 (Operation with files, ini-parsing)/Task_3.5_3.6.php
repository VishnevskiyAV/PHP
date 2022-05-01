<?php
session_start();

/* С помощью PHP создайте 3 файла со случайными числами 
(в каждом файле должно быть от 1 до 5 чисел, и это количество должно выбираться так же случайным образом).*/ 

$file_1 = fopen('1.txt', 'x');
$file_2 = fopen('2.txt', 'x');
$file_3 = fopen('3.txt', 'x');


$b = mt_rand(1, 5);
$a = '';
$c = '';
$d = '';
for ($i = 1; $i <= $b; $i++) {
  $a .= mt_rand(1, 9);
  $c .= mt_rand(2, 7);
  $d .= mt_rand(3, 8);
  fseek($file_1, 0);
  fseek($file_2, 0);
  fseek($file_3, 0);
  fwrite($file_1, "$a");
  fwrite($file_2, "$c");
  fwrite($file_3, "$d");
}
/* Считайте все числа из созданных файлов и выведите их сумму.*/ 
$a = file_get_contents('1.txt');
$c = file_get_contents('2.txt');
$d = file_get_contents('3.txt');
$summ = $a+$c+$d;
echo "Сумма чисел из файлов = $summ";
fclose ($file_1);
fclose ($file_2);
fclose ($file_3);
/* С помощью PHP удалите все 3 файла из 1-го задания.*/ 
unlink ('1.txt');
unlink ('2.txt');
unlink ('3.txt');

/* Создайте INI-файл, где укажите цвет текста и его размер.*/ 
/* Создайте простую HTML-страницу (обязательно с DOCTYPE и всеми базовыми HTML-тегами: html, head, body).*/ 
/* Добавьте пару абзацев с помощью тега <p>.*/ 

/* Получите данные из INI-файла и подставьте их внутри тега <style>, чтобы у текста внутри тега <p> был соответствующий цвет и размер.*/ 

$str = parse_ini_file('color.ini', true);

/* Создайте 2 языковых файла ru.ini и en.ini, где будут языковые константы и их перевод. 
Например, TITLE=Заголовок – в ru.ini, и TITLE=Title – в en.ini. Далее нужно проанализировать массив $_SERVER и узнать,
какой язык предпочтительнее у пользователя. И вывести TITLE из того файла, который будет соответствовать языку пользователя.
При этом если задать GET-параметр: lang=ru или lang=en – должно выводиться соответствующее представление языковой константы TITLE,
независимо от того, что находится в массиве $_SERVER.*/ 
$arr = ($_SERVER['HTTP_ACCEPT_LANGUAGE']);
$langServ = '';
if (strpos($arr, 'ru;q=0.8') !==false) $langServ = 'ru';
if (strpos($arr, 'en;q=0.8') !==false) $langServ = 'en';


if ($langServ == 'ru') $lang ='ru';
elseif ($langServ == 'en') $lang ='en';

$lang = $_GET['lang']?? $langServ;

$parse_lang = parse_ini_file($lang.'.ini', true, INI_SCANNER_TYPED);


?>
<!DOCTYPE html>
<html lang=<?=$lang?>>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$parse_lang['LANG']['TITLE']?></title>
</head>
<body>
  <div>
  <a href="?lang=ru">Русский</a>
  <a href="?lang=en">Английский</a>
  </div>
  <p style="color: <?=$str['color']?>; font-size: <?=$str['font-size']?>"> Это прекрасный мир, в котором мы живем </p> 
  <p style="color: <?=$str['color']?>; font-size: <?=$str['font-size']?>">  And this is the new world, we creating </p> 
</body>
</html>