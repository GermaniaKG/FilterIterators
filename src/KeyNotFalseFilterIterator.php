<?php
namespace Germania\FilterIterators;

/**
 * Let all items pass that have no given key with value "false" or "0"
 */
class KeyNotFalseFilterIterator extends \FilterIterator
{
    public $active_key = 'active';

    /**
     * @param \Traversable Anything iterable
     * @param string       $active_key The key to compare
     */
    public function __construct(\Traversable $iterator, $active_key)
    {
        $this->active_key = $active_key;
        parent::__construct(new \IteratorIterator($iterator));
    }

    public function accept() : bool
    {
        $current = $this->getInnerIterator()->current();

        if (is_array($current)) {
            return (!array_key_exists($this->active_key, $current)
            or ($current[ $this->active_key ] != false));
        } elseif (is_object($current)) {
            $key = $this->active_key;
            return (!isset($current->$key)
            or ($current->$key != false));
        }

        return true;
    }
}
