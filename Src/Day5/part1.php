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

        //test stack
        // $stack = [
        //     1 => ['Z', 'N'],
        //     2 => ['M', 'C', 'D'],
        //     3 => ['P'],
        // ];

        $stackPart2 = $stack;

        foreach ($input as $row => $value) {
            $instruction = explode(' ', $value);

            $moveCount = (int) $instruction[1];
            $toStack = (int) $instruction[5];
            $fromStack = (int) $instruction[3];

            if ($moveCount > 1) {
                $poppedToPart2 = array_splice($stackPart2[$fromStack], count($stackPart2[$fromStack]) - $moveCount);
                array_push($stackPart2[$toStack], ...$poppedToPart2);
            } else {
                $poppedToPart2 = array_pop($stackPart2[$fromStack]);
                array_push($stackPart2[$toStack], $poppedToPart2);
            }

            for ($i = 0; $i < $moveCount; $i++) {
                $popped = array_pop($stack[$fromStack]);
                array_push($stack[$toStack], $popped);
            }
        }

        echo 'Answer Day 5 - Question 1: ' . $this->getTopstack($stack) . ' Question 2: ' . $this->getTopstack($stackPart2) . "\n";
    }

    public function getTopstack(array $totalstack): string
    {
        $returnstack = '';
        foreach ($totalstack as $key => $value) {
            $returnstack .= array_pop($value);
        }

        return $returnstack;
    }
}
