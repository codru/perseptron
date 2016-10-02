<?php

namespace App\Perceptron;

class Perceptron
{
    public $aElements = [];
    public $rElement;

    public function __construct($aCount, $bias)
    {
        for ($i = 0; $i < $aCount; $i++) {
            $this->aElements[$i] = new A();
        }

        $this->rElement = new R($bias, $this->aElements);
    }

    public function answer()
    {
        return $this->rElement->output();
    }

    public function doNothing()
    {
        return true;
    }

    public function increaseWeights()
    {
        foreach ($this->aElements as $element) {
            if ($element->input) {
                $element->weight++;
            }
        }
    }

    public function decreaseWeights()
    {
        foreach ($this->aElements as $element) {
            if ($element->input) {
                $element->weight--;
            }
        }
    }

    public function activateSignals($data)
    {
        foreach ($data as $key => $isActive) {
            $this->aElements[$key]->input = $isActive;
        }
    }

    public function showWeights()
    {
        foreach ($this->aElements as $key  => $element) {
            echo("$element->weight ");
            if ($key % 3 == 2) {
                echo("\n");
            }
        }
    }

    public function check($data)
    {
        $this->activateSignals($data);
        return $this->answer();
    }
}
