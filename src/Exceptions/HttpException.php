<?php

namespace Hpolthof\PostcodeTech\Exceptions;

use Hpolthof\PostcodeTech\Response;

class HttpException extends \Exception
{
    protected $response;

    public function response(): Response
    {
        return $this->response;
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }

    public function status(): int
    {
        return $this->response()->status();
    }
}