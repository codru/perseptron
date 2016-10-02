<?php


namespace App\Perceptron;

class R 
{
    public $bias;

    public $aElements = [];

    public function __construct($bias, array $aElements)
    {
        $this->bias = $bias;

        $this->aElements = $aElements;
    }

    public function sum()
    {
        /*return array_sum(
            array_walk($this->aElements, function ($element){
                return $element->output();
            })
        );*/
        $sum = 0;

        foreach ($this->aElements as $element) {
            $sum += $element->output();
        }

        return $sum;
    }

    public function output()
    {
        return $this->sum() > $this->bias;
    }
}
