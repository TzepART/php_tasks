<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 02/08/2018
 * Time: 14:59
 */

$doublyLinkedList = new SplDoublyLinkedList();

$doublyLinkedList->push( 'firstElement');
$doublyLinkedList->push( 'secondElement');
$doublyLinkedList->push( 'thirdElement');
$doublyLinkedList->push( 'fourthElement');
$doublyLinkedList->push( 'fifthElement');


for ($doublyLinkedList->rewind();$doublyLinkedList->valid();$doublyLinkedList->next()){
    var_dump($doublyLinkedList->key(),$doublyLinkedList->current());
}

//revert list
$doublyLinkedList->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);

$doublyLinkedList->rewind();
while($doublyLinkedList->valid()){
    echo $doublyLinkedList->current()."\n";
    $doublyLinkedList->next();
}
