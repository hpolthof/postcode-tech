<?php


namespace Hpolthof\PostcodeTech;


class PostcodeResponse implements PostcodeResponseInterface
{
    private string $postcode;
    private int $number;
    private string $street;
    private string $city;

    public function getPostcode(): string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number)
    {
        $this->number = $number;
        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street)
    {
        $this->street = $street;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
        return $this;
    }


}