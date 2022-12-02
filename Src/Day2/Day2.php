<?php

declare(strict_types=1);

namespace Christmas\Day2;

$input = file(__DIR__ . '/input.txt');

//Rock(1) defeats Scissors(3)
//Scissors(3) defeats Paper(2)
//Paper(2) defeats Rock(1)
//If both players choose the same shape, the round instead ends in a draw.

$opponentMeaning = [
    'A' => 'ROCK', //rock
    'B' => 'PAPER', //Paper
    'C' => 'SCISSORS', //Scissors
];

$MyresponseMeaning = [
    'X' => 'ROCK',
    'Y' => 'PAPER',
    'Z' => 'SCISSORS',
];

$itemvalue = [
    'ROCK' => 1,
    'PAPER' => 2,
    'SCISSORS' => 3,
];

$roundScore = [
    'win' => 6,
    'draw' => 3,
    'lost' => 0,
];

function calculateScore(string $opponent, string $myResponse): int
{
    global $opponentMeaning;
    global $MyresponseMeaning;
    global $roundScore;
    global $itemvalue;

    $myResponse = $MyresponseMeaning[$myResponse];
    $opponent = $opponentMeaning[$opponent];

    $returnscore = 0;

    if ($opponent == $myResponse) {
        $returnscore = $roundScore['draw'];
    }

    if ($opponent == 'ROCK' && $myResponse == 'PAPER') {
        $returnscore = $roundScore['win'];
    }

    if ($opponent == 'SCISSORS' && $myResponse == 'PAPER') {
        $returnscore = $roundScore['lost'];
    }

    if ($opponent == 'ROCK' && $myResponse == 'SCISSORS') {
        $returnscore = $roundScore['lost'];
    }

    if ($opponent == 'PAPER' && $myResponse == 'SCISSORS') {
        $returnscore = $roundScore['win'];
    }

    if ($opponent == 'SCISSORS' && $myResponse == 'ROCK') {
        $returnscore = $roundScore['win'];
    }

    if ($opponent == 'PAPER' && $myResponse == 'ROCK') {
        $returnscore = $roundScore['lost'];
    }

    return $returnscore + $itemvalue[$myResponse];
}

$totalscore = 0;

foreach ($input as $row => $value) {
    if (empty(trim($value))) {
        continue;
    }

    $hand = substr($value, 0, 1);
    $response = substr($value, 2, 1);

    $totalscore += calculateScore($hand, $response);
}

echo 'Answer Day 2 - Question 1: ' . $totalscore;
