<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Net;

use GuzzleHttp;
use GuzzleHttp\Exception\GuzzleException;
use kamermans\OAuth2\GrantType\ClientCredentials;
use kamermans\OAuth2\OAuth2Middleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use UnderWork\BancoDoBrasilApiV2\Concerns\Commons\HasOAuthUrl;
use UnderWork\BancoDoBrasilApiV2\Contracts\BBConfiguration;
use UnderWork\BancoDoBrasilApiV2\Net\Contracts\BBHttpClient as BBHttpClientContract;
use UnderWork\BancoDoBrasilApiV2\Net\ValueObjects\BBRequest;

class BBHttpClient implements BBHttpClientContract
{
    use HasOAuthUrl;

    private BBConfiguration $configuration;

    private GuzzleHttp\Client $client;

    public function __construct(BBConfiguration $configuration)
    {
        $this->configuration = $configuration;

        // Configure automatic retry
        $stack = GuzzleHttp\HandlerStack::create();
        $stack->push($this->createOAuthMiddleware($configuration));
        $stack->push($this->createInjectQueryParamMiddleware($configuration));
        $stack->push($this->createRetryMiddleware($configuration));

        $this->client = new GuzzleHttp\Client([
            'handler' => $stack,
            'auth' => 'oauth',
            'http_errors' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'accept' => 'application/json',
            ],
            'verify' => $configuration->verify,
            'cert' => $configuration->cert,
            'ssl_key' => $configuration->sslKey,
        ]);
    }

    private function createOAuthMiddleware(BBConfiguration $configuration)
    {
        $oAuthClient = new GuzzleHttp\Client(['base_uri' => $this->getOAuthUrl($configuration)]);

        $oAuthConfig = [
            'client_id' => $configuration->clientId,
            'client_secret' => $configuration->clientSecret,
        ];

        $grantType = new ClientCredentials($oAuthClient, $oAuthConfig);

        return new OAuth2Middleware($grantType);
    }

    private function createInjectQueryParamMiddleware(BBConfiguration $configuration)
    {
        return GuzzleHttp\Middleware::mapRequest(
            fn(RequestInterface $request) => $request->withUri(
                GuzzleHttp\Psr7\Uri::withQueryValue($request->getUri(), 'gw-dev-app-key', $configuration->developerApplicationKey)
            )
        );
    }

    private function createRetryMiddleware(BBConfiguration $configuration): callable
    {
        $decider = function (int $retries, RequestInterface $request, ?ResponseInterface $response = null) use ($configuration): bool {
            return
                $retries < $configuration->maxRetries
                && $response !== null
                && $response->getStatusCode() === 429;
        };

        $delay = function (int $retries, ResponseInterface $response): int {
            if (! $response->hasHeader('Retry-After')) {
                return GuzzleHttp\RetryMiddleware::exponentialDelay($retries);
            }

            $retryAfter = $response->getHeaderLine('Retry-After');

            if (! is_numeric($retryAfter)) {
                $retryAfter = (new \DateTime($retryAfter))->getTimestamp() - time();
            }

            return (int) $retryAfter * 1000;
        };

        return GuzzleHttp\Middleware::retry($decider, $delay);
    }

    /**
     *
     * @param BBRequest $request
     * @return object {statusCode: int, body: mixed, headers: list<list<string>>}
     * @throws GuzzleException
     */
    public function send(BBRequest $request)
    {
        $options = $request->options;

        if ($request->body) {
            $options['json'] = $request->body;
        }

        $response = $this->client->request($request->method, $request->url, $options);

        $status = $response->getStatusCode();
        $rawBody = (string) $response->getBody();

        // Attempt JSON decode but fall back to raw string
        $decoded = null;
        if ($rawBody !== '') {
            try {
                $decoded = json_decode($rawBody, false, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                // keep $decoded as null
            }
        }

        return (object) [
            'statusCode' => $status,
            'body' => $decoded ?? $rawBody,
            'headers' => $response->getHeaders(),
        ];
    }
}
