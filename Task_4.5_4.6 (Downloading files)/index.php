<?php
/* Реализуйте загрузку на сайт аудио-файлов в папку music.*/ 
//print_r($_FILES);
echo '<br>';
$success_one = false;
$correct = false;
$file = $_FILES['music']?? false;
if ($file && $file['error'] == UPLOAD_ERR_OK) {
    $llist = ['.mp3', '.wav', '.avi'];
    foreach ($llist as $ext) {
        if (str_ends_with($file['name'], $ext)) $correct = true;
            }
        if ($correct == true) {
            $dist = 'music/'.$file['name'];
            move_uploaded_file($file['tmp_name'], $dist);

        }
        else echo 'Расширение файла не подходит!'; 
} 



/* Используя функции для работы с файлами и директориями, а также используя тег audio, 
выведите плееры для проигрывания всех музыкальных файлов из папки music. Таким образом, 
на одной странице будет и форма для загрузки новых аудио-файлов, и множество плееров для проигрывания того, что уже загружено.*/ 
//$music = './music';
$sound = glob('music/*.mp3');

//$link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$dist;
//echo $link;
echo '<br>';

/* Доработайте 1-е задание так, чтобы нельзя было загружать ничего, кроме аудио-файлов, и если идёт попытка загрузить что-то другое,
 то выводите соответствующую ошибку.*/
?>
<form name="upload" action="index.php" method="post" enctype="multipart/form-data">
    <h4>Загрузка одного файла:</h4>
    <?php if ($success_one) { ?>
        <p style="color: #0c0;">Файл успешно загружен!</p>
    <?php } ?>
    <p>
        <input type="file" name="music" />
    </p>
    <p>
        <input type="submit" value="Загрузить файл" />
    </p>
</form>


<p style="color: #0c0;">All music:
<?php foreach ($sound as $play) { 
$link = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/'.$play; ?>
<p> <a href="?op=<?=$link?>"><?=$link?></a></p> 
<?php } ?>
<?php 
$file = $_GET['op']?? '';
?>
<audio scr = <?=$file?> controls>      
    <source src=<?=$file?> type="audio/mpeg">
    Тег audio не поддерживается вашим браузером. 
</audio>