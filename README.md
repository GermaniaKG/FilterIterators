<img src="https://static.germania-kg.com/logos/ga-logo-2016-web.svgz" width="250px">

------


# Germania KG · FilterIterators

**FilterIterators for two-dimensional Traversables.**

[![Packagist](https://img.shields.io/packagist/v/germania-kg/filteriterators.svg?style=flat)](https://packagist.org/packages/germania-kg/filteriterators)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/filteriterators.svg)](https://packagist.org/packages/germania-kg/filteriterators)
[![Tests](https://github.com/GermaniaKG/FilterIterators/actions/workflows/php.yml/badge.svg)](https://github.com/GermaniaKG/FilterIterators/actions/workflows/php.yml)

## Installation with Composer

```bash
$ composer require germania-kg/filteriterators
```

Alternatively, add this package directly to your *composer.json:*

```json
"require": {
    "germania-kg/filteriterators": "^2.0"
}
```



## BlankSplitFilterIterator

Lets all items pass of which the given field, splitted by *blank* sign into an array, contains a word.
The Constructor accepts anything that is Traversable.   
The Traversable may contain both arrays or (StdClass) objects.

```php
<?php
use Germania\FilterIterators\BlankSplitFilterIterator;
 
$items = array(
  [ 'foo' => 'bar john doe'],
  [ 'foo' => 'john bar doe'],
  [ 'foo' => 'john doe bar'],
  [ 'foo' => ['john', 'doe', 'bar']],
);  

// Convert above arrays to StdClasses
$objects = array_map(function ($a) { return (object) $a; }, $items);

$filter = new BlankSplitFilterIterator( $items, "foo", "bar" );
echo iterator_count( $filter ); // 4

$filter = new BlankSplitFilterIterator( $objects, "foo", "bar" );
echo iterator_count( $filter ); // 4
```





## WordRegexFilterIterator

Lets all items pass of which the given field matches a word.
The Constructor accepts anything that is Traversable.   
The Traversable may contain both arrays or (StdClass) objects.

```php
<?php
use Germania\FilterIterators\WordRegexFilterIterator;

$items = array(
  [ 'foo' => 'bar john doe'],
  [ 'foo' => 'john bar doe'],
  [ 'foo' => 'john doe bar'],
  [ 'foo' => 'bar,john,doe'],
  [ 'foo' => 'john,bar,doe'],
  [ 'foo' => 'john,doe,bar'],
  [ 'foo' => 'john,doe,white-bar'],
  [ 'foo' => 'john,doe,bar-black']
);

// Convert above arrays to StdClasses
$objects = array_map(function ($a) { return (object) $a; }, $items);

$filter = new WordRegexFilterIterator( $items, "foo", "bar" );
echo iterator_count( $filter ); // 8

$filter = new WordRegexFilterIterator( $objects, "foo", "bar" );
echo iterator_count( $filter ); // 8
```



## KeyNotFalseFilterIterator

Lets all items pass that are not explicitely excluded with `active=false` or `active=0`.   
The Constructor accepts anything that is Traversable.   
The Traversable may contain both arrays or (StdClass) objects.

```php
<?php
use Germania\FilterIterators\KeyNotFalseFilterIterator;

// Items may be Arrays or StdClass objects
$data = [
  // These are not "inactive"
  [ 'name' => 'John', 'active' => true ],
  [ 'name' => 'George' ],

  // but these are:
  [ 'name' => 'Paul',  'active' => false ],
  [ 'name' => 'Ringo', 'active' => 0 ],
];

$filter = new KeyNotFalseFilterIterator( $data, "active" );
foreach( $filter as $item ):
	// John
	// George
	echo $item['name'];
endforeach;
```

## NotEmptyFieldFilterIterator

Lets all items pass that have a field whose value is not empty.  
The Constructor accepts anything that is Traversable.  
The Traversable may contain both arrays or (StdClass) objects.  

```php
<?php
use Germania\FilterIterators\NotEmptyFieldFilterIterator;

// Items may be Arrays or StdClass objects
$data = [
  // These are not "inactive"
  [ 'name' => 'John', 'active' => true ],
  [ 'name' => 'George' ],

  // but these are:
  [ 'name' => 'Paul',  'active' => false ],
  [ 'name' => 'Ringo', 'active' => 0 ],
];

$filter = new NotEmptyFieldFilterIterator( $data, "active" );
foreach( $filter as $item ):
	// John
	echo $item['name'];
endforeach;
```

## Issues

See [issues list.][i0]

[i0]: https://github.com/GermaniaKG/FilterIterators/issues


## Development

```bash
$ git clone https://github.com/GermaniaKG/FilterIterators.git
$ cd FilterIterators
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```

