<?php

class Animal {

    private $sound;

    public function __construct($sound) {
        $this->sound = $sound;
    }

    public function makeSound() {
        echo($this->sound);
    }
}

//There's no need for a ?>