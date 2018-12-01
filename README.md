# Custom PHPStan Rules for Consistence library

[![Build Status](https://travis-ci.org/mhujer/phpstan-consistence.svg)](https://travis-ci.org/mhujer/phpstan-consistence)
[![Coverage Status](https://coveralls.io/repos/github/mhujer/phpstan-consistence/badge.svg)](https://coveralls.io/github/mhujer/phpstan-consistence)
[![Latest Stable Version](https://poser.pugx.org/mhujer/phpstan-consistence/v/stable)](https://packagist.org/packages/mhujer/phpstan-consistence)
[![License](https://poser.pugx.org/mhujer/phpstan-consistence/license)](https://packagist.org/packages/mhujer/phpstan-consistence)

This repository provides following custom [PHPStan](https://github.com/phpstan/phpstan) rules for [Consistence library](https://github.com/consistence/consistence/)

* Check that no class extends `\Consistence\ObjectPrototype` or uses `\Consistence\Type\ObjectMixinTrait` somewhere in its hierarchy tree. The type of errors it prevents is caught by PHPStan so there is no need to extend/use anymore.
* Check that Consistence function wrappers (from `ArrayType`) are used for array manipulation


## Usage

To use those rules, require them in [Composer](https://getcomposer.org/):

```bash
composer require --dev mhujer/phpstan-consistence
```

And include them in your project's PHPStan config:

```yaml
includes:
    - vendor/mhujer/phpstan-consistence/rules.neon
```
