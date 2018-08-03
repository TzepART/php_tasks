<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 02/08/2018
 * Time: 14:59
 */

/*
 * SplDoublyLinkedList methods (http://php.net/manual/en/class.spldoublylinkedlist.php):
 *
 * add - Add/insert a new value at the specified index
 * bottom - Peeks at the node from the beginning of the doubly linked list
 * count - Counts the number of elements in the doubly linked list
 * current - Return current array entry
 * getIteratorMode - Returns the mode of iteration (IT_MODE_LIFO,IT_MODE_FIFO,IT_MODE_DELETE,IT_MODE_KEEP)
 * isEmpty - Checks whether the doubly linked list is empty
 * key - Return current node index
 * next - Move to next entry
 * offsetExists($index) - Returns whether the requested $index exists
 * offsetGet($index) - Returns the value at the specified $index
 * offsetSet($index,$newval) - Sets the value at the specified $index to $newval
 * offsetUnset($index) - Unsets the value at the specified $index
 * pop - Pops a node from the end of the doubly linked list (end)
 * prev - Move to previous entry
 * push - Pushes an element at the end of the doubly linked list
 * rewind - Rewind iterator back to the start
 * serialize - Serializes the storage
 * setIteratorMode(int $mode) - Sets the mode of iteration (IT_MODE_LIFO,IT_MODE_FIFO,IT_MODE_DELETE,IT_MODE_KEEP)
 * shift - Shifts a node from the beginning of the doubly linked list
 * top - Peeks at the node from the end of the doubly linked list
 * unserialize - Unserializes the storage
 * unshift - Prepends the doubly linked list with an element
 * valid - Check whether the doubly linked list contains more nodes
 */

/**
 * Class DoublyLinkedListDecorator
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
     * Add new element in position with "key"
     * http://php.net/manual/ru/spldoublylinkedlist.add.php
     * @param int $key
     * @param $value
     */
    public function addNewElement(int $key,$value)
    {
        $this->doublyLinkedList->add($key,$value);
        echo "Add New Element \n";
    }

    /**
     * Get value of first element
     * http://php.net/manual/ru/spldoublylinkedlist.bottom.php
     * @return mixed
     */
    public function getFirstElementValue()
    {
        return $this->doublyLinkedList->bottom();
    }

    /**
     * @return $this
     */
    public function viewListElements()
    {
        echo "View List Elements \n";
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
        echo "View List Elements In Revers Order \n";
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
    public function viewElement()
    {
        echo 'Key - '.$this->doublyLinkedList->key().'; Value - '.$this->doublyLinkedList->current()."\n";
        return $this;
    }

    /**
     * @return SplDoublyLinkedList
     */
    public function getDoublyLinkedList(): SplDoublyLinkedList
    {
        return $this->doublyLinkedList;
    }
}

$doublyLinkedListDecorator = (new DoublyLinkedListDecorator(new SplDoublyLinkedList()))->initDoublyLinkedList();

//$doublyLinkedListDecorator->viewListElements();

//$doublyLinkedListDecorator->viewListElementsInReversOrder();

//$doublyLinkedListDecorator->addNewElement(3,"SeventhElement");
//$doublyLinkedListDecorator->viewListElements();

//$element = $doublyLinkedListDecorator->getFirstElementValue();
//echo 'First element - '.$element."\n";

echo 'Count elements - '.$doublyLinkedListDecorator->getDoublyLinkedList()->count()."\n";
$doublyLinkedListDecorator->addNewElement(3,"NewElement");
echo 'Count elements - '.$doublyLinkedListDecorator->getDoublyLinkedList()->count()."\n";





