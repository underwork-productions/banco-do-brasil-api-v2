<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Api\Pix;

use UnderWork\BancoDoBrasilApiV2\Api\BBApi;
use UnderWork\BancoDoBrasilApiV2\Builders\BBRequestBuilder;
use UnderWork\BancoDoBrasilApiV2\Concerns\Pix;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\Pix\CobrancaImediata;

class BBApiPix extends BBApi
{
    use Pix\HasPixBaseUrl;

    public function charge(string $txId, CobrancaImediata $payload)
    {
        return $this->httpClient->send(
            BBRequestBuilder::baseUrl($this->getBaseUrl())
                ->method('PUT')
                ->uri("/cob/{$txId}")
                ->body($payload->jsonSerialize())
                ->build()
        );
    }

    public function cancel(string $txId)
    {
        return $this->httpClient->send(
            BBRequestBuilder::baseUrl($this->getBaseUrl())
                ->method('PATCH')
                ->uri("/cob/{$txId}")
                ->build()
        );
    }
}
