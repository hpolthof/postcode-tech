# Dutch Postcode Lookup
This is a wrapper around the API of [Postcode.Tech](https://postcode.tech). You need an API key for this
API to work. You can register for free and create an API Key.

## Installation
To install use composer
```bash
composer require hpolthof/postcode-tech
```

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

If you like the package it is always appreciated if you drop a message of gratitude! ;-)

The package was build by: [Paul Olthof](mailto:hi@olthof.tech)