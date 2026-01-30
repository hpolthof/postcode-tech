<?php

namespace Hpolthof\PostcodeTech\Exceptions;

class HttpException extends \Exception
{
    public function __construct(string $message = "", string $responseBody = "", ?\Throwable $previous = null)
    {
        parent::__construct(sprintf('%s: %s', $message, $responseBody), previous: $previous);
    }
}
