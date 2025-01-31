<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Api;

use UnderWork\BancoDoBrasilApiV2\Contracts\BBConfiguration;
use UnderWork\BancoDoBrasilApiV2\Net\BBHttpClient;
use UnderWork\BancoDoBrasilApiV2\Net\Contracts\BBHttpClient as BBHttpClientInterface;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\NullObjects\NullConfiguration;

abstract class BBApi
{
    abstract protected function getBaseUrl(): string;

    abstract protected function getProductionUrl(): string;

    abstract protected function getSandboxUrl(): string;

    /** This returns the api url that doesn't requires mTLS */
    abstract protected function getUnsecureSandboxUrl(): string;

    protected BBHttpClientInterface $httpClient;

    protected BBConfiguration $configuration;

    public function __construct(?BBConfiguration $configuration = null)
    {
        $this->httpClient = new BBHttpClient($configuration ?? new NullConfiguration);
    }
}
