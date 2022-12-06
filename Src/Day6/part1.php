<?php

declare(strict_types=1);

namespace Christmas\Day6;

class Part1
{
    public function __construct()
    {
        $input = file(__DIR__ . '/input.txt');

        foreach ($input as $row => $signal) {
            echo 'Checking signal on row ' . $row . "\n";
            $signalLenght = (strlen($signal) - 5);

            for ($i = 0; $i < $signalLenght; $i++) {
                $startOfPacket = substr($signal, $i, 4);
                $unique = str_split(mb_strtolower(trim($startOfPacket)));
                if (count(array_unique($unique)) == 4) {
                    echo 'First Marker of 4 different unique characters: ' . $startOfPacket . '  ends ' . $i + 4 . " chars in\n";

                    break;
                }
            }
        }
    }
}
