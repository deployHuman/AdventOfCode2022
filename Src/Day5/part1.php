<?php

declare(strict_types=1);

namespace Christmas\Day5;

class Part1
{
    public function __construct()
    {
        $input = file(__DIR__ . '/input.txt');
        $stack = [
            1 => ['J', 'H', 'G', 'M', 'Z', 'N', 'T', 'F'],
            2 => ['V', 'W', 'J'],
            3 => ['G', 'V', 'L', 'J', 'B', 'T', 'H'],
            4 => ['B', 'P', 'J', 'N', 'C', 'D', 'V', 'L'],
            5 => ['F', 'W', 'S', 'M', 'P', 'R', 'G'],
            6 => ['G', 'H', 'C', 'F', 'B', 'N', 'V', 'M'],
            7 => ['D', 'H', 'G', 'M', 'R'],
            8 => ['H', 'N', 'M', 'V', 'Z', 'D'],
            9 => ['G', 'N', 'F', 'H'],
        ];

        // $stack = [
        //     1 => ['Z', 'N'],
        //     2 => ['M', 'C', 'D'],
        //     3 => ['P']
        // ];

        foreach ($input as $row => $value) {
            $instruction = explode(' ', $value);
            for ($i = 0; $i < $instruction[1]; $i++) {
                $toStack = (int) $instruction[5];
                $popped = array_pop($stack[$instruction[3]]);
                if (empty($stack[$toStack])) {
                    $stack[$toStack] = [];
                }
                array_push($stack[$toStack], $popped);
            }
        }

        $topstack = '';
        foreach ($stack as $key => $value) {
            $topstack .= array_pop($value);
        }

        echo 'Answer Day 4 - Question 1: ' . $topstack . ' Question 2: ';
    }
}
