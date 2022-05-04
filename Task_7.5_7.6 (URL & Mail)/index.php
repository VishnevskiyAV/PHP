<?php
/* Обработайте ссылку вида: http://mysite.local/?page=abc&ref=123 – а именно, сохраните значение параметра ref в cookie пользователя, 
затем удалите вообще параметр ref и сделайте редирект по получившейся ссылке (должен быть редирект сюда: http://mysite.local/?page=abc).*/

$url = 'http://mysite.local/?page=abc&ref=123';
$arr = parse_url($url);
parse_str($arr['query'], $query);
print_r($query);
echo '<br>';
setcookie('ref', $query['ref'], time()+3600);
unset ($query['ref']);
$query = http_build_query($query);
$url = $arr['scheme'].'://'.$arr['host'].$arr['path'].'?'.$query;
echo $url;


/*Убедитесь, что cookie ref действительно сохранилась, выведя её в окно браузера. По сути, данная задача – 
это основа большинства реферальных (партнёрских) программ.*/
echo '<br>'.$_COOKIE['ref'];

/* Выведите форму на сайте со следующими полями: "От кого", "Кому", "Тема", "Текст письма" и кнопкой "Отправить".*/ 
echo '<br>';
$arr = $_POST['mailings']?? [];


/* Получите все данные из формы и отправьте письмо.*/ 
$to = $arr[1]?? false;
$subject = $arr[2]?? false;
$text = $arr[3]?? false;    //теги в текст вставлять нельзя
$headers = "From:".$arr[0]?? false."\r\n";
$subject = '=?utf-8?B?'.base64_encode($subject).'?=';
if (mail($to, $subject, $text, $headers)) echo 'Письмо отправлено!';
else echo 'Письмо не отправлено';

/* Проверьте его наличие в папке \userdata\temp\email и откройте его в текстовом редакторе, чтобы убедиться, что письмо отправилось правильно.*/
//Письма в папке сохраняются, все корректно отображается
?>
<form name="form_1" action="" method="post">
    <h4>Отправка письма:</h4>
    <label>От кого:</label>
    <input type="text" name="mailings[]" />
    <br />
    <label>Кому:</label>
    <input type="text" name="mailings[]" />
    <br />
    <label>Тема:</label>
    <input type="text" name="mailings[]" />
    <br />
    <label>Текст письма:</label>
    <textarea type="text" name="mailings[]"><?=$text?></textarea>
    <br />
    <input type="submit" value="Отправить" />
</form>