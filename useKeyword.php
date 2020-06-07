<?php

spl_autoload_register(function ($class_name) {
    include 'testLib' . DIRECTORY_SEPARATOR  . $class_name . '.php';
});



// use Animal; // Same as '... as Animal'
use Animal as Creature;

$swan = new Animal("hisss");
$garfield = new Cat; // Brackets are optional!
$cow = new Creature("moo");

use exotic\Snake;

$snake = new Snake;

$garfield->makeSound();
$snake->makeSound();


//assert(Animal == Creature);