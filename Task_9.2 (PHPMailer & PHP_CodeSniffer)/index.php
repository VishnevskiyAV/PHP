<?php
/**
 * Описание файла
 *
 * PHP version 8.0
 *
 * @category Class
 * @package  PackageName
 * @author   Aleksander Vishnevskiy <aleksvish1989@gmail.com>
 * @license  https://myrusakov.ru PHP License
 * @link     https://myrusakov.ru
 */
require_once 'vendor/autoload.php';
define('FILE', 'Eng.xls');

/**
 * Парсинг файла
 *
 * @param string $file Путь к файлу
 *
 * @return Строка с данными
 * 
 * @natsort Сортировка массива по алфавиту
 */
function parsingRu(string $file) : array 
{
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
$arr_ru = parsingRu(FILE);
natsort($arr_ru);

/**
 * Парсинг файла
 *
 * @param string $file  Путь к файлу 
 * @param $trans Полученное от пользователя значение
 *
 * @return Строка с данными
 */
function parsingEn(string $file, string $trans) : string  
{
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
$en = false;
if (isset($_POST['trans'])) {
    $trans = $_POST['trans'] ?? false;
    $en = parsingEn(FILE, $trans);
}

$email = $_POST['email'] ?? false;
$email = htmlspecialchars($email);

$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->CharSet = 'utf-8';
$mail->setFrom('admin@mysite.local', 'Администратор');
$mail->addAddress("$email");
$mail->addAttachment(FILE);
$mail->isHTML(true);
$mail->Subject = 'Vocabulary';
$mail->Body    = 'Вы просили мы прислали';
$text = false;
if (isset($_POST['email']) && $_POST['email'] != false) { 
    $mail->send();
    $text =  'Письмо успешно отправлено!';
} 
?>

<form name="form_3" action="" method="post">
    <h4>Перевод слов на Английский</h4>
    <select name="trans"> 
        <option value=''></option>
        <?php foreach($arr_ru as $v) {?>
        <option value="<?=$v?>"><?=$v?></option>
        <?php } ?>   
    </select>
    <input type="submit" value="Получить перевод" />
</form>
<p> <b><?=$trans?></b> на английском будет: <?=$en?> </p>
<form name="mail" action="" method="post">
    <h4>Также вы можете получить весь словарь на почту!</h4>
     Адрес вашей почты: <input type="email" name="email" value = ""/>
    <input type="submit" value="Send mail" />
</form>
<?php if ($text) { ?>
<p> <b><?=$text?></b> на адрес электронной почты: <?=$email?> </p>
<?php } ?>