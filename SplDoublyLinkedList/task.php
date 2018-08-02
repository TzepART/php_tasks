<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 02/08/2018
 * Time: 14:59
 */

class DoublyLinkedListDecorator{
    /**
     * @var SplDoublyLinkedList
     */
    private $doublyLinkedList;

    /**
     * DoublyLinkedListDecorator constructor.
     * @param SplDoublyLinkedList $doublyLinkedList
     */
    public function __construct(SplDoublyLinkedList $doublyLinkedList)
    {
        $this->doublyLinkedList = $doublyLinkedList;
    }

    /**
     * @return $this
     */
    public function initDoublyLinkedList()
    {
        $this->doublyLinkedList->push( 'firstElement');
        $this->doublyLinkedList->push( 'secondElement');
        $this->doublyLinkedList->push( 'thirdElement');
        $this->doublyLinkedList->push( 'fourthElement');
        $this->doublyLinkedList->push( 'fifthElement');

        return $this;
    }

    /**
     * @return $this
     */
    public function viewListElements()
    {
        echo "\nView List Elements \n";
        for ($this->doublyLinkedList->rewind();$this->doublyLinkedList->valid();$this->doublyLinkedList->next()){
            $this->viewElement();
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function viewListElementsInReversOrder()
    {
        echo "\nView List Elements In Revers Order \n";
        $this->doublyLinkedList->setIteratorMode(SplDoublyLinkedList::IT_MODE_LIFO);

        $this->doublyLinkedList->rewind();
        while($this->doublyLinkedList->valid()){
            $this->viewElement();
            $this->doublyLinkedList->next();
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function viewElement()
    {
        echo 'Key - '.$this->doublyLinkedList->key().'; Value - '.$this->doublyLinkedList->current()."\n";
        return $this;
    }
}

$doublyLinkedListDecorator = (new DoublyLinkedListDecorator(new SplDoublyLinkedList()))->initDoublyLinkedList();

$doublyLinkedListDecorator->viewListElements();
$doublyLinkedListDecorator->viewListElementsInReversOrder();


