# Manipulate composer.json with Beautiful Object API

[![Downloads total](https://img.shields.io/packagist/dt/symplify/composer-json-manipulator.svg?style=flat-square)](https://packagist.org/packages/symplify/composer-json-manipulator/stats)

- load to `composer.json` to an object
- use handful methods
- merge it with others
- print it back to `composer.json` in human-like format

## Install

```bash
composer require symplify/composer-json-manipulator
```

Add to `config/bundles.php`:

```php
return [
    Symplify\ComposerJsonManipulator\ComposerJsonManipulatorBundle::class => ['all' => true],
];
```

## Usage

```php
<?php

declare(strict_types=1);

namespace App;

use Symplify\ComposerJsonManipulator\FileSystem\JsonFileManager;

class SomeClass
{
    /**
     * @var JsonFileManager
     */
    private $jsonFileManager;

    public function __construct(JsonFileManager $jsonFileManager)
    {
        $this->jsonFileManager = $jsonFileManager;
    }

    public function run()
    {
        // ↓ instance of \Symplify\ComposerJsonManipulator\ValueObject\ComposerJson
        $composerJson = $this->jsonFileManager->loadFromFilePath(getcwd() . '/composer.json');
        // ...
    }
}
```

## Contributing

Open an [issue](https://github.com/symplify/symplify/issues) or send a [pull-request](https://github.com/symplify/symplify/pulls) to main repository.
