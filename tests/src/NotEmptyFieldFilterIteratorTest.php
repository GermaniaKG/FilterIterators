<?php
namespace tests;

use Germania\FilterIterators\NotEmptyFieldFilterIterator;

class NotEmptyFieldFilterIteratorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider provideIterators
     */
    public function testFilter( $data, $keyword, $expected_num) {

        $sut = new NotEmptyFieldFilterIterator( $data, $keyword );
        $results = array();
        foreach($sut as $active_item) {
            $results[] = $active_item;
        }
        $this->assertEquals( $expected_num, count($results));

    }

    public function provideIterators()
    {
        $keyword = "active";

        $basic_array = [
            [ $keyword => true ],
            [ $keyword => 1 ],
            [ $keyword => "1" ],
            [ $keyword => "true" ],
            [ $keyword => "" ],
            [ $keyword => null ],  // not available after stdclass cast
            [ $keyword => false ], // should be filtered out
            [ $keyword => 0 ],     // should be filtered out
            [ 'unknown' => false ],
            // Not array or StdClass
            100,
            "ahoy"
        ];

        // Convert, since the SUT should accept both
        $basic_objects = [];
        foreach( $basic_array as $a) {
            array_push($basic_objects, is_array($a) ? (object) $a : $a);
        }

        return array(
            [ new \ArrayObject( $basic_array )   , $keyword, 4 ],
            [ new \ArrayObject( $basic_objects ) , $keyword, 4 ]
        );
    }
}

