#Germania\FilterIterators

**FilterIterators for two-dimensional Traversables.**



##Installation

```bash
$ composer require germania-kg/filteriterators
```

Alternatively, add this package directly to your *composer.json:*

```json
"require": {
    "germania-kg/filteriterators": "^1.0"
}
```
##KeyNotFalseFilterIterator

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

##Development and Testing

Develop using `develop` branch, using [Git Flow](https://github.com/nvie/gitflow). 

```bash
$ git clone <repo> germania-filteriterators
$ cd germania-filteriterators
$ cp phpunit.xml.dist phpunit.xml
$ phpunit
```
