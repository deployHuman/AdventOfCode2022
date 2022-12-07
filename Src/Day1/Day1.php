<?php

declare(strict_types=1);

namespace Christmas\Day1;

$input = file(__DIR__ . '/input.txt');
$elfTotalCalories = 0;
$elfNumber = 1;
$elfcollection = new Elfs();
$elfcollection->setMax(3);

foreach ($input as $row => $value) {
    if (is_numeric($value)) {
        $elfTotalCalories += $value;
    }

    if (empty(trim($value))) {
        $newElf = (new Elf($elfNumber, $elfTotalCalories));
        $elfcollection->replaceLowestCaloriesWith($newElf);
        $elfTotalCalories = 0;
        $elfNumber += 1;
    }
}

$allfound = $elfcollection->getCollection();
// echo "\nResults:\n";
// foreach ($allfound as $key => $value) {
//     echo 'Elf Nr: ' . $value->Number . ' Has ' . $value->Calories . " Calories\n";
// }
echo 'Answer Day 1 - Question 1: ' . $allfound[0]->Calories . ' Question 2: ' . $elfcollection->getTotalCalories() . "\n";
