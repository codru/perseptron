<?php


namespace App\Perceptron;

class A {
    public $weight;

    public $input;

    public function __construct($weight = 0)
    {
        $this->weight = $weight;
    }
    
    public function output()
    {
        return $this->weight * $this->input;
    }
}
