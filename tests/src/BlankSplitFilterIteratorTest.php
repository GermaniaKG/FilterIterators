<?php
namespace tests;

use Germania\FilterIterators\BlankSplitFilterIterator;

class BlankSplitFilterIteratorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider provideIterators
     */
    public function testFilter( $items, $field, $word, $expected_num) {

        $items = new \ArrayIterator($items);

        $sut = new BlankSplitFilterIterator( $items, $field, $word );
        $results = iterator_count($sut);

        $this->assertEquals( $expected_num, $results);
    }


    public function provideIterators()
    {
        $items = array(
            [ 'foo' => 'bar john doe'],
            [ 'foo' => 'john bar doe'],
            [ 'foo' => 'john doe bar'],
            [ 'foo' => ['john', 'doe', 'bar']],
        );
        $items_objects = array_map(function ($a) { return (object) $a; }, $items);

        $no_items = array(
            [ 'foo' => 'john doe'],
            [ 'foo' => 'john,doe'],
            [ 'foo' => 'john bar-foo doe'],
            22,
        );
        $no_items_objects = array_map(function ($a) { return (object) $a; }, $no_items);

        return array(
            'filter arrays for "bar" in "foo" key' => [ $items, "foo", "bar", 4],
            'filter objects for "bar" in "foo" property' => [ $items_objects, "foo", "bar", 4],

            'no matching items in array' => [ $no_items,         "foo", "bar", 0],
            'no matching items in objects' => [ $no_items_objects, "foo", "bar", 0],
            'no matching items in enpty array' => [ array(),           "foo", "bar", 0]
        );
    }
}

