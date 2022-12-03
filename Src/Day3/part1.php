<?php

declare(strict_types=1);

namespace Christmas\Day3;

class Part1
{
    public function __construct()
    {
        //lower letter 97
        //upper letter 65
        $input = file(__DIR__ . '/input.txt');

        $sumOfPrio = 0;
        foreach ($input as $row => $value) {
            if (! empty($value)) {
                $sumOfPrio += $this->getItemPriority(self::getCommonItemInRucksacks($value));
            }
        }
        echo 'Answer Day 3 - Question 1: ' . $sumOfPrio . "\n";
    }

    public static function getItemPriority(string $item): int
    {
        if (mb_strtolower($item) == $item) {
            return  ord($item) - 96;
        } else {
            return ord($item) - 38;
        }
    }

    public static function getCommonItemInRucksacks(string $longRucksacks): ?string
    {
        $value = trim($longRucksacks);
        $length = strlen($value);
        $halvLength = $length / 2;

        $firstCompartment = str_split(mb_substr($value, 0, $halvLength));
        $secondCompartment = str_split(mb_substr($value, $halvLength));

        $intersectingLetter = array_values(array_intersect($firstCompartment, $secondCompartment));
        if (! empty($intersectingLetter)) {
            return $intersectingLetter[0];
        }
    }
}
