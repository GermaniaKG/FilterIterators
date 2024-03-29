<?php
namespace Germania\FilterIterators;

class BlankSplitFilterIterator extends \FilterIterator
{


    /**
     * @var string
     */
    public $field;


    /**
     * @var string
     */
    public $word;

    /**
     * @var string
     */
    public $split = " ";



    /**
     * @param \Traversable<string[]|object> $items Traversable with arrays or objects
     */
    public function __construct(\Traversable $items, string $field, string $word, string $split = " ")
    {
        $this->field = $field;
        $this->word = $word;
        $this->split = $split;
        parent::__construct(new \IteratorIterator($items));
    }


    public function accept() : bool
    {
        $current = $this->getInnerIterator()->current();

        if (is_array($current)) {
            if (empty($current[$this->field ])) {
                return false;
            }
        }
        elseif (is_object($current)) {

            if (!isset($current->{$this->field})) {
                return false;
            }
            $current = (array) $current;
        }
        else {
            return false;
        }


        $var = $current[$this->field ];

        if (is_string($var)) {
            $var = explode($this->split, $var);
        }
        
        return in_array($this->word, $var);
    }
}
