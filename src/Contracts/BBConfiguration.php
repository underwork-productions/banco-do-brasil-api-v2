<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Contracts;

/**
 * @since 0.0.1
 *
 * @property-read string $developerApplicationKey
 * @property-read string $clientId
 * @property-read string $clientSecret
 * @property-read Environment $environment
 * @property-read int $maxRetries
 * @property-read ?string $cert
 * @property-read ?string $sslKey
 * @property-read ?string $verify
 */
interface BBConfiguration {}
