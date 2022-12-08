<?php

declare(strict_types=1);

namespace Christmas\Day8;

class Part2
{
    public function __construct()
    {
        $input = file(__DIR__ . '/input.txt');
        $grid = part1::createGrid($input);
        $treeHouseScore = [];

        foreach ($grid as $xnumber => $xrow) {
            foreach ($xrow as $ynumber => $value) {
                $treeHouseScore[$xnumber . ':' . $ynumber] = $this->valueForGridSpot($xnumber, $ynumber, $grid);
            }
        }
        $treeHouseScore = array_values(array_filter($treeHouseScore));
        rsort($treeHouseScore);
        echo 'Answer Day 8 - Question 2: ' . $treeHouseScore[0] . "\n";
    }

    public function valueForGridSpot(int $buildx, int $buildy, array $grid): int
    {
        $maxY = count($grid) - 1;
        $maxX = array_key_last($grid[0]);
        // $buildx = ($buildx - 1);
        // $buildy = ($buildy - 1);
        // echo "echo gridsize is :" . $maxX  . "," . $maxY . "\n";
        // echo "this is a tree the size of " . $grid[$buildx][$buildy] . "\n";
        $blocked['lookingright'] = false;
        $blocked['lookingleft'] = false;
        $blocked['lookingdown'] = false;
        $blocked['lookingup'] = false;
        $trees['lookingright'] = 0;
        $trees['lookingleft'] = 0;
        $trees['lookingdown'] = 0;
        $trees['lookingup'] = 0;

        for ($y = ($buildy + 1); $y <= $maxY; $y++) {
            if ($blocked['lookingright'] == true) {
                continue;
            }
            // echo "now looking right at tree " .  $grid[$buildx][$y] . "\n";
            if ($grid[$buildx][$buildy] > $grid[$buildx][$y]) {
                // echo "We are bigger!\n";
                $trees['lookingright'] += 1;
            }

            if ($grid[$buildx][$buildy] <= $grid[$buildx][$y]) {
                $trees['lookingright'] += 1;
                $blocked['lookingright'] = true;
            }
        }

        for ($y = ($buildy - 1); $y >= 0; $y--) {
            if ($blocked['lookingleft'] == true) {
                continue;
            }
            if ($grid[$buildx][$buildy] > $grid[$buildx][$y]) {
                $trees['lookingleft'] += 1;
            }
            if ($grid[$buildx][$buildy] <= $grid[$buildx][$y]) {
                $trees['lookingleft'] += 1;
                $blocked['lookingleft'] = true;
            }
        }

        for ($x = ($buildx + 1); $x <= $maxX; $x++) {
            if ($blocked['lookingdown'] == true) {
                continue;
            }
            if ($grid[$buildx][$buildy] > $grid[$x][$buildy]) {
                $trees['lookingdown'] += 1;
            }
            if ($grid[$buildx][$buildy] <= $grid[$x][$buildy]) {
                $trees['lookingdown'] += 1;
                $blocked['lookingdown'] = true;
            }
        }

        for ($x = ($buildx - 1); $x >= 0; $x--) {
            if ($blocked['lookingup'] == true) {
                continue;
            }
            if ($grid[$buildx][$buildy] > $grid[$x][$buildy]) {
                $trees['lookingup'] += 1;
            }
            if ($grid[$buildx][$buildy] <= $grid[$x][$buildy]) {
                $trees['lookingup'] += 1;
                $blocked['lookingup'] = true;
            }
        }
        // print_r($trees);

        return array_product(array_values($trees));
    }
}
