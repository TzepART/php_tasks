<?php

function withBcadd ($a, $b) {
    $sum = bcadd(trim($a), trim($b));
    echo "withBcadd - ".$sum."\n";
}

function myFunction ($a, $b){
    $result = '';
    $arNumbersA = array_reverse(str_split($a));
    $arNumbersB = array_reverse(str_split($b));

    $sizeA = count($arNumbersA);
    $sizeB = count($arNumbersB);
    $temResult = [];

    foreach ($arNumbersA as $index => $numberA) {
        $tempSumm = $numberA + $arNumbersB[$index];
        if($tempSumm >= 10){
            $diff = 1;
            $tempResultValue = $tempSumm - 10;
        }else{
            $diff = 0;
            $tempResultValue = $tempSumm;
        }

        if(isset($arNumbersB[$index+1])){
            $arNumbersB[$index+1] = $arNumbersB[$index+1] + $diff;
            $temResult[] = $tempResultValue;
        }else{
            $temResult[] = $tempResultValue;
            if($diff == 1){
                $temResult[] = 1;
            }
        }
    }
    $resultAr = array_reverse($temResult);
    $result = implode('',$resultAr);

    echo "witmyFunc - ".$result."\n";
}


$a = "53503534226472524250874054075591789781264330331690";
$b = "53503534226472524250874054075591789781264330331690";

withBcadd($a, $b);
myFunction($a, $b);