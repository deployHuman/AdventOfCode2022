<?php

declare(strict_types=1);

namespace Christmas\Day8;

class Part1
{
    public function __construct()
    {
        $input = file(__DIR__ . '/input.txt');

        $grid = $this->createGrid($input);
        $maxY = count($grid) - 1;
        $maxX = array_key_last($grid[0]);
        // echo "maxY: " . $maxY + 1 . " maxX: " . $maxX + 1 . "\n";

        $visibleTree = [];
        $lowest = [];

        for ($x = 0; $x <= $maxX; $x++) {
            //left to right
            for ($y = 0; $y <= $maxY; $y++) {
                if (empty($lowest[$x . 'ltr'])) {
                    $lowest[$x . 'ltr'] = 0;
                }

                if ($y === 0 || $lowest[$x . 'ltr'] < $grid[$x][$y]) {
                    $visibleTree[$x + 1 . ':' . $y + 1] = true;
                }

                if ($grid[$x][$y] > $lowest[$x . 'ltr']) {
                    $lowest[$x . 'ltr'] = $grid[$x][$y];
                }
            }
            //right to left
            for ($y = $maxY; $y >= 0; $y--) {
                if (empty($lowest[$x . 'rtl'])) {
                    $lowest[$x . 'rtl'] = 0;
                }

                if ($y === $maxY || $lowest[$x . 'rtl'] < $grid[$x][$y]) {
                    $visibleTree[$x + 1 . ':' . $y + 1] = true;
                }

                if ($grid[$x][$y] > $lowest[$x . 'rtl']) {
                    $lowest[$x . 'rtl'] = $grid[$x][$y];
                }
            }
        }

        for ($y = 0; $y <= $maxY; $y++) {
            //from top to bottom
            for ($x = 0; $x <= $maxX; $x++) {
                if (empty($lowest[$y . 'ttb'])) {
                    $lowest[$y . 'ttb'] = 0;
                }

                if ($x === 0 || $lowest[$y . 'ttb'] < $grid[$x][$y]) {
                    $visibleTree[$x + 1 . ':' . $y + 1] = true;
                }

                if ($grid[$x][$y] > $lowest[$y . 'ttb']) {
                    $lowest[$y . 'ttb'] = $grid[$x][$y];
                }
            }

            //from bottom to top
            for ($x = $maxX; $x >= 0; $x--) {
                if (empty($lowest[$y . 'btt'])) {
                    $lowest[$y . 'btt'] = 0;
                }

                if ($x === $maxX || $lowest[$y . 'btt'] < $grid[$x][$y]) {
                    $visibleTree[$x + 1 . ':' . $y + 1] = true;
                }

                if ($grid[$x][$y] > $lowest[$y . 'btt']) {
                    $lowest[$y . 'btt'] = $grid[$x][$y];
                }
            }
        }

        echo 'Answer Day 8 - Question 1: ' . count($visibleTree) . "\n";
    }

    public static function createGrid($input): array
    {
        $grid = [];
        foreach ($input as $row => $line) {
            $lineArray = str_split(trim($line));
            $grid[] = $lineArray;
        }

        return $grid;
    }
}
