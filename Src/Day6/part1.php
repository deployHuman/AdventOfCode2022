<?php

declare(strict_types=1);

namespace Christmas\Day6;

class Part1
{
    public function __construct()
    {
        $input = file(__DIR__ . '/input.txt');
        $question1 = 0;
        $question2 = 0;
        foreach ($input as $row => $signal) {
            $question1 = $this->getSequenceEnd($signal, 4);
            $question2 = $this->getSequenceEnd($signal, 14);
        }
        echo 'Answer Day 6 - Question 1: ' . $question1 . ' Question 2: ' . $question2;
    }

    public function getSequenceEnd(string $SignalCheck, int $length)
    {
        $signalLenght = (strlen(mb_strtolower(trim($SignalCheck))) - ($length + 1));
        for ($i = 0; $i <  $signalLenght; $i++) {
            if (count(array_unique(str_split(substr($SignalCheck, $i, $length)))) == $length) {
                return ($i + $length);
            }
        }
    }
}
