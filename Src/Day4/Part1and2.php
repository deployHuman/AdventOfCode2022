<?php

declare(strict_types=1);

namespace Christmas\Day4;

class Part1and2
{
    public function __construct()
    {
        $input = file(__DIR__ . '/input.txt');

        $WhollyduplicatedCleaningArea = 0;
        $PartlyduplicatedCleaningArea = 0;

        foreach ($input as $row => $value) {
            $pairs = $this->orderPairsLowestFirst($this->getPairs(trim($value)));
            if ($this->isOnePairWhollyCovered($pairs)) {
                $WhollyduplicatedCleaningArea += 1;
            }
            if ($this->isOnePairPartlyCovered($pairs)) {
                $PartlyduplicatedCleaningArea += 1;
            }
        }

        echo 'Answer Day 4 - Question 1: ' . $WhollyduplicatedCleaningArea . ' Question 2: ' . $PartlyduplicatedCleaningArea . "\n";
    }

    public function orderPairsLowestFirst(array $unsortedPairs): array
    {
        $firstSectors = $unsortedPairs[0];
        $secondSectors = $unsortedPairs[1];

        if ($firstSectors[0] == $secondSectors[0]) {
            if ($firstSectors[1] >= $secondSectors[1]) {
                $lowestStartingSector = $firstSectors;
                $highestStartingSector = $secondSectors;
            } else {
                $lowestStartingSector = $secondSectors;
                $highestStartingSector = $firstSectors;
            }
        } elseif ($firstSectors[0] < $secondSectors[0]) {
            $lowestStartingSector = $firstSectors;
            $highestStartingSector = $secondSectors;
        } else {
            $lowestStartingSector = $secondSectors;
            $highestStartingSector = $firstSectors;
        }

        return [0 => $lowestStartingSector, 1 => $highestStartingSector];
    }

    public function isOnePairPartlyCovered(array $cleaningPairs): bool
    {
        return $cleaningPairs[0][1] >= $cleaningPairs[1][0];
    }

    public function isOnePairWhollyCovered(array $cleaningPairs): bool
    {
        return $cleaningPairs[0][1] >= $cleaningPairs[1][1];
    }

    public function getPairs(string $bothPairofCleaningSpan)
    {
        $delimiterPOS = strpos($bothPairofCleaningSpan, ',');
        $firstPair = substr($bothPairofCleaningSpan, 0, $delimiterPOS);
        $SecondPair = substr($bothPairofCleaningSpan, $delimiterPOS + 1);

        $firstPairArray = [0 => substr($firstPair, 0, stripos($firstPair, '-')), 1 => substr($firstPair, stripos($firstPair, '-') + 1)];
        $secondPairArray = [0 => substr($SecondPair, 0, stripos($SecondPair, '-')), 1 => substr($SecondPair, stripos($SecondPair, '-') + 1)];

        return [0 => $firstPairArray, 1 => $secondPairArray];
    }
}
