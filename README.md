# Banco do Brasil API v2

Este pacote foi criado com o intuito de facilitar a conexão com a API v2 fornecida pelo Banco do Brasil.

## Instalação

```sh
composer require underwork/banco-do-brasil-api-v2
```

## Utilização

```php
<?php

use UnderWork\BancoDoBrasilApiV2\ValueObjects\Configuration;
use UnderWork\BancoDoBrasilApiV2\ValueObjects\Pix\CobrancaImediata;

/**
 * Cria arquivo de configuração. Necessário para informar as credencias de acesso a API.
 */
$configuracao = new Configuration(
    developerApplicationKey: '<secret>',
    clientId: '<secret>',
    clientSecret: '<secret>',
);

/**
 * Cria a api pix utilizando as configurações informadas.
 */
$pix = new BBApiPix($configuracao);

/**
 * A classe CobrancaImediata já faz a validação inicial dos valores
 * antes do envio para o banco do brasil.
 *
 * As validações podem ser encontradas na documentação oficial do Banco do Brasil.
 * https://apoio.developers.bb.com.br/referency/post/6483836ddcefbe00128886ce
 */
$cobranca = new CobrancaImediata(
    valor: '0.00',
    chave: 'chave pix do recebedor',
);

$pix->criarCobrancaImediata('<Seu txId aqui>', $cobranca);
```

### Notas

- O pacote está sob construção então ainda não possui muitos endpoints mapeados, conforme a nossa necessidade ou apoio da comunidade novos endpoints serão adicionados.

- Este pacote não realiza nenhuma configuração de mTLS, já que essa configuração deve ser realizada no servidor através do Apache, NGINX ou similares
