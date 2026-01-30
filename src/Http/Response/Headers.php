<?php

declare(strict_types=1);

namespace Hpolthof\PostcodeTech\Http\Response;

final class Headers
{
    /**
     * @param string[] $headers
     */
    public function __construct(
        private readonly array $headers,
    ) {
    }

    public function getStatusCode(): int
    {
        return intval(explode(' ', $this->headers[0])[1]);
    }
}
