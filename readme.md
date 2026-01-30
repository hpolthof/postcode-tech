# Dutch Postcode Lookup
![PHPUnit Tests](https://github.com/hpolthof/postcode-tech/actions/workflows/quality_assurance.yaml/badge.svg)
![Latest Stable Version](https://img.shields.io/badge/PHP%20version-8.1%20~%208.5-34D058)

This is a wrapper around the [postcode.tech Postcode API](https://postcode.tech).

## Installation
To install use composer
```bash
composer require hpolthof/postcode-tech
```

## Requirements
You need an API key for this API to work. You can register for free and create an API Key.

## Usage
Please see the example below for usage:
```php
use Hpolthof\PostcodeTech\Exceptions\HttpException;
use Hpolthof\PostcodeTech\Exceptions\PostcodeNotFoundException;
use Hpolthof\PostcodeTech\Exceptions\ValidationException;
use Hpolthof\PostcodeTech\Postcode;

$apiKey = '';

try {
    $postcode = Postcode::search('1071BM', 29, $apiKey);
    echo $postcode->street(); // result: "Pieter Cornelisz. Hooftstraat"
    echo $postcode->city(); // result: "Amsterdam"
} catch (PostcodeNotFoundException $exception) {
    echo "Postcode was not found.";
} catch (ValidationException $exception) {
    echo "No valid lookup query was provided.";
} catch (HttpException $exception) {
    echo "Something else went wrong on the server side.";
} catch (Exception $exception) {
    echo "Something went wrong in this application. Crap!";
}
```

## Disclaimer
This package can be used free of charge. Obviously this software comes as is, and there 
are no warranties or whatsoever.
