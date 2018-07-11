<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 10/07/2018
 * Time: 19:21
 */

$start_time = microtime(true);

$arrayFile = file("file.txt");

$length = 0;
foreach ($arrayFile as $n => $line) {
    $length += strlen($line);
}

$end_time = microtime(true);

echo "$length\n";
echo "without generator\n";
echo "time: ", bcsub($end_time, $start_time, 4), "\n";
echo "memory (kByte): ", memory_get_peak_usage(true) / 1024, "\n";