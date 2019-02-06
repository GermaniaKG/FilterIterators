# Germania KG · FilterIterators

**FilterIterators for two-dimensional Traversables.**

[![Packagist](https://img.shields.io/packagist/v/germania-kg/filteriterators.svg?style=flat)](https://packagist.org/packages/germania-kg/filteriterators)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/filteriterators.svg)](https://packagist.org/packages/germania-kg/filteriterators)
[![Build Status](https://img.shields.io/travis/GermaniaKG/FilterIterators.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/FilterIterators)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/FilterIterators/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/FilterIterators/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/FilterIterators/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/FilterIterators/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/FilterIterators/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/FilterIterators/build-status/master)


## Installation with Composer

```bash
$ composer require germania-kg/filteriterators
```

Alternatively, add this package directly to your *composer.json:*

```json
"require": {
    "germania-kg/filteriterators": "^1.0"
}
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

