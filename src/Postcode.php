<?php

namespace Hpolthof\PostcodeTech;

class Postcode
{
    protected string $postcode;
    protected int $number;
    protected string $street;
    protected string $city;

    public static function search($postcode, $number, $token): self
    {
        $request = new PostcodeRequest();
        $request->setToken($token);
        $response = $request->find($postcode, $number);

        $result = new self();
        $result->postcode = $postcode;
        $result->number = $number;
        $result->street = $response->getStreet();
        $result->city = $response->getCity();

        return $result;
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