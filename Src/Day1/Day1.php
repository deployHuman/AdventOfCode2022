<?php

declare(strict_types=1);

namespace Christmas\Day1;

$input = file(__DIR__ . '/input.txt');
$elfTotalCalories = 0;
$elfNumber = 0;
$ElfWithMost = new Elf();

foreach ($input as $row => $value) {
    if (is_numeric($value)) {
        $elfTotalCalories += $value;
    }

    if (empty(trim($value))) {
        if ($ElfWithMost->Calories < $elfTotalCalories) {
            $ElfWithMost->Calories = $elfTotalCalories;
            $ElfWithMost->number = $elfNumber;
        }
        $elfTotalCalories = 0;
        $elfNumber += 1;
    }
}

echo 'The Elf with most Calories was number ' . $ElfWithMost->number . ' with ' . $ElfWithMost->Calories . " Calories\r\n";
echo 'Answer Day 1 - Question 1: ' . $ElfWithMost->Calories . ' Question 2: ';
