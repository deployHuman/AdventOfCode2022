<?php

declare(strict_types=1);

namespace Christmas\Day6;

class Part1
{
    public function __construct()
    {
        $input = file(__DIR__ . '/input.txt');
        $question1 = 0;
        $question2 = 0;
        foreach ($input as $row => $signal) {
            // echo 'Checking signal on row ' . $row . "\n";
            $signal = mb_strtolower(trim($signal));
            $signalLenght = (strlen($signal) - 5);

            $startOfPacketLenght = 4;
            for ($i = 0; $i < $signalLenght; $i++) {
                $startOfPacket = substr($signal, $i, $startOfPacketLenght);
                if (count(array_unique(str_split($startOfPacket))) == $startOfPacketLenght) {
                    $question1 = $i + $startOfPacketLenght;
                    // echo 'Found 4 charachter long Start Of Packet: \'' . $startOfPacket . '\' and it ends ' . $question1 . " chars in\n";

                    break;
                }
            }

            $startOfMessageLenght = 14;
            for ($i = 0; $i < $signalLenght; $i++) {
                $startOfMessage = substr($signal, $i, $startOfMessageLenght);
                if (count(array_unique(str_split($startOfMessage))) == $startOfMessageLenght) {
                    $question2 = $i + $startOfMessageLenght;
                    // echo 'Found 14 charachter long Start Of Message: \'' . $startOfMessage . '\' and it ends ' . $question2. " chars in\n";
                    break;
                }
            }
        }
        echo 'Answer Day 6 - Question 1: ' . $question1 . ' Question 2: ' . $question2;
    }
}
