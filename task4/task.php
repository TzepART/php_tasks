<?php

/**
 * Class NumberModel
 */
class NumberModel{

    /**
     * @var string
     */
    private $strNumber;

    /**
     * @var string
     */
    private $strIntegerPart = '';

    /**
     * @var string
     */
    private $strDivisionalPart = '';


    /**
     * ModelNumber constructor.
     * @param string $strNumber
     */
    public function __construct(string $strNumber)
    {
        $this->strNumber = $strNumber;
        $this->initIntegerAndDivisionalParts();
    }

    /**
     * @return string
     */
    public function getStrIntegerPart(): string
    {
        return $this->strIntegerPart;
    }

    /**
     * @return string
     */
    public function getStrDivisionalPart(): string
    {
        return $this->strDivisionalPart;
    }

    /**
     * @return array
     */
    public function getIntegerPartAsArray(): array
    {
        return !empty($this->strIntegerPart) ? str_split($this->strIntegerPart) : [];
    }

    /**
     * @return array
     */
    public function getDivisionalPartAsArray(): array
    {
        return !empty($this->strDivisionalPart) ? str_split($this->strDivisionalPart) : [];
    }

    /**
     * @return $this
     * @throws Exception
     */
    private function initIntegerAndDivisionalParts()
    {
        $delimiterNumber = explode('.', $this->strNumber);
        if (count($delimiterNumber) <= 2){
            if (isset($delimiterNumber[0])) {
                $this->strIntegerPart = $delimiterNumber[0];
            }

            if (isset($delimiterNumber[1])) {
                $this->strDivisionalPart = $delimiterNumber[1];
            }
        }else{
            throw new Exception('Number is not valid.');
        }

        return $this;
    }
    
}

/**
 * Class NumberManager
 */
class NumberManager{
    
    /**
     * @var NumberModel
     */
    private $numberModelA;

    /**
     * @var NumberModel
     */
    private $numberModelB;

    /**
     * @var array
     */
    private $resultSumDivisionAr;

    /**
     * @var array
     */
    private $resultSumIntegerAr;

    /**
     * @var int
     */
    private $additionalDivisionalNumber = 0;
    

    /**
     * NumberManager constructor.
     * @param NumberModel $numberModelA
     * @param NumberModel $numberModelB
     */
    public function __construct(NumberModel $numberModelA, NumberModel $numberModelB)
    {
        $this->numberModelA = $numberModelA;
        $this->numberModelB = $numberModelB;
    }

    /**
     * @return string
     */
    public function getSumAsString()
    {
        //сложение дробной части
        $this->initSumDivisionPartArray();

        //сложение целой части
        $this->initSumIntegerPartArray();

        $resultNumberAr = array_merge($this->resultSumIntegerAr,$this->resultSumDivisionAr);

        $result = implode('',$resultNumberAr);

        return $result;
    }

    /**
     * @return $this
     */
    private function initSumDivisionPartArray()
    {
        $additionalNumbersAr = [];

        $arNumbersA = $this->numberModelA->getDivisionalPartAsArray();
        $arNumbersB = $this->numberModelB->getDivisionalPartAsArray();

        $sizeA = count($arNumbersA);
        $sizeB = count($arNumbersB);

        if ($sizeA > $sizeB) {
            $additionalNumbersAr = array_slice($arNumbersA, $sizeB);
            $arNumbersA = array_slice($arNumbersA, 0, $sizeB);
        } else if($sizeB > $sizeA) {
            $additionalNumbersAr = array_slice($arNumbersB, $sizeA);
            $arNumbersB = array_slice($arNumbersB, 0, $sizeA);
        }

        $this->resultSumDivisionAr = $this->additionTwoSequences($arNumbersA, $arNumbersB, true);

        if(!empty($additionalNumbersAr)){
            $this->resultSumDivisionAr = array_merge($this->resultSumDivisionAr,$additionalNumbersAr);
        }

        if(!empty($this->resultSumDivisionAr)){
            array_unshift($this->resultSumDivisionAr, '.');
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function initSumIntegerPartArray()
    {
        $this->resultSumIntegerAr = $this->additionTwoSequences($this->numberModelA->getIntegerPartAsArray(), $this->numberModelB->getIntegerPartAsArray());
        return $this;
    }


    /**
     * @param array $sequence1
     * @param array $sequence2
     * @param bool $isDivisional
     * @return array
     */
    private function additionTwoSequences($sequence1, $sequence2, $isDivisional = false){
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

        if(!$isDivisional && $this->additionalDivisionalNumber > 0){
            $resultReversAr[0] += $this->additionalDivisionalNumber;
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
                    if($isDivisional){
                        $this->additionalDivisionalNumber = $diff;
                    }else{
                        array_push($resultReversAr,$diff);
                    }
                }
            }
        }

        $resultSequence = array_reverse($resultReversAr);

        return $resultSequence;
    }
}

/**
 * @param $a
 * @param $b
 * @return string
 */
function usingBcadd ($a, $b) {
    $sum = bcadd(trim($a), trim($b), 6);
    return $sum;
}

$examples = [
    [
        "5434343433434343343434334343433434343343434334343433434343343434334343433434343343434334343433434343434",
        "54654645645645645564564556456455645645564564556456455645645564564556456455645645564"
    ],
    [
        "54654645645645645564564556456455645645564564556456455645645564564556456455645645564",
        "5434343433434343343434334343433434343343434334343433434343343434334343433434343343434334343433434343434"
    ],
    [
        "54343434334343433434343343434334343433434343343434334343433434343343434334343.43343434334343433434343434",
        "54654645645645645564564556456455645645564564556456455645645564564556456455645645564"
    ],
    [
        "5434343433434343343434334343433434343343434334343433434343343434334343433434343343434334343433434343434",
        "54654645645645645564564556456455645645564564556456455645645.564564556456455645645564"
    ],
    [
        "5434343433434343343434334343433434343343434334343433434343343434334343.433434343343434334343433434343434",
        "546546456456456455645645564564556.45645564564556456455645645564564556456455645645564"
    ],
];

foreach ($examples as $index => $example) {
    $a = $example[0];
    $b = $example[1];
    $sum = usingBcadd($a, $b);
    echo "withBcadd - ".$sum."\n";
    $numberModel1 = new NumberModel($a);
    $numberModel2 = new NumberModel($b);
    $numberManager = new NumberManager($numberModel1,$numberModel2);
    echo "myNuClass - ".$numberManager->getSumAsString()."\n\n";
}

/*
 * Result using

    withBcadd - 5434343433434343343488988989079079988907998890799889079988907998890799889079988907998890799889079988998.000000
    myNuClass - 5434343433434343343488988989079079988907998890799889079988907998890799889079988907998890799889079988998

    withBcadd - 5434343433434343343488988989079079988907998890799889079988907998890799889079988907998890799889079988998.000000
    myNuClass - 5434343433434343343488988989079079988907998890799889079988907998890799889079988907998890799889079988998

    withBcadd - 54654699989079979907997990799799079979907997990799799079979907997990799799079979907.433434
    myNuClass - 54654699989079979907997990799799079979907997990799799079979907997990799799079979907.43343434334343433434343434

    withBcadd - 5434343433434343343434334343433434343343434388998079079988988998898899889889988988998898899889889989079.564564
    myNuClass - 5434343433434343343434334343433434343343434388998079079988988998898899889889988988998898899889889989079.564564556456455645645564

    withBcadd - 5434343433434343343434334343433434343889980790799889889988988998898899.889889
    myNuClass - 5434343433434343343434334343433434343889980790799889889988988998898899.88988998898899889889988988998907956456455645645564

 */
