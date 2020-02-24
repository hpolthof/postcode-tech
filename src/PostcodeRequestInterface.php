<?php

namespace Hpolthof\PostcodeTech;

interface PostcodeRequestInterface
{
    public function find(string $postcode, int $number): PostcodeResponseInterface;

    public function getToken(): string;

    public function setToken(string $token): PostcodeRequest;
}