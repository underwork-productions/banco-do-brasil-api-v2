<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Net\ValueObjects;

/**
 * @since 0.0.1
 *
 * @property string url
 * @property string method
 * @property array options
 */
final class BBRequest
{
    public function __construct(
        private string $method,
        private string $baseUrl,
        private string $uri = '',
        private array $body = [],
        private array $options = [],
    ) {}

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        if (method_exists($this, "__$name")) {
            return $this->{"__$name"}();
        }
    }

    private function __url(): string
    {
        return $this->baseUrl.$this->uri;
    }
}
