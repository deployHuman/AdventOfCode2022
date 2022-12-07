<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$homepath = (string) __DIR__ . '\Src';
$today = (new \DateTime())->format('j');
$prefix = 'Day';
$newFileContent = '<?php

declare(strict_types=1);

namespace Christmas\Day' . $today . ';

';

$partContent = "    public function __construct()
{
    \$input = file(__DIR__ . '/input.txt');


}

";

$todaysFolder = $homepath . '/' . $prefix . $today;
$todaysFilename = $prefix . $today . '.php';
$fullPathTotodaysFile = $todaysFolder . DIRECTORY_SEPARATOR . $todaysFilename;

createFolder($todaysFolder);

createFile($fullPathTotodaysFile, $newFileContent);
createFile($todaysFolder . DIRECTORY_SEPARATOR . 'input.txt');
createFile($todaysFolder . DIRECTORY_SEPARATOR . 'part1.php', $newFileContent . "\nClass Part1\n{" . $partContent . '}');
createFile($todaysFolder . DIRECTORY_SEPARATOR . 'part2.php', $newFileContent . "\nClass Part2\n{" . $partContent . '}');

function createFile(string $fullpathTofile, string $content = '')
{
    if (! file_exists($fullpathTofile)) {
        $fo = fopen(
            $fullpathTofile,
            'w'
        );
        fwrite($fo, $content);
    }
}

function createFolder(string $fullpath)
{
    if (! is_dir($fullpath)) {
        mkdir($fullpath);
    }
}

$allDays = scandir($homepath . '/');
unset($allDays[0]);
unset($allDays[1]);

if (empty($argv[1])) {
    require_once $fullPathTotodaysFile;
} else {
    if ($argv[1] == 'all') {
        foreach ($allDays as $key => $value) {
            require_once $homepath . '/' . $value . '/' . $value . '.php';
        }
    } elseif (! empty($argv) && is_numeric($argv[1])) {
        $specificday = $homepath . '/Day' . $argv[1] . '/Day' . $argv[1] . '.php';
        if (file_exists($specificday)) {
            require_once $specificday;
        } else {
            echo "That day doesn't exist";
        }
    }
}
