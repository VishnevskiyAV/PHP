<?php
/* Добавьте в класс Point метод __toString() и реализуйте его, вернув строку такого вида:
"Точка с координатами (x, y)". Безусловно, вместо x и y должны быть конкретные значения.*/ 
/* Создайте 3 разных объекта класса Point и выведите их через echo. */ 

/* Реализуйте метод __get(), в котором при обращении к несуществующему свойству z будет выведено сообщение 
"Класс Point работает только в двумерном пространстве". Если запрашивается x или y, то вывести "
Для доступа к x и y используйте get-методы". Если запрашивается что-то иное, то вывести "Такого свойства нет!".*/ 

/* Сделайте метод __set() таким, чтобы при попытке изменить свойство z, выводилась строка: 
"Класс Point работает только в двумерном пространстве".*/ 

/* Реализуйте метод call(), в котором выведите ту же строку, что и в предыдущем задании, при попытке вызвать метод setZ().*/ 

class Point {
    private $x;
    private $y;
    private $z;
    private static $counter = 0;

    public function __construct($x = false, $y = false) {
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


$point_1 = new Point();
$point_1 -> x = 4;
$point_1 -> y = 11;
echo $point_1; 
echo '____________________<br>';

$point_2 = new Point(12, 1);
echo $point_2;
$point_2 -> z = 4;
$point_2 ->setZ(4);
echo '____________________<br>';

$point_3 = new Point(14, 9);
echo $point_3;
echo $point_3->z.'<br>';
echo '____________________<br>';


$point_4 = new Point();
$point_4 -> x = 4;
$point_4 -> y = 4;

echo $point_4->x.'<br>';
echo $point_4->y.'<br>';
echo $point_4->z;
echo $point_4->k;
echo '____________________<br>';

$file = './point';
$att = $_POST['save'] ?? false;
if ($att != false && $_POST['x'] != '' && $_POST['y'] != '') {
    $p_1 = new Point();
    $p_1 -> x = $_POST['x'];
    $p_1 -> y = $_POST['y'];
    $ser = serialize($p_1); 
    file_put_contents($file, $ser);
    echo "Объект сохранен: $p_1<br>";
} else echo 'No parametrs<br>';
echo '____________________<br>';

if (isset($_POST['load']) && file_exists($file)) {
    $str = file_get_contents($file);
    $unser = unserialize($str);
    echo "Объект занружен: $unser<br>";
    
    
} else 'No file exists';


echo Point::getCounter();
/* Сделайте форму с двумя полями: x и y. Также добавьте кнопки: "Сохранить" и "Загрузить".*/ 

/* При вводе x и y и нажатии кнопки "Сохранить" должен быть создан объект класса Point, который необходимо сериализовать.*/ 

/* При нажатии кнопки "Загрузить" в поля x и y должны быть подставлены координаты сериализованного объекта.*/ 

/* Выведите информацию об успешном сохранении и об успешной загрузке.*/ 

/* Выведите различные предупреждения. Например, при попытке "Загрузить" ещё не сохранённый объект или сохранить 
без заполненных или некорректных полей x и y.*/ 

/* Создайте 1 объект класса Point и сделайте его клон. Убедитесь, что клонирование прошло успешно,
 попытавшись изменить свойство любого из объектов и выведя это свойство у обоих объектов. Они должны быть различны.*/ 


?>
<form name="myform" action="" method="post">
    <label>Введите значение x и y:<label>
    <div>
     X: <input type="text" name="x" value="<?=$unser->x ?? false?>" />
     <div>
     <div>
     Y: <input type="text" name="y" value="<?=$unser->y ?? false?>" />
     <div>
    <input type="submit" name="save" value="Сохранить" />
    <input type="submit" name="load" value="Загрузить" />
</form>
<?php
echo '<br>';
$p_2 = new Point(10,20);
echo $p_2;
$p_3 = clone $p_2;
echo $p_3;
$p_3->x=100;
echo $p_2;
echo $p_3;
?>