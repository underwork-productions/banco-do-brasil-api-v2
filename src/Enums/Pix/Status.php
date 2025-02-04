<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Enums\Pix;

/**
 * @since 0.0.2
 */
enum Status: string
{
    /** indica que a cobrança ainda não foi paga nem removida */
    case Ativa = 'ATIVA ';

    /** indica que a cobrança já foi paga e, por conseguinte, não pode acolher outro pagamento */
    case Concluida = 'CONCLUIDA ';

    /** indica que o usuário recebedor solicitou a remoção (cancelamento) do registro da cobrança */
    case RemovidaPeloUsuarioRecebedor = 'REMOVIDA_PELO_USUARIO_RECEBEDOR ';

    /** indica que o PSP recebedor solicitou a remoção do registro da cobrança */
    case RemovidaPeloPsp = 'REMOVIDA_PELO_PSP ';
}
