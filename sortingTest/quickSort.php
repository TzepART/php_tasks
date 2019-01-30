<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 2019-01-31
 * Time: 01:24
 */


/**
 * @param array $sortArray
 * @return array
 */
function quickSort(array $sortArray){
    $length = count($sortArray);
    if($length < 2){
        return $sortArray;
    }else{
        $randElement = $sortArray[array_rand($sortArray)];
        $leftAr = [];
        $rightAr = [];
        foreach ($sortArray as $number) {
            if($number < $randElement){
                $rightAr[] = $number;
            }else{
                $leftAr[] = $number;
            }
        }
        return array_merge(quickSort($leftAr),quickSort($rightAr));
    }

}

$length = 100000;
$numbers = range(1, $length);
shuffle($numbers);

$start_time = microtime(true);
$sortArray=quickSort($numbers);
$end_time = microtime(true);

echo "quick sort for $length elements\n";
echo "time: ", bcsub($end_time, $start_time, 4), "\n";