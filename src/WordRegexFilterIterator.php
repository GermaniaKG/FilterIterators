<?php
namespace Germania\FilterIterators;

/**
 * Filters a Traversable for arrays which have an element which contains a certain value in a comma-separated list.
 */
class WordRegexFilterIterator extends \FilterIterator
{


    /**
     * @var string
     */
    public $field;


    /**
     * @var mixed
     */
    public $word;


    /**
     * @param \Traversable<array<mixed>|object> $items Traversable with arrays or objects
     */
    public function __construct(\Traversable $items, string $field, string $word)
    {
        $this->field = $field;
        $this->word = $word;
        parent::__construct(new \IteratorIterator($items));
    }


    public function accept() : bool
    {
        $current = $this->getInnerIterator()->current();

        if (is_array($current)) {
            if (empty($current[$this->field ])) {
                return false;
            }
            $var = $current[$this->field ];
        }
        elseif (is_object($current)) {

            if (!isset($current->{$this->field})) {
                return false;
            }
            $var = $current->{$this->field};
        }
        else {
            return false;
        }

        $regex = "/\b" . $this->word . "\b/i";
        return true == preg_match($regex, $var);
    }
}
