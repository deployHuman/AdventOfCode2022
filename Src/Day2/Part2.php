<?php

declare(strict_types=1);

namespace Christmas\Day2;

class Part2
{
    private array $opponentMeaning = [
        'A' => 'ROCK', //rock
        'B' => 'PAPER', //Paper
        'C' => 'SCISSORS', //Scissors
    ];

    private array $MyresponseMeaning = [
        'X' => 'lost',
        'Y' => 'draw',
        'Z' => 'win',
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

        echo 'Answer Day 2 - Question 2: ' . $totalscore . "\n";
    }

    public function calculateScore(string $opponent, string $myResponse): int
    {
        $myResponse = $this->MyresponseMeaning[$myResponse];
        $opponent = $this->opponentMeaning[$opponent];

        $returnscore = 0;

        if ($myResponse == 'draw') {
            $returnscore = $this->roundScore['draw'] + $this->itemvalue[$opponent];
        }

        if ($myResponse == 'win') {
            $returnscore = $this->roundScore['win'];
            switch ($opponent) {
                case 'ROCK':
                    $returnscore += $this->itemvalue['PAPER'];

                    break;
                case 'PAPER':
                    $returnscore += $this->itemvalue['SCISSORS'];

                    break;
                case 'SCISSORS':
                    $returnscore += $this->itemvalue['ROCK'];

                    break;
            }
        }
        if ($myResponse == 'lost') {
            $returnscore = $this->roundScore['lost'];
            switch ($opponent) {
                case 'ROCK':
                    $returnscore += $this->itemvalue['SCISSORS'];

                    break;
                case 'PAPER':
                    $returnscore += $this->itemvalue['ROCK'];

                    break;
                case 'SCISSORS':
                    $returnscore += $this->itemvalue['PAPER'];

                    break;
            }
        }

        return $returnscore;
    }
}
