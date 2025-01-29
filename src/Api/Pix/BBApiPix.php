<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Api\Pix;

use UnderWork\BancoDoBrasilApiV2\Api\BBApi;
use UnderWork\BancoDoBrasilApiV2\Builders\BBRequestBuilder;
use UnderWork\BancoDoBrasilApiV2\Concerns\Pix;

class BBApiPix extends BBApi
{
    use Pix\HasPixBaseUrl;

    public function charge(string $txId)
    {
        $this->httpClient->send(
            BBRequestBuilder::baseUrl($this->getBaseUrl())
                ->method('PUT')
                ->uri("/cob/{$txId}")
                ->body([])
                ->build()
        );
    }
}
