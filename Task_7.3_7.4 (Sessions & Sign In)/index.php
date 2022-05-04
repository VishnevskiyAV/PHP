<?php
session_start();

/* Перепишите задания 3, 4, 5, 6 и 7, но с использованием сессий.*/ 
/* Объясните самому себе, в чём отличия этого кода от предыдущего? */

if (isset($_GET['size'])) $_SESSION['size'] = $_GET['size'];

$size = $_SESSION['size']?? '';
$size = match ($size) {
    'big' => '20pt',
    'normal' => '15pt',
    'small' => '8pt',
    default => '11pt'
};
  
/* Сделайте авторизацию по той схеме, что была сделана в уроке, но уже для двух пользователей: "Администратор" и "Модератор".*/
$auth = false;
$error = false;
if(isset($_POST['auth'])) {
    $_SESSION['login'] = $_POST['login']?? '';
    $_SESSION['password'] = $_POST['password']?? '';
    $error = true;
}

$login_1 = 'admin';
$pswd_1 = '111';
$login_2 = 'moderator';
$pswd_2 = '222';
$check_log = $_SESSION['login']?? false;
$check_pass = $_SESSION['password']?? false;

if ($check_log === $login_1 && $check_pass === $pswd_1 || $check_log === $login_2 && $check_pass === $pswd_2 ) {
    $auth = true;
    $error = false;
}

if (isset($_GET['logout'])) {
    unset ($_SESSION['login']);
    unset ($_SESSION['password']);
}
/* Приветствие должно быть соответствующим, то есть "Здравствуйте, Администратор" или "Здравствуйте, Модератор".*/

 
/* Реализуйте функцию выхода.*/

?>
 <style>
p {font-size: <?=$size?>;}
</style>
<p>Размер текста:</p>
<p> <a href="?size=big">Крупный текст</a></p>
<p> <a href="?size=normal">Нормальный текст</a></p>
<p> <a href="?size=small">Мелкий текст</a></p>
<?php if ($auth) { ?>
    <p>Здравствуйте, <b><?=$check_log?></b>!</p>  
    <a href='?logout'>Выход</a>
<?php } else { ?>
<?php if ($error) {?>
<p>Неверные логин и/или пароль!</p>
<?php } ?>
<form name="auth" method="post" action="">
        <p>
            Логин: <input type="text" name="login" />
        </p>
        <p>
            Пароль: <input type="password" name="password" />
        </p>
        <p>
            <input type="submit" name="auth" value="Войти" />
        </p>
    </form>
<? }?>

