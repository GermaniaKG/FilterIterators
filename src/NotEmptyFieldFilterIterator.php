<?php
namespace Germania\FilterIterators;

/**
 * Let all items pass that have a given field whose value is not empty.
 */
class NotEmptyFieldFilterIterator extends \FilterIterator
{

    /**
     * @var string
     */
    public $field_name;


    /**
     * @param \Traversable<array<mixed>|object> $iterator Traversable with arrays or objects
     * @param string       $field_name
     */
    public function __construct(\Traversable $iterator, $field_name)
    {
        parent::__construct(new \IteratorIterator($iterator));
        $this->field_name = $field_name;
    }


    public function accept() : bool
    {
        $liste = $this->getInnerIterator()->current();
        $field_name = $this->field_name;

        if (is_object($liste)) {
            return isset($liste->{$field_name}) and !empty($liste->{$field_name});
        }
        elseif (is_array($liste)) {
            return array_key_exists($field_name, $liste) and !empty($liste[ $field_name ]);
        }

        return false;
    }
}
