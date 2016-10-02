<?php

namespace App\Perceptron;

class Teacher
{
    public function teach(Perceptron $perceptron, $times)
    {
        $dataForLearning = $this->getDataForLearning();
        
        for ($i = 0; $i < $times; $i++) {
            $data = $this->getRandomSet($dataForLearning);
            
            $perceptron->activateSignals($data['set']);
            
            if ($perceptron->answer() == $data['answer']) {
                $perceptron->doNothing();
            }

            if ($perceptron->answer() == true && $data['answer'] == false) {
                $perceptron->decreaseWeights();
            }

            if ($perceptron->answer() == false && $data['answer'] == true) {
                $perceptron->increaseWeights();
            }
        }

        $perceptron->showWeights();
    }

    public function getDataForLearning()
    {
        $data = include "data/forLearning.php";

        return $data;
    }

    public function getRandomSet($data)
    {
        return $data[mt_rand(0, count($data) - 1)];
    }
}
