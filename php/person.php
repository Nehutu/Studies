<?php
class Person {
    private $name;
    private $surname;
    private $age;
    private $hp;
    private $mom;
    private $dad;

    function __construct($name, $surname, $age, $mom=null, $dad=null)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
        $this->hp = 100;
        $this->mom = $mom;
        $this->dad = $dad;
    }

    function setHp($hp) {
        if ($this->hp + $hp > 100) {
            $this->hp = 100;
        } else {
            $this->hp = $this->hp + $hp;
        }
    }
    
    function getName() {
        return $this->name;
    }
    function getSurname() {
        return $this->surname;
    }
    function getAge() {
        return $this->age;
    }
    function getHp() {
        return $this->hp;
    }
    function getMom() {
        return $this->mom;
    }
    function getDad() {
        return $this->dad;
    }

    function getInfo() {
        return "<h2>Who am I:</h2><br>" . "My name is " . $this->getName() ." " . $this->getSurname() . "." . 
        "<br>I am " . $this->getAge() . " years old." . 
        "<br>My mom and dad are " . $this->getMom()->getName() . " " . $this->getMom()->getSurname() . " and " . $this->getDad()->getName() . " " . $this->getDad()->getSurname() . "." . 
        "<br>My mom is " . $this->getMom()->getAge() . " years old and my dad is " . $this->getDad()->getAge() . " years old." . 
        "<br>My mom's parents are " . $this->getMom()->getMom()->getName() . " " . $this->getMom()->getMom()->getSurname() . " and " . $this->getDad()->getDad()->getName() . " " . $this->getDad()->getDad()->getSurname() . "." . 
        "<br>They are " . $this->getMom()->getMom()->getAge() . " and " . $this->getDad()->getDad()->getAge() . " years old." . 
        "<br>My dad's parents are " . $this->getDad()->getMom()->getName() . " " . $this->getDad()->getMom()->getSurname() . " and " . $this->getDad()->getDad()->getName() . " " . $this->getDad()->getDad()->getSurname() . "." . 
        "<br>They are " . $this->getDad()->getMom()->getAge() . " and " . $this->getDad()->getDad()->getAge() . " years old.";
    }
}

$oleg = new Person("Oleg", "Isaev", 65);
$nata = new Person("Natalia", "Isaeva", 62);

$igor = new Person("Igor", "Moiseev", 63);
$kate = new Person("Ekaterina", "Moiseeva", 60);

$alex = new Person("Aleksandr", "Isaev", 35, $nata, $oleg);
$olga = new Person("Olga", "Isaeva", 30, $kate, $igor);
$kolya = new Person("Kolya", "Isaev", 12, $olga, $alex);

echo $kolya->getInfo();
