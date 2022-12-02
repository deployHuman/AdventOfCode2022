<?php

declare(strict_types=1);

namespace Christmas\Day2;

class Part1
{
    private array $opponentMeaning = [
        'A' => 'ROCK', //rock
        'B' => 'PAPER', //Paper
        'C' => 'SCISSORS', //Scissors
    ];

    private array $MyresponseMeaning = [
        'X' => 'ROCK',
        'Y' => 'PAPER',
        'Z' => 'SCISSORS',
    ];

    private array $itemvalue = [
        'ROCK' => 1,
        'PAPER' => 2,
        'SCISSORS' => 3,
    ];

    private array $roundScore = [
        'win' => 6,
        'draw' => 3,
        'lost' => 0,
    ];

    public function __construct()
    {
        $input = file(__DIR__ . '/input.txt');

        //Rock(1) defeats Scissors(3)
        //Scissors(3) defeats Paper(2)
        //Paper(2) defeats Rock(1)
        //If both players choose the same shape, the round instead ends in a draw.
        $totalscore = 0;

        foreach ($input as $row => $value) {
            if (empty(trim($value))) {
                continue;
            }

            $hand = substr($value, 0, 1);
            $response = substr($value, 2, 1);

            $totalscore += $this->calculateScore($hand, $response);
        }

        echo 'Answer Day 2 - Question 1: ' . $totalscore . "\n";
    }

    public function calculateScore(string $opponent, string $myResponse): int
    {
        $myResponse = $this->MyresponseMeaning[$myResponse];
        $opponent = $this->opponentMeaning[$opponent];

        $returnscore = 0;

        if ($opponent == $myResponse) {
            $returnscore = $this->roundScore['draw'];
        }

        if ($opponent == 'ROCK' && $myResponse == 'PAPER') {
            $returnscore = $this->roundScore['win'];
        }

        if ($opponent == 'SCISSORS' && $myResponse == 'PAPER') {
            $returnscore = $this->roundScore['lost'];
        }

        if ($opponent == 'ROCK' && $myResponse == 'SCISSORS') {
            $returnscore = $this->roundScore['lost'];
        }

        if ($opponent == 'PAPER' && $myResponse == 'SCISSORS') {
            $returnscore = $this->roundScore['win'];
        }

        if ($opponent == 'SCISSORS' && $myResponse == 'ROCK') {
            $returnscore = $this->roundScore['win'];
        }

        if ($opponent == 'PAPER' && $myResponse == 'ROCK') {
            $returnscore = $this->roundScore['lost'];
        }

        return $returnscore + $this->itemvalue[$myResponse];
    }
}
