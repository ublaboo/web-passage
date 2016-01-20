[![Latest Stable Version](https://poser.pugx.org/ublaboo/web-passage/v/stable)](https://packagist.org/packages/ublaboo/web-passage)
[![License](https://poser.pugx.org/ublaboo/web-passage/license)](https://packagist.org/packages/ublaboo/web-passage)
[![Total Downloads](https://poser.pugx.org/ublaboo/web-passage/downloads)](https://packagist.org/packages/ublaboo/web-passage)

WebPassage
==========

Saving web passage: small util for Nette Framework

## Config.neon:

```yml
services:
	- Ublaboo\WebPassage\WebPassage
```

## Usage:

```php
/**
 * @var Ublaboo\WebPassage\WebPassage
 * @inject
 */
public $webPassage;


public function startup()
{
	parent::startup();

	$this->webPassage->saveState();
}
```

Now when you need list of your website passage, you can get it by calling `WebPassage::getPassage`:

```php
/**
 * Maximum size of passage array is 40
 */
$webPassage->getPassage($size = 10, $include_host = TRUE);
```
