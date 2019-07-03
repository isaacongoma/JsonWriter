# Write PHP array to json File

[![Latest Stable Version](https://poser.pugx.org/manojkiran/jsonwriter/v/stable?format=flat-square)](https://packagist.org/packages/manojkiran/jsonwriter)
[![Total Downloads](https://poser.pugx.org/manojkiran/jsonwriter/downloads?format=flat-square)](https://packagist.org/packages/manojkiran/jsonwriter)
[![Latest Unstable Version](https://poser.pugx.org/manojkiran/jsonwriter/v/unstable?format=flat-square)](https://packagist.org/packages/manojkiran/jsonwriter)
[![License](https://poser.pugx.org/manojkiran/jsonwriter/license?format=flat-square)](https://packagist.org/packages/manojkiran/jsonwriter)
[![Monthly Downloads](https://poser.pugx.org/manojkiran/jsonwriter/d/monthly?format=flat-square)](https://packagist.org/packages/manojkiran/jsonwriter)
[![Daily Downloads](https://poser.pugx.org/manojkiran/jsonwriter/d/daily?format=flat-square)](https://packagist.org/packages/manojkiran/jsonwriter)
[![Laravel5.8](https://img.shields.io/badge/Laravel-Framework-red.svg?style=flat-square)](https://www.laravel.com/)

Read and write PHP array| Laravel Collection | EloquentCollection to json file

## Installation

You can install the package via composer:

```bash
composer require manojkiran/jsonwriter
```

## Usage

# Writing

## Writing the Content to Json

``` php

    //get the List of Active users
    $usersList      = User::where('status','=','Active')->get();
    //getting the path where the file is available
    $jsonFilePath   = storage_path('jsonWriter.json');
    //loading the Json File and Writing the Content to it
    $writeToJson    = JsonWriter::load( $jsonFilePath)
                        ->write($usersList);                

```

## Writing the Content to Json(Force)

``` php
//by default the duplicate Content Will Not to Writtent To Json File(To Reduce the data Size)

    //array of the Projects by Taylor Otwell
    $laravel = ['name' => 'Taylor Otwell','developed' => ['Laravel','Lumen','Telescope','Nova']];
    //getting the path where the file is available
    $jsonFilePath   = storage_path('jsonWriter.json');
    //loading the Json File and Writing the Content to it
    $writeToJson    = JsonWriter::load( $jsonFilePath)
                        ->write($laravel,true);             

```

# Reading
``` php

    //get the List of Active users
    $usersList      = User::where('status','=','Active')->get();
    //getting the path where the file is available
    $jsonFilePath   = storage_path('jsonWriter.json');
    //loading the Json File and Writing the Content to it
    $writeToJson    = JsonWriter::load( $jsonFilePath)
                        ->write($usersList);                

```


### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email manojkiran10031998@gmail.com instead of using the issue tracker.

## Credits

- [Manojkiran](https://github.com/manojkiran)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).