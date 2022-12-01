<?php

declare(strict_types=1);

namespace Christmas\Day1;

class Elfs
{
    private array $Collection = [];

    private int $MaximumElfs = 0;

    private function add(Elf $elf)
    {
        $this->Collection[] = $elf;
        $this->sort();
    }

    private function sort(bool $asc = false): self
    {
        usort($this->Collection, function (Elf $a, Elf $b) use ($asc) {
            if ($asc) {
                return $a->Calories < $b->Calories;
            } else {
                return $a->Calories > $b->Calories;
            }
        });

        return $this;
    }

    public function replaceLowestCaloriesWith(Elf $withElf): self
    {
        if (
            empty($this->Collection)
        ) {
            $this->add($withElf);

            return $this;
        }

        foreach ($this->Collection as $key => $elf) {
            /**
             * @var Elf $elf
             */
            if (
                ($elf->Calories <= $withElf->Calories &&
                    $elf->Number != $withElf->Number)
            ) {
                // echo $key . "\n";
                if (($this->elfLenght() < $this->MaximumElfs)) {
                    $this->add($withElf);
                } else {
                    unset($this->Collection[$key]);
                    $this->Collection[] = $withElf;
                    $this->sort();
                }

                return $this;
            }
        }

        return $this;
    }

    public function elfLenght(): int
    {
        return count($this->Collection);
    }

    public function isCaloriesTopOfCollection(Elf $checkElf): bool
    {
        if (
            empty($this->Collection)
        ) {
            return true;
        }
        foreach ($this->Collection as $elf) {
            /**
             * @var Elf $elf
             */
            if (
                $elf->Calories < $checkElf->Calories ||
                (
                    $elf->Calories <= $checkElf->Calories &&
                    $elf->Number != $checkElf->Number
                )
            ) {
                return true;
            }
        }

        return false;
    }

    public function getCollection(): array
    {
        $this->sort(true);

        return $this->Collection;
    }

    public function setMax(int $max): self
    {
        $this->MaximumElfs = $max;

        return $this;
    }

    public function getTotalCalories(): int
    {
        return (int) array_reduce(
            $this->Collection,
            function ($carry, Elf $elf) {
                $carry->Calories += $elf->Calories;

                return $carry;
            },
            (new Elf(0, 0))
        )->Calories;
    }
}
