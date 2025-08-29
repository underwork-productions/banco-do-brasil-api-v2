<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Enums\BBPay;

use UnderWork\BancoDoBrasilApiV2\Traits\EnhancedEnum;

/**
 * Formas de pagamento aceitas
 *
 * @since 0.0.3
 */
enum TipoFormaPagamento: string
{
    use EnhancedEnum;

    /**
     * Ofereça o QR Code em seu ambiente de pagamento  (Checkout Transparente) ou habilite a opção para pagamento à vista no App BB.
     */
    case Pix = 'PIX';

    /**
     * Ofereça o boleto em seu ambiente de pagamento  (Checkout Transparente).
     */
    case Boleto = 'BLT';

    /**
     * Ofereça o Pix via Open Finance em seu ambiente de pagamento (Checkout Transparente).
     */
    case OpenFinance = 'OPB';

    /**
     * Habilite a opção para pagamento no App Banco do Brasil. (disponível para CNAEs específicos – verifique com seu Gerente).
     */
    case Financiamento = 'CDC';

    /**
     * Habilite a opção para pagamento no App Banco do Brasil. (necessária afiliação Cielo de e-commerce)
     */
    case CartaoDeCredito = 'EC3';

    /**
     * Habilite a opção para pagamento no App Banco do Brasil.
     */
    case PontosLivelo = 'LIV';

    /**
     * Habilite a opção para pagamento no App Banco do Brasil.
     */
    case PontosLiveloCR3 = 'CR3';

    /**
     * Habilite a opção para pagamento no App Banco do Brasil.
     */
    case PontosLiveloLR4 = 'LR4';

    /**
     * Habilite a opção para pagamento no App Banco do Brasil.
     */
    case PontosLiveloCR5 = 'CR5';
}
