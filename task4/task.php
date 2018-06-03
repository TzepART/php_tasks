<?php

function withBcadd ($a, $b) {
    $sum = bcadd(trim($a), trim($b));
    echo "withBcadd - ".$sum."\n";
}

function myFunction ($a, $b){
    /*
     * Проверить дробные-ли они или нет
     * если да - разделить на дробную и целую части
     * сложить два масива
     * реверсим их
     * Если 1-ый больше, то цикл по-нему, если нет, то по первому
     * бежим по результирующему циклу, если > 10, следующий увеличиваем на 1 а от числа отбрасываем 10
     */
    $arNumbersA = array_reverse(str_split($a));
    $arNumbersB = array_reverse(str_split($b));

    $sizeA = count($arNumbersA);
    $sizeB = count($arNumbersB);

    if($sizeA > $sizeB){
        $largeNumberAr = $arNumbersA;
        $smallNumberAr = $arNumbersB;
        $arSize = $sizeA;
    }else{
        $largeNumberAr = $arNumbersB;
        $smallNumberAr = $arNumbersA;
        $arSize = $sizeB;
    }

    $resultReversAr = [];
    foreach ($largeNumberAr as $index => $number) {
        $resultReversAr[] = $number + (isset($smallNumberAr[$index]) ? $smallNumberAr[$index] : 0);
    }

    for($i = 0; $i < $arSize; $i++) {
        $item = $resultReversAr[$i];
        if($item >= 10){
            $diff = 1;
            $tempResultValue = $item - 10;
        }else{
            $diff = 0;
            $tempResultValue = $item;
        }

        $resultReversAr[$i] = $tempResultValue;

        if($diff == 1){
            if(isset($resultReversAr[$i+1])){
                $resultReversAr[$i+1] = $resultReversAr[$i+1] + $diff;
            }else{
                $resultReversAr[] = $diff;
            }
        }
    }

    $resultAr = array_reverse($resultReversAr);
    $result = implode('',$resultAr);

    echo "witmyFunc - ".$result."\n";
}


$a = "5350353422647252425087405404345435456456456456456456755917897812643";
$b = "53503534226472524250874054075591789781264330331690";

withBcadd($a, $b);
myFunction($a, $b);