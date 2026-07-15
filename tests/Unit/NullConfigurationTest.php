<?php

declare(strict_types=1);

use UnderWork\BancoDoBrasilApiV2\Defaults;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\NullObjects\NullConfiguration;

it('honours the BBConfiguration contract with empty defaults', function (): void {
    $configuration = new NullConfiguration;

    expect($configuration->developerApplicationKey)->toBe('')
        ->and($configuration->clientId)->toBe('')
        ->and($configuration->clientSecret)->toBe('')
        ->and($configuration->environment)->toBe(Defaults::DEFAULT_ENVIRONMENT)
        ->and($configuration->maxRetries)->toBe(Defaults::DEFAULT_MAX_RETRIES)
        ->and($configuration->cert)->toBeNull()
        ->and($configuration->verify)->toBeNull()
        ->and($configuration->sslKey)->toBeNull()
        ->and($configuration->scope)->toBeNull();
});

it('throws when reading an unknown property', function (): void {
    $configuration = new NullConfiguration;

    $configuration->unknown;
})->throws(InvalidArgumentException::class, 'Unknown property: unknown');
