<?php

declare(strict_types=1);

namespace UnderWork\BancoDoBrasilApiV2\Net;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\RetryMiddleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use UnderWork\BancoDoBrasilApiV2\Contracts\BBConfiguration;
use UnderWork\BancoDoBrasilApiV2\Net\Contracts\BBHttpClient as BBHttpClientContract;
use UnderWork\BancoDoBrasilApiV2\Net\ValueObjects\BBRequest;
use UnderWork\BancoDoBrasilApiV2\Net\ValueObjects\BBResponse;

class BBHttpClient implements BBHttpClientContract
{
    private BBConfiguration $configuration;

    private HttpClient $client;

    public function __construct(BBConfiguration $configuration)
    {
        $this->configuration = $configuration;

        $decider = function (int $retries, RequestInterface $request, ?ResponseInterface $response = null) use ($configuration): bool {
            return
                $retries < $configuration->maxRetries
                && $response !== null
                && $response->getStatusCode() === 429;
        };

        $delay = function (int $retries, ResponseInterface $response): int {
            if (! $response->hasHeader('Retry-After')) {
                return RetryMiddleware::exponentialDelay($retries);
            }

            $retryAfter = $response->getHeaderLine('Retry-After');

            if (! is_numeric($retryAfter)) {
                $retryAfter = (new \DateTime($retryAfter))->getTimestamp() - time();
            }

            return (int) $retryAfter * 1000;
        };

        // Configure automatic retry
        $stack = HandlerStack::create();
        $stack->push(Middleware::retry($decider, $delay));

        $this->client = new HttpClient([
            'handler' => $stack,
            'headers' => [
                'gw-dev-app-key' => $configuration->developerApplicationKey,
                'Content-Type' => 'application/json',
                'accept' => 'application/json',
            ],
        ]);
    }

    public function send(BBRequest $request): BBResponse
    {
        $response = $this->client->request($request->method, $request->url, $request->options);

        throw new \Exception('Not yet implemented');
    }
}
