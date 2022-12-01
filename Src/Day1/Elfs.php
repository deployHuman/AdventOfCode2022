<?php

declare(strict_types=1);

namespace Christmas\Day1;

class Elfs
{
    private array $Collection = [];

    private int $maximumElfs = 0;

    public function addElf(Elf $elf)
    {
        $this->Collection[] = $elf;
    }

    public function getElfCollection(): array
    {
        return $this->Collection;
    }

    public function getTotalCalories(): int
    {
        return (int) array_reduce(
            $this->Collection,
            function (Elf $carry, Elf $elf) {
                return $carry->Calories + $elf->Calories;
            }
        );
    }
}
