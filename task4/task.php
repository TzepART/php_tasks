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

    list($resultAr,$integerPart) = additionTwoSequences($arNumbersA, $arNumbersB);

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
    list($resultAr) = additionTwoSequences($arNumbersA, $arNumbersB, $additionalNumber);

    return $resultAr;
}

function additionTwoSequences($sequence1, $sequence2, $additionalNumber = 0){
    $additionalElement = 0;

    $arReversSequence1 = array_reverse($sequence1);
    $arReversSequence2 = array_reverse($sequence2);

    $sizeA = count($arReversSequence1);
    $sizeB = count($arReversSequence2);

    if ($sizeA > $sizeB) {
        $largeNumberAr = $arReversSequence1;
        $smallNumberAr = $arReversSequence2;
        $arSize = $sizeA;
    } else {
        $largeNumberAr = $arReversSequence2;
        $smallNumberAr = $arReversSequence1;
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
                $additionalElement = $diff;
            }
        }
    }

    $resultSequence = array_reverse($resultReversAr);

    return [$resultSequence,$additionalElement];
}

$a = "3434343433434343343434334343433434343343434334343433434343343434334343433434343343434334343433434343434.055";
$b = "54654645645645645564564556456455645645564564556456455645645564564556456455645645564564556456455645645564564556456455645645.666665645645654";

withBcadd($a, $b);
myFunction($a, $b);