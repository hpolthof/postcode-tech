<?php

declare(strict_types=1);

namespace Hpolthof\PostcodeTech;

interface PostcodeInterface
{
    public static function search(string $postcode, int $number, string $token): self;

    public function postcode(): string;

    public function number(): int;

    public function street(): string;

    public function city(): string;
}
