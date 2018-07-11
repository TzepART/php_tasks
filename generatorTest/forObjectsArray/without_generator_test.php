<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11/07/2018
 * Time: 12:06
 */
include "MySplStack.php";


$start_time = microtime(true);
/** @var MySplStack[] $array */
$array = [];
$result = '';

for ($count = 1000000; $count--;) {
    $myStack = (new MySplStack())->initStack();
    $array[] = $myStack;
}

/** @var MySplStack $mySplStack */
foreach ($array as $mySplStack) {
    $mySplStack->outputDataFromStack();
}

$end_time = microtime(true);

echo "without generator\n";
echo "time: ", bcsub($end_time, $start_time, 4), "\n";
echo "memory (kByte): ", memory_get_peak_usage(true) / 1024, "\n";