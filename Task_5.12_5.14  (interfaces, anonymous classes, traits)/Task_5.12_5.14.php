<?php
/* Создайте интерфейс СanMove с методом move().*/ 
interface CanMove {
    public function move();
}

/*  Создайте интерфейс СanFly с методом fly(). */

interface CanFly {
    public function fly();
}

/* Создайте класс Car с реализацией интерфейса CanMove, где в методе move() будет выводиться строка "Движение автомобиля".*/ 

class Car implements CanMove {
    public function move() {
        echo "Движение автомобиля<br>";
    }
}

/* Создайте класс Aircraft с реализацией интерфейса CanFly, где в методе fly() будет выводиться строка "Полёт самолёта".*/ 

class Aircraft implements CanFly {
    public function fly() {
        echo "Полёт самолёта<br>";
    }
}

/* Создайте объект класса Car и вызовите метод move().*/ 
$car = new Car();
$car->move();
/* Создайте объект класса Aircraft и вызовите метод fly().*/ 
$aircraft = new Aircraft();
$aircraft->fly();
/* Перепишите класс Point, сделав его анонимным.*/ 
$point = new class (4,3) {
    private float $x;
    private float $y;
    private float $z;

    public function __construct(float $x, float $y) {
        $this->x = $x;
        $this->y = $y;
    }
    public function __toString() : string {
        return "Точка с координатами ($this->x , $this->y): <br>";
    }
    public function getX() {
        echo "X: $this->x<br>";
    }
    public function getY() {
        echo "Y: $this->y<br>";
    }
    public function setX($name) {
        echo "Now X = 7<br>";
        return $this->x = $name;
    }
    public function setY($name) {
        echo "Now Y = 8<br>";
        return $this->y = $name;
    }
};
/* Убедитесь, что все методы по-прежнему работают.*/ 
echo $point;
$point->getX();
$point->getY();
$point->setX(7);
$point->setY(8);
echo $point;
/* Перепишите задания 1, 2, 3, 4, 5 и 6, только вместо интерфейсов должны быть 
трейты и прямо в них должна быть реализация методов move() и fly().*/ 

trait CanMoveTr {
    public function move() {
        echo "Движение автомобиля<br>";
    }
}
trait CanFlyTr {
    public function fly() {
        echo "Полёт самолёта<br>";
    }

/* В классах Car и Aircraft подключите трейты, удалив при этом реализацию методов move() и fly()
 (поскольку теперь реализация находится в самих трейтах).*/

}
class CarTr {
    use CanMoveTr;
}
class AircraftTr {
    use CanFlyTr;
}
/* Создайте объект класса Car и вызовите метод move().*/ 
$car = new Car();
$car->move();
/* Создайте объект класса Aircraft и вызовите метод fly().*/
$aircraft = new Aircraft();
$aircraft->fly();
?>