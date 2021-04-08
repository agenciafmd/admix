<?php

namespace Agenciafmd\Admix\Services\Concerns;

use Agenciafmd\Admix\Events\GuzzleRequestFailedEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

trait MakesHttpRequests
{
    /** @var \GuzzleHttp\Client */
    public $guzzleClient;

    protected function bootMakesHttpRequests()
    {
        $logger = new Logger(class_basename($this));
        $logger->pushHandler(
            new StreamHandler(
                storage_path('logs/' . Str::kebab(class_basename($this)) . '-' . date('Y-m-d') . '.log')
            )
        );

        $handler = HandlerStack::create();
        $handler->push(
            Middleware::log(
                $logger,
                new MessageFormatter($this->messageFormatter())
            )
        );

        $this->guzzleClient = new Client(
            $this->guzzleOptions() + [
                'handler' => $handler,
            ]
        );
    }

    private function guzzleOptions()
    {
        return array_merge([
                'timeout' => 120,
                'connect_timeout' => 120,
                'http_errors' => false,
                'verify' => false,
            ],
            ($this->guzzleOptions ?? [])
        );
    }

    private function messageFormatter()
    {
        return $this->messageFormatter
            ?? '{method} {uri} HTTP/{version} {req_body} | RESPONSE: {code} - {res_body}';
    }

    private function ignoredHttpCodes()
    {
        return $this->ignoredHttpCodes ?? [];
    }

    protected function request(string $method, string $url, array $options = [])
    {
        try {
            return $this->guzzleClient->request($method, $url, $options);
        } catch (ClientException | ServerException $exception) {
            GuzzleRequestFailedEvent::dispatch($exception);

            Log::warning("Retorno {$response->getStatusCode()} em request.");

            $response = $exception->getResponse();
        }

        if (in_array($response->getStatusCode(), $this->ignoredHttpCodes())) {
            report($exception);

            return $response;
        }

        throw $exception;
    }
}
