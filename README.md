# Germania KG · FilterIterators

**FilterIterators for two-dimensional Traversables.**



## Installation

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

## Issues

See [issues list.][i0]

[i0]: https://github.com/GermaniaKG/FilterIterators/issues 


## Development

```bash
$ git clone git@github.com:GermaniaKG/FilterIterators.git germania-filteriterators
$ cd germania-filteriterators
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. 
Run [PhpUnit](https://phpunit.de/) like this:

```bash
$ vendor/bin/phpunit
```
