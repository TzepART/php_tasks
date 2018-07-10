<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 10/07/2018
 * Time: 19:06
 */


$start_time=microtime(true);
$array = [];
$result = '';
for($count=1000000; $count--;)
{
    $array[]=$count/2;
}
foreach($array as $val)
{
    $val += 145.56;
    $result .= $val;
}
$end_time=microtime(true);

echo "without generator\n";
echo "time: ", bcsub($end_time, $start_time, 4), "\n";
echo "memory (kByte): ", memory_get_peak_usage(true)/1024, "\n";