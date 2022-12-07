<?php

declare(strict_types=1);

namespace Christmas\Day7;

class Part1
{
    public array $structureSizes = [];

    public int $totalUsedSpace = 0;

    public function __construct()
    {
        $input = file(__DIR__ . '/input.txt');
        $currentdir = '\\';
        $fileStructure = [];

        foreach ($input as $row => $command) {
            $command = trim($command);
            $commandArray = explode(' ', $command);
            if ($commandArray[0] == '$') {
                if ($commandArray[1] == 'cd') {
                    if ($commandArray[2] == '..') {
                        $currentdir = dirname($currentdir);
                    } else {
                        $currentdir .= '/' . $commandArray[2];
                    }
                }
            } elseif (is_numeric($commandArray[0])) {
                $this->addSizeToPath($fileStructure, $currentdir, $commandArray[1], $commandArray[0]);
                $this->totalUsedSpace += $commandArray[0];
            }
        }

        $MatchingFoldersPart1 = ($this->findFoldersWithMaxSize($this->structureSizes, 100000));

        $totalspace = 70000000;
        $neededSpaceForUpdate = 30000000;

        $emptySpace = $totalspace - $this->totalUsedSpace;
        $lookForEtleast = $neededSpaceForUpdate - $emptySpace;

        echo 'Answer Day 7 - Question 1: ' . array_sum($MatchingFoldersPart1) . ' Question 2: ' . $this->getClosest($lookForEtleast, $this->structureSizes) . "\n";
    }

    public function getClosest(int $search, array $arr)
    {
        rsort($arr);
        $closest = null;
        $keyfound = '';
        foreach ($arr as $key => $item) {
            if ($closest === null || abs($search - $closest) > abs($item - $search)) {
                $closest = $item;
                $keyfound = $key;
            }
        }

        return $arr[$keyfound - 1];
    }

    public function findFoldersWithMaxSize(array $folderStructure, int $maxSize): array
    {
        $returnarray = [];
        array_walk($folderStructure, function ($size, $key) use ($maxSize, &$returnarray) {
            if ($size <= $maxSize) {
                $returnarray[$key] = $size;
            }
        });

        return $returnarray;
    }

    public function addSizeToPath(&$arr, $path, $key, $value, $separator = '/')
    {
        $path = preg_replace('/' . preg_quote($separator, '/') . '+/', $separator, $path);
        $nested = array_filter(explode($separator, $path));
        $nestling = '';
        foreach ($nested as $subkey) {
            $arr = &$arr[$subkey];
            $nestling .= '\\' . $subkey;
            if (empty($this->structureSizes[$nestling])) {
                $this->structureSizes[$nestling] = 0;
            }
            $this->structureSizes[$nestling] += $value;
        }
        $arr[$key] = $value;
    }
}
