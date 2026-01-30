<?php

namespace Hpolthof\PostcodeTech;

use Hpolthof\PostcodeTech\Exceptions\HttpException;
use Hpolthof\PostcodeTech\Exceptions\PostcodeNotFoundException;
use Hpolthof\PostcodeTech\Exceptions\ValidationException;

class Postcode implements PostcodeInterface
{
    protected function __construct(
        protected string $postcode,
        protected int $number,
        protected string $street,
        protected string $city,
    ) {
    }

    /**
     * @throws HttpException
     * @throws ValidationException
     * @throws PostcodeNotFoundException
     */
    public static function search(string $postcode, int $number, string $token): self
    {
        $client = new Client($token);

        $response = $client->get($postcode, $number);

        return new self(
            $postcode,
            $number,
            $response['street'],
            $response['city'],
        );
    }

    public function postcode(): string
    {
        return $this->postcode;
    }

    public function number(): int
    {
        return $this->number;
    }

    public function street(): string
    {
        return $this->street;
    }

    public function city(): string
    {
        return $this->city;
    }
}
