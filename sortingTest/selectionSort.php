<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 2019-01-31
 * Time: 01:05
 */


/**
 * @param array $values
 * @return int|mixed
 */
function maxValue(array $values){
    $maxValue = 0;
    $maxValKey = 0;
    foreach ($values as $key => $val) {
        if($val > $maxValue){
            $maxValue = $val;
            $maxValKey = $key;
        }
    }
    unset($values[$maxValKey]);

    return [$values,$maxValue];
}

$length = 100000;
$numbers = range(1, $length);
shuffle($numbers);

$start_time = microtime(true);
$sortArray=[];
for($i = 0; $i < $length; $i++) {
    list($numbers,$pushValue) = maxValue($numbers);
    $sortArray[] = $pushValue;
}

$end_time = microtime(true);

echo "selection sort for $length elements\n";
echo "time: ", bcsub($end_time, $start_time, 4), "\n";