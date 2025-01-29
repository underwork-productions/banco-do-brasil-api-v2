<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Net\Contracts;

use UnderWork\BancoDoBrasilApiV2\Net\ValueObjects\BBRequest;
use UnderWork\BancoDoBrasilApiV2\Net\ValueObjects\BBResponse;

interface BBHttpClient
{
    public function send(BBRequest $request): BBResponse;
}
