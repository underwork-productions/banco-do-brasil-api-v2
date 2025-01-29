<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Builders;

use UnderWork\BancoDoBrasilApiV2\Abstracts\Builder;
use UnderWork\BancoDoBrasilApiV2\Net\ValueObjects\BBRequest;

/**
 * @since 0.0.1
 *
 * @method static BBRequestBuilder baseUrl(string $baseUrl)
 * @method static BBRequestBuilder body(array $body)
 * @method static BBRequestBuilder method(string $method)
 * @method static BBRequestBuilder options(array $options)
 * @method static BBRequestBuilder uri(string $uri)
 * @method BBRequestBuilder baseUrl(string $baseUrl)
 * @method BBRequestBuilder body(array $body)
 * @method BBRequestBuilder method(string $method)
 * @method BBRequestBuilder options(array $options)
 * @method BBRequestBuilder uri(string $uri)
 * @method BBRequest build()
 */
class BBRequestBuilder extends Builder
{
    protected string $baseUrl = '';

    protected string $uri = '';

    protected string $method = 'GET';

    protected array $body = [];

    protected array $options = [];

    public function build(): BBRequest
    {
        return new BBRequest(
            method: $this->method,
            baseUrl: $this->baseUrl,
            uri: $this->uri,
            body: $this->body,
            options: $this->options,
        );
    }
}
