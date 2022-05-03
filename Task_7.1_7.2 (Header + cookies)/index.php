<?php
/* Выведите форму со списком (select) и значениями: "Google", "VK", "Сайт автора". Добавьте кнопку "Перейти на сайт".*/ 
/* В зависимости от того, что выберет пользователь, необходимо сделать редирект 
на https://google.ru, https://vk.com или на https://myrusakov.ru*/

$g = $_POST['site']?? false;

switch ($g) {
    case 'Google':
        header('Location: https://google.ru');
        break;
    case 'autor':
        header('Location: https://myrusakov.ru');
        break;
    case 'VK':
        header('Location: https://vk.com');
        break;    
}
  
/* Выведите 3 ссылки с GET-параметром: "Крупный текст" (значение параметра big),
 "Нормальный текст" (значение параметра normal) и "Мелкий текст" (значение параметра small).*/
 /* При переходе по любой из ссылок размер текста должен устанавливаться на тот, что указан в GET-параметре 
(выберите подходящие числовые значения самостоятельно).*/
 //$op = $_GET['op']?? false;
 $a = $_GET['a']?? false;
 

/* Сохраните выбор пользователя в cookie (ни в коем случае, не сам размер шрифта, а именно текст: big, normal или small).*/

if (isset($_GET['size'])){
    if (!empty($_GET['size'])){
  setcookie('size', $_GET['size'], time()+1);    //проверить работу cookie можно с помощью установки разного времени хранения
     $_COOKIE['size'] = $_GET['size'];
   }
 }

$size = $_COOKIE['size'] ?? 0;;
if ($size == 'big') $a = 6;
elseif($size == 'normal') $a =4;
elseif($size == 'small') $a =2;

/* Сразу после выбора, а также и без выбора, если есть соответствующая cookie, должен быть установлен определённый 
размер шрифта на странице (например, в теге <style>).*/

/* Убедитесь, что размер текста действительно устанавливается и сохраняется.*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php if (isset($a)) { ?>
    <font size= <?=$a?>>
<?php } ?>
        <form name="form_3" action="" method="post">
        <H1>Переход на сайт</H1>
        <select name="site">
            <option value="Google">Google</option>
            <option value="VK">VK</option>
            <option value="autor">Сайт автора</option>
             <option value="n">Ничего не делать</option>
        </select>
        <br />
        <br />
        <input type="submit" value="Перейти на сайт" />
        </form>
    </font>
<p>Размер текста:</p>
<ul>
    <li>
        <a href="?a=6&amp; size=big">Крупный текст</a>
    </li>
    <li>
        <a href="?a=4&amp; size=normal">Нормальный текст</a>
    </li>
     <li>
        <a href="?a=2&amp; size=small">Мелкий текст</a>
    </li>
</ul>
</body>
</html>