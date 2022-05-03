<?php
/*Создайте класс Validator, в котором реализуйте статический метод validEmail($email).
 Метод validEmail() должен выбрасывать следующие исключения: пустая строка – исключение с сообщением "E-mail не указан", 
 некорректный e-mail (не прошёл проверку в регулярном выражении) – исключение "E-mail указан неправильно", 
 длина e-mail больше 255 символов – исключение "Слишком длинный e-mail". Если всё хорошо, то метод возвращает true.*/ 
/*
 class Validator {

    private string $email;
    private const MAX_LEN = 25;
   
    public static function validEmail(string $email) {
        $reg = '/[a-z0-9_]+(\.[a-z0-9_-]+)*@([0-9a-z]+\.)+[a-z]{2,5}$/i';
        if (!$email) throw new Exception ('E-mail не указан');
        if (!preg_match($reg, $email)) throw new Exception('E-mail указан неправильно');
        if (strlen($email) > self :: MAX_LEN) throw new Exception('Слишком длинный e-mail');

    }
 }
 /* Вызовите метод validEmail(), передавая ему разные параметры, а также перехватывайте и выводите исключения. Обратите внимание, что 
 в методе validEmail() лишь выбрасываются исключения, а уже обработка (то есть блок try-catch) должна быть там, где вызывается этот метод.*/ 
/*try{
$email_1 = new Validator();
$email_1->validEmail('mail@mail.com');
} catch (Exception $e) {
    echo '<br />Возникла ошибка 1: '.$e->getMessage();
}
try{
$email_2 = new Validator();
$email_2->validEmail('mail@mail.mail.com');
} catch (Exception $e) {
    echo '<br />Возникла ошибка 2: '.$e->getMessage();
}
try{
$email_3 = new Validator();
$email_3->validEmail('alex.mail@mail.mail.com');
} catch (Exception $e) {
    echo '<br />Возникла ошибка 3: '.$e->getMessage();
}
try{
    try{
    $email_4 = new Validator('mail');
    $email_4->validEmail('mail');
    } catch (Exception $e) {
        echo '<br />Возникла ошибка 4: '.$e->getMessage();
    }
$email_5 = new Validator('alex@mail');
$email_5->validEmail('alex@mail');
} catch (Exception $e) {
    echo '<br />Возникла ошибка 5: '.$e->getMessage();
}
try{
$email_6 = new Validator('');
$email_6->validEmail('');
} catch (Exception $e) {
    echo '<br />Возникла ошибка 6: '.$e->getMessage();
}
try{
$email_7 = new Validator();
$email_7->validEmail('alex1234444423456fgdffgfd@mail.com');
} catch (Exception $e) {
    echo '<br />Возникла ошибка 7: '.$e->getMessage();
}
*/
 /*Создайте 3 класса, наследующих Exception: EmptyException – класс-исключение, который будет создаваться при передаче пустого параметра, 
 LongException – класс-ислючение, который будет создаваться при передаче слишком длинного параметра и InvalidException – класс-исключение, 
 который будет создаваться при передаче некорректного параметра.*/ 

 class EmptyException extends Exception {
    public function __construct() {
        parent::__construct('E-mail не указан');
     }
 }
 class LongException extends Exception {
    public function __construct() {
        parent::__construct('этот e-mail cлишком длинный');
    }
}
 class InvalidException extends Exception {
    public function __construct() {
        parent::__construct('этот E-mail указан неправильно');
    }
 }
 /* Переделайте класс Validator, выбрасывая исключения не класса Exception, а исключения, которые были созданы в предыдущем задании.*/ 
 class NewValidEmail {
    private const MAX_LEN = 25;
    private string $email;
    
   
    public static function validEmail($email) {
        
        try {
            if (!$email) throw new EmptyException(1);
        } catch(EmptyException $e) {
            echo '<br />Возникла ошибка 8: '.$e->getMessage();
            }
        try {
            if (strlen($email) > self :: MAX_LEN) throw new LongException();
        } catch(LongException $e) {
            echo "<br />Возникла ошибка 9: ($email) - ".$e->getMessage();
            }
        try {
            $reg = '/[a-z0-9_]+(\.[a-z0-9_-]+)*@([0-9a-z]+\.)+[a-z]{2,5}$/i';
            if (!preg_match($reg, $email)) throw new InvalidException();
        } catch(InvalidException $e) {
            echo "<br />Возникла ошибка 10: ($email) - ".$e->getMessage();
            }
        //if (!preg_match($reg, $email)) throw new Exception('E-mail указан неправильно');
    }
 }
 
    $email_8 = new NewValidEmail();
    $email_8->validEmail('');
    
        

    $email_9 = new NewValidEmail();
    $email_9->validEmail('alex1234444423456fgdffgfd@mail.com');
   
 

    $email_10 = new NewValidEmail();
    $email_10->validEmail('mail');

/* Изучите в справочнике класс Error: http://php.net/manual/ru/class.error.php*/ 
 /* Напишите код, который вызовет ошибку типа Error.*/ 
 try {
   $x = 3 / 0;
} catch (DivisionByZeroError $e) {
    echo "<br>Деление на ноль: $e";
}
 /* Вызовите 5 любых методов у объекта класса Error внутри блока catch.*/
//не хочу
 
?>