<?php

namespace Hpolthof\PostcodeTech;

interface PostcodeResponseInterface
{
    public function getPostcode(): string;

    public function setPostcode(string $postcode);

    public function getNumber(): int;

    public function setNumber(int $number);

    public function getStreet(): string;

    public function setStreet(string $street);

    public function getCity(): string;

    public function setCity(string $city);
}