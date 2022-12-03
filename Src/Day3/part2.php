<?php

declare(strict_types=1);

namespace Christmas\Day3;

class Part2
{
    public function __construct()
    {
        //lower letter 97
        //upper letter 65
        $input = file(__DIR__ . '/input.txt');

        $groupMember = 1;
        $groupSize = 3;
        $groupAllSacks = [];
        $sumOfPrioritiesOfAllGroupBadges = 0;
        foreach ($input as $row => $value) {
            $value = trim($value);
            if (empty($value)) {
                continue;
            }
            $groupAllSacks[] = str_split($value);
            if ($groupMember == $groupSize) {
                $sumOfPrioritiesOfAllGroupBadges += Part1::getItemPriority(self::getCommonItemInWholeGroup($groupAllSacks));
                $groupAllSacks = [];
                $groupMember = 0;
            }

            $groupMember += 1;
        }

        echo 'Answer Day 3 - Question 2: ' . $sumOfPrioritiesOfAllGroupBadges . "\n\n";
    }

    public static function getCommonItemInWholeGroup(array $groupAllSacks): ?string
    {
        $intersect = array_intersect(...$groupAllSacks);
        if (empty($intersect)) {
            return null;
        }

        return array_values($intersect)[0];
    }
}
