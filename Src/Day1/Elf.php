<?php

declare(strict_types=1);

namespace Christmas\Day1;

class Elf
{
    public int $Number = 0;

    public int $Calories = 0;

    public function __construct(int $Number = 0, int $Calories = 0)
    {
        $this->Number = $Number;
        $this->Calories = $Calories;
    }
}
