<?php

namespace exotic; 


use Animal; 

class Snake extends Animal {

    private $sound;

    public function __construct() {
        parent::__construct("sss");
    }
}
