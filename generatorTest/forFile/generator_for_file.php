<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 10/07/2018
 * Time: 19:21
 */

$start_time = microtime(true);

/**
 * @param $file
 * @return Generator
 */
function getLines($file) {
    $f = fopen($file, 'r');
    try {
        while ($line = fgets($f)) {
            yield $line;
        }
    } finally {
        fclose($f);
    }
}

$length = 0;
foreach (getLines("file.txt") as $n => $line) {
    $length += strlen($line);
}

$end_time = microtime(true);

echo "$length\n";

echo "with generator\n";
echo "time: ", bcsub($end_time, $start_time, 4), "\n";
echo "memory (kByte): ", memory_get_peak_usage(true) / 1024, "\n";