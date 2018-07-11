<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 11/07/2018
 * Time: 12:19
 */


class MySplStack{
    
    /**
     * @var SplStack
     */
    private $stack;

    /**
     * MySplStack constructor.
     */
    public function __construct()
    {
        $this->stack = new SplStack();
    }

    public function initStack()
    {
        $this->stack[] = 1;
        $this->stack[] = 2;
        $this->stack[] = 3;
        $this->stack->push(4);
        $this->stack->add(4,5);

        return $this;
    }

    public function outputDataFromStack()
    {
        $this->stack->rewind();
        while($this->stack->valid()){
            echo $this->stack->current();
            $this->stack->next();
        }
        echo "\n";

        return $this;
    }
}
