<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Enums\Pix;

enum Status: string
{
    /**
     * Indica que a cobrança ainda não foi paga nem removida
     */
    case Ativa = 'ATIVA';

    /**
     * Indica que a cobrança já foi paga e, por conseguinte, não pode acolher outro pagamento
     */
    case Concluida = 'CONCLUIDA';

    /**
     * Indica que o usuário recebedor solicitou a remoção (cancelamento) do registro da cobrança
     */
    case RemovidaPeloUsuarioRecebedor = 'REMOVIDA_PELO_USUARIO_RECEBEDOR';

    /**
     * Indica que o PSP recebedor solicitou a remoção do registro da cobrança
     */
    case RemovidaPeloPsp = 'REMOVIDA_PELO_PSP';
}
