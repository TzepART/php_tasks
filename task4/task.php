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
    list($integerPartA, $divisionalPartA) = getIntegerAndDivisionalParts($a);
    list($integerPartB, $divisionalPartB) = getIntegerAndDivisionalParts($b);

    $arNumbersA = str_split($divisionalPartA);
    $arNumbersB = str_split($divisionalPartB);
    list($integerPart, $resultDivisionAr) = getSummDivisionPartArray($arNumbersA, $arNumbersB);
    if(!empty($resultDivisionAr)){
        array_unshift($resultDivisionAr, '.');
    }

    $arNumbersA = str_split($integerPartA);
    $arNumbersB = str_split($integerPartB);
    $resultIntegerAr = getSummIntegerPartArray($arNumbersA, $arNumbersB, $integerPart);
    $resultNumberAr = array_merge($resultIntegerAr,$resultDivisionAr);

    $result = implode('',$resultNumberAr);

    echo "witmyFunc - ".$result."\n";
}

/**
 * @param $a
 * @return array
 */
function getIntegerAndDivisionalParts($a): array
{
    $integerPart = '';
    $divisionalPart = '';

    $delimiterNumber = explode('.', $a);
    if (count($delimiterNumber) <= 2 && isset($delimiterNumber[0])) {
        $integerPart = $delimiterNumber[0];
    }

    if (count($delimiterNumber) <= 2 && isset($delimiterNumber[1])) {
        $divisionalPart = $delimiterNumber[1];
    }

    return array($integerPart, $divisionalPart);
}

/**
 * @param $arNumbersA
 * @param $arNumbersB
 * @return array
 */
function getSummDivisionPartArray($arNumbersA, $arNumbersB): array
{
    $integerPart = 0;
    $additionalNumbersAr = [];

    $sizeA = count($arNumbersA);
    $sizeB = count($arNumbersB);

    if ($sizeA > $sizeB) {
        $additionalNumbersAr = array_slice($arNumbersA, $sizeB);
        $arNumbersA = array_slice($arNumbersA, 0, $sizeB);
    } else if($sizeB > $sizeA) {
        $additionalNumbersAr = array_slice($arNumbersB, $sizeA);
        $arNumbersB = array_slice($arNumbersB, 0, $sizeA);
    }

    $sizeA = count($arNumbersA);
    $sizeB = count($arNumbersB);
    $arReversNumbersA = array_reverse($arNumbersA);
    $arReversNumbersB = array_reverse($arNumbersB);

    if ($sizeA > $sizeB) {
        $largeNumberAr = $arReversNumbersA;
        $smallNumberAr = $arReversNumbersB;
        $arSize = $sizeA;
    } else {
        $largeNumberAr = $arReversNumbersB;
        $smallNumberAr = $arReversNumbersA;
        $arSize = $sizeB;
    }

    $resultReversAr = [];
    foreach ($largeNumberAr as $index => $number) {
        $resultReversAr[] = $number + (isset($smallNumberAr[$index]) ? $smallNumberAr[$index] : 0);
    }

    for ($i = 0; $i < $arSize; $i++) {
        $item = $resultReversAr[$i];
        if ($item >= 10) {
            $diff = 1;
            $tempResultValue = $item - 10;
        } else {
            $diff = 0;
            $tempResultValue = $item;
        }

        $resultReversAr[$i] = $tempResultValue;

        if ($diff == 1) {
            if (isset($resultReversAr[$i + 1])) {
                $resultReversAr[$i + 1] = $resultReversAr[$i + 1] + $diff;
            } else {
                $integerPart = $diff;
            }
        }
    }

    $resultAr = array_reverse($resultReversAr);
    if(!empty($additionalNumbersAr)){
        $resultAr = array_merge($resultAr,$additionalNumbersAr);
    }

    return array($integerPart,$resultAr);
}

/**
 * @param $arNumbersA
 * @param $arNumbersB
 * @param $additionalNumber
 * @return array
 */
function getSummIntegerPartArray($arNumbersA, $arNumbersB, $additionalNumber = 0): array
{
    $arReversNumbersA = array_reverse($arNumbersA);
    $arReversNumbersB = array_reverse($arNumbersB);

    $sizeA = count($arReversNumbersA);
    $sizeB = count($arReversNumbersB);

    if ($sizeA > $sizeB) {
        $largeNumberAr = $arReversNumbersA;
        $smallNumberAr = $arReversNumbersB;
        $arSize = $sizeA;
    } else {
        $largeNumberAr = $arReversNumbersB;
        $smallNumberAr = $arReversNumbersA;
        $arSize = $sizeB;
    }

    $resultReversAr = [];
    foreach ($largeNumberAr as $index => $number) {
        $resultReversAr[] = $number + (isset($smallNumberAr[$index]) ? $smallNumberAr[$index] : 0);
    }

    $resultReversAr[0] += $additionalNumber;

    for ($i = 0; $i < $arSize; $i++) {
        $item = $resultReversAr[$i];
        if ($item >= 10) {
            $diff = 1;
            $tempResultValue = $item - 10;
        } else {
            $diff = 0;
            $tempResultValue = $item;
        }

        $resultReversAr[$i] = $tempResultValue;

        if ($diff == 1) {
            if (isset($resultReversAr[$i + 1])) {
                $resultReversAr[$i + 1] = $resultReversAr[$i + 1] + $diff;
            } else {
                $resultReversAr[] = $diff;
            }
        }
    }

    $resultAr = array_reverse($resultReversAr);

    return $resultAr;
}


$a = "343434343434.055";
$b = "546546456456456455645645.666665645645654";

withBcadd($a, $b);
myFunction($a, $b);