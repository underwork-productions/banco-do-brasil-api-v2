<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Api\Pix;

use UnderWork\BancoDoBrasilApiV2\Api\BBApi;
use UnderWork\BancoDoBrasilApiV2\Builders\BBRequestBuilder;
use UnderWork\BancoDoBrasilApiV2\Concerns\Pix;
use UnderWork\BancoDoBrasilApiV2\Enums\Pix\Status;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\Pix\CobrancaImediata;

class BBApiPix extends BBApi
{
    use Pix\HasPixBaseUrl;

    /**
     * @return mixed
     *
     * @since 0.0.1
     */
    public function criarCobrancaImediata(string $txId, CobrancaImediata $payload)
    {
        return $this->httpClient->send(
            BBRequestBuilder::baseUrl($this->getBaseUrl())
                ->method('PUT')
                ->uri("/cob/{$txId}")
                ->body($payload->jsonSerialize())
                ->build()
        );
    }

    /**
     * Todas as alterações só podem ser feitas enquanto o status da cobrança for ‘ATIVA’
     * Toda alteração de cobrança (com exceção do cancelamento e do campo ‘loc’) provoca o incremento do campo ‘revisao’ em 1.
     *
     * @return mixed
     *
     * @since 0.0.2
     */
    public function atualizarCobrancaImediata(string $txId, CobrancaImediata $payload)
    {
        return $this->httpClient->send(
            BBRequestBuilder::baseUrl($this->getBaseUrl())
                ->method('PATCH')
                ->uri("/cob/{$txId}")
                ->body($payload->jsonSerialize())
                ->build()
        );
    }

    /**
     * Endpoint para cancelar uma cobrança imediata. Cobrança só será cancelada se o status atual for ATIVA
     *
     * @return mixed
     *
     * @since 0.0.2
     */
    public function cancelarCobrançaImediata(string $txId)
    {
        return $this->httpClient->send(
            BBRequestBuilder::baseUrl($this->getBaseUrl())
                ->method('PATCH')
                ->uri("/cob/{$txId}")
                ->body(['status' => Status::RemovidaPeloUsuarioRecebedor->value])
                ->build()
        );
    }
}
