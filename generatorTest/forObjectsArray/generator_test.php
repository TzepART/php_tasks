<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11/07/2018
 * Time: 12:06
 */
include "MySplStack.php";

$start_time = microtime(true);
$result = '';

function initMySplStack()
{
    for ($count = 1000000; $count--;) {
        yield (new MySplStack())->initStack();
    }
}

/** @var MySplStack $mySplStack */
foreach (initMySplStack() as $mySplStack) {
    $mySplStack->outputDataFromStack();
}

$end_time = microtime(true);

echo "with generator\n";
echo "time: ", bcsub($end_time, $start_time, 4), "\n";
echo "memory (kByte): ", memory_get_peak_usage(true) / 1024, "\n";
