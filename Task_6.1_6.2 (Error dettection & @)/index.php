<?php
/* Совершите умышленно синтаксическую ошибку и убедитесь, что PHP ничего не напишет.*/ 
ini_set('display_errors', 1);
$c = 0;

/*Поставьте показ ошибок обратно, а также установите вывод всех ошибок.*/ 
error_reporting(E_ALL);
//error_reporting(E_ALL & ~E_NOTICE);
echo E_ALL & ~E_NOTICE;
echo '<br />';
echo E_ERROR | E_WARNING | E_PARSE;
error_reporting(E_ALL);
echo '<br />';
//ini_set('display_errors', 0);
echo @$x;
/* Убедитесь, что синтаксическая ошибка, допущенная во 2-м задании, появилась.*/ 

/* Создайте переменную $x, которой присвойте значение переменной $y (которая не существует).*/ 
@$x = $y;

/* Убедитесь, что появился Notice.*/ 

/* Добавьте @ так, чтобы Notice исчез.*/
$content = @file_get_contents('http://a192383289329239.com');
if ($content) echo 'Начинается обработка данных';
else echo 'Ошибка открытия адреса';
if (@$_POST['myform']) echo '<br />Форма отправлена';

?>
<form name="myform" action="" method="post">
<div>
    <input type="submit" name="myform" value="Отправить" />
</div>
</form>
