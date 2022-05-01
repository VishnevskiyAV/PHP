<?php
/* Доработайте класс Point, добавив ко всем полям и функциям правильные типы данных.*/ 
class Point {
    private float $x;
    private float $y;
    private float $z;
    private static int $counter = 0;

    public function __construct(float $x = null, float $y = null) {
        $this->x = $x;
        $this->y = $y;
        self::$counter++;
    }
    public function __toString() : string {
        return "Точка с координатами ($this->x , $this->y): <br>";
    }

    public function __get(string $name) : array {
       if ($name == 'x')  return $this->x;
       if ($name == 'y')  return $this->y;
       if ($name == 'z')  return "Класс Point работает только в двумерном пространстве <br>";
       else return "Такого свойства нет! <br>";
    }
    public function __set(string $name, float $value) {
        if ($name == 'z') echo "Класс Point работает только в двумерном пространстве <br>";
        return $this->$name = $value;
    }

    public function __call(string $metod, array $arg) : string {
        echo "Метод $metod не существует<br>";
    }
    public function __sleep() : array {
        return ['x', 'y'];
    }

    public static function getCounter() : float {
        return self::$counter;
    }

}

/* Создайте абстрактный класс Log с абстрактным методом add() и строковым параметром (некоторое сообщение).*/ 
/* Добавьте конструктор в созданный класс, в котором в качестве параметра передаётся строка – путь к файлу лога.*/ 
/* Добавьте protected-функцию в Log, которая принимает строку и добавляет её в файл, путь к которому был передан в конструкторе. */ 

abstract class Log {

    private string $a = '';

    abstract public function add(); 

    public function __construct(string $a) {
       $this->a = $a;
    }
    public function addStr(string $str) {
        file_put_contents($this->a, $str);      
    }
}

/* Создайте 2 производных класса от Log: WarningLog и ErrorLog.*/ 
/* В классе WarningLog реализуйте метод add, вызвав функцию из 4-го задания у родительского класса, 
передав "Warning: СООБЩЕНИЕ_ИЗ_ПАРАМЕТРА".*/ 
/* В классе ErrorLog реализуйте метод add, вызвав функцию из 4-го задания у родительского класса, передав "Error: СООБЩЕНИЕ_ИЗ_ПАРАМЕТРА".*/ 

class WarningLog extends Log {
    
    public function add() {
        $str = "Warning: СООБЩЕНИЕ_ИЗ_ПАРАМЕТРА";
        $this -> addStr($str);
    }
}

class ErrorLog extends Log {

    public function add() {
       $str = "Error: СООБЩЕНИЕ_ИЗ_ПАРАМЕТРА";
       $this -> addStr($str);
    }
}

/*Создайте экземпляры WarningLog и ErrorLog и проверьте правильность их работы.*/ 

$c_1 = new WarningLog ('./1.txt');
$c_1->add();
$c_2 = new ErrorLog ('./2.txt');
$c_2->add();
?>