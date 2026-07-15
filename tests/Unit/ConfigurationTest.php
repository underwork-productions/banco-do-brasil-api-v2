<?php

declare(strict_types=1);

use UnderWork\BancoDoBrasilApiV2\Defaults;
use UnderWork\BancoDoBrasilApiV2\Enums\Environment;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\Configuration;

it('exposes the required credentials', function (): void {
    $configuration = new Configuration(
        developerApplicationKey: 'app-key',
        clientId: 'client-id',
        clientSecret: 'client-secret',
    );

    expect($configuration->developerApplicationKey)->toBe('app-key')
        ->and($configuration->clientId)->toBe('client-id')
        ->and($configuration->clientSecret)->toBe('client-secret');
});

it('applies sane defaults', function (): void {
    $configuration = new Configuration(
        developerApplicationKey: 'app-key',
        clientId: 'client-id',
        clientSecret: 'client-secret',
    );

    expect($configuration->environment)->toBe(Defaults::DEFAULT_ENVIRONMENT)
        ->and($configuration->maxRetries)->toBe(Defaults::DEFAULT_MAX_RETRIES)
        ->and($configuration->cert)->toBeNull()
        ->and($configuration->verify)->toBeNull()
        ->and($configuration->sslKey)->toBeNull()
        ->and($configuration->scope)->toBeNull();
});

it('keeps the OAuth scope when provided', function (): void {
    $configuration = new Configuration(
        developerApplicationKey: 'app-key',
        clientId: 'client-id',
        clientSecret: 'client-secret',
        scope: 'cob.read cob.write pix.read pix.write',
    );

    expect($configuration->scope)->toBe('cob.read cob.write pix.read pix.write');
});

it('accepts a production environment', function (): void {
    $configuration = new Configuration(
        developerApplicationKey: 'app-key',
        clientId: 'client-id',
        clientSecret: 'client-secret',
        environment: Environment::PRODUCTION,
    );

    expect($configuration->environment)->toBe(Environment::PRODUCTION);
});

it('rejects a negative retry count', function (): void {
    new Configuration(
        developerApplicationKey: 'app-key',
        clientId: 'client-id',
        clientSecret: 'client-secret',
        maxRetries: -1,
    );
})->throws(InvalidArgumentException::class, 'Max retries must be greater than or equal to 0.');
