<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$homepath = (string) __DIR__ . '\Src';
$today = (new \DateTime())->format('j');
$prefix = 'Day';
$newFileContent = '<?php

declare(strict_types=1);

namespace Christmas\Day' . $today . ';

$input = file(__DIR__ . \'/input.txt\');
';

$todaysFolder = $homepath . '/' . $prefix . $today;
$todaysFilename = $prefix . $today . '.php';
$fullPathTotodaysFile = $todaysFolder . DIRECTORY_SEPARATOR . $todaysFilename;

if (! is_dir($todaysFolder)) {
    mkdir($todaysFolder);
}

if (! file_exists($fullPathTotodaysFile)) {
    $fo = fopen(
        $fullPathTotodaysFile,
        'w'
    );
    fwrite($fo, $newFileContent);
}

require_once $fullPathTotodaysFile;
