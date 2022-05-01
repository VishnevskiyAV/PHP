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
    public function __toString() {
        return "Точка с координатами ($this->x , $this->y): <br>";
    }

    public function __get($name) {
       if ($name == 'x')  return $this->x;
       if ($name == 'y')  return $this->y;
       if ($name == 'z')  return "Класс Point работает только в двумерном пространстве <br>";
       else return "Такого свойства нет! <br>";
    }
    public function __set($name, $value) {
        if ($name == 'z') echo "Класс Point работает только в двумерном пространстве <br>";
        return $this->$name = $value;
    }

    public function __call($metod, $arg){
        echo "Метод $metod не существует<br>";
    }
    public function __sleep() {
        return ['x', 'y'];
    }

    public static function getCounter() {
        return self::$counter;
    }
    public function __clone() {
        echo 'Клонирование<br />';
    }

}
/* Создайте абстрактный класс Log с абстрактным методом add() и строковым параметром (некоторое сообщение).*/ 

/* Добавьте конструктор в созданный класс, в котором в качестве параметра передаётся строка – путь к файлу лога.*/ 

/* Добавьте protected-функцию в Log, которая принимает строку и добавляет её в файл, путь к которому был передан в конструкторе. */ 

/* Создайте 2 производных класса от Log: WarningLog и ErrorLog.*/ 

/* В классе WarningLog реализуйте метод add, вызвав функцию из 4-го задания у родительского класса, 
передав "Warning: СООБЩЕНИЕ_ИЗ_ПАРАМЕТРА".*/ 

/* В классе ErrorLog реализуйте метод add, вызвав функцию из 4-го задания у родительского класса, передав "Error: СООБЩЕНИЕ_ИЗ_ПАРАМЕТРА".*/ 

/*Создайте экземпляры WarningLog и ErrorLog и проверьте правильность их работы.*/ 



?>