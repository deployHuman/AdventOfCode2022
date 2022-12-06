<?php

declare(strict_types=1);

namespace Christmas\Day6;

class Part1
{
    public function __construct()
    {
        $input = file(__DIR__ . '/input.txt');
        echo 'Answer Day 6 - Question 1: ' . $this->getSequenceEnd($input[0], 4) . ' Question 2: ' . $this->getSequenceEnd($input[0], 14);
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
