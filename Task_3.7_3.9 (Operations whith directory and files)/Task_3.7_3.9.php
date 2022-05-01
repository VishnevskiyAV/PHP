<?php
/* Создайте через PHP 3 директории со случайными именами (подумайте, какая функция для этого подойдёт, либо напишите свою).*/ 

for ($i = 0; $i < 3; $i++) {
    $name = uniqid();
    mkdir($name);
}

/* Зайдите случайным образом в любую из директории с помощью PHP и создайте там файл со случайным названием.*/ 
//$f= 0;
$str[] = '';
function chooseDir($folder) {
    $dir = scandir($folder);
    foreach($dir as $v) {
        if ($v == '.' || $v == '..' || is_file($v)) continue;
        $f = $folder.DIRECTORY_SEPARATOR.$v;
        $str[] = $f; 
  } return $str;
} 


/* Проверьте всё это*/ 

$f = chooseDir('.');
$dir = $f[array_rand($f, 1)];
$name = uniqid();
fopen("./$dir/$name.txt",'x');

/* Удалите всё, что было создано в 1-м и 2-м заданиях через PHP.*/ 

function delDir($folder) {
    $dir = scandir($folder);
    foreach($dir as $v) {
        if ($v == '.' || $v == '..' || $v == 'index.php') continue;
        $f = $folder.DIRECTORY_SEPARATOR.$v;
        if (is_dir($f)) delDir($f);
        if (is_file($f)) unlink($f);
        if (is_dir($v)) rmdir($v);
  } 
} 
delDir('.');

/* Напишите регулярное выражение, которое будет пропускать следующие строки: "57abc", "a7cdc" и "A889c", 
и не пропускать следующие строки: "/7abc", "57abd".*/ 
$str1 = '57abc';
$str2 = 'a7cdc';
$str3 = 'A889c';
$str4 = '/7abc';
$str5 = '57abd';
$reg = '#\w\d\w\wc#';
echo preg_match($reg, $str1).'<br>';
echo preg_match($reg, $str2).'<br>';
echo preg_match($reg, $str3).'<br>';
echo preg_match($reg, $str4).'<br>';
echo preg_match($reg, $str5).'<br>';


?>