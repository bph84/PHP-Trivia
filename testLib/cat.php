<?php

class Cat extends Animal {

    private $sound;

    public function __construct() {
        parent::__construct("Mao!");
        //$this->sound = "Mao!";
    }
}

//There's no need for a ?>