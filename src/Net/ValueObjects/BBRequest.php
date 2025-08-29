<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Net\ValueObjects;

/**
 * @since 0.0.1
 *
 * @property string url
 */
final class BBRequest
{
    public function __construct(
        public readonly string $method,
        public readonly string $baseUrl,
        public readonly string $uri = '',
        public readonly array $body = [],
        public readonly array $options = [],
    ) {}

    public function __get($name)
    {
        if (method_exists($this, "__$name")) {
            return $this->{"__$name"}();
        }
    }

    private function __url(): string
    {
        return $this->baseUrl.$this->uri;
    }
}
