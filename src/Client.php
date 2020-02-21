<?php

namespace Delivery;

use Delivery\RequestHandler;
use Delivery\Endpoints\Ride;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException as ClientException;
use Delivery\Exceptions\InvalidJsonException;

class Client
{
    /**
     * @var string
     */
    const VERSION_API = "api/v1/";
    //const BASE_URI      = 'https://app.menufood.aplicativodeentrega.com.br/';
    const BASE_URI      = 'http://version.motoboy.versaoemteste.com.br/';

    /**
     * @var string header used to identify application's requests
     */
    const DELIVERY_USER_AGENT_HEADER = 'X-CodificarDelivery-User-Agent';

    /**
     * @var \GuzzleHttp\Client
     */
    private $http;

    /**
     * @var \Delivery\Endpoints\Ride
     */
    private $ride;

    /**
     * @param string $apiKey
     * @param array|null $extras
     * @param boolean|false $test
     */
    public function __construct($base_url = "", array $extras = null)
    {
        if(empty($base_url) || !is_string($base_url) || !filter_var($base_url, FILTER_VALIDATE_URL))
            $base_url = self::BASE_URI;

        $options = ['base_uri' => $base_url];

        if (!is_null($extras)) {
            $options = array_merge($options, $extras);
        }

        $userAgent = isset($options['headers']['User-Agent']) ?
            $options['headers']['User-Agent'] :
            '';

        $options['headers'] = $this->addUserAgentHeaders($userAgent);

        $this->http = new HttpClient($options);

        $this->ride = new Ride($this);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @throws \Delivery\Exceptions\DeliveryException
     * @return \ArrayObject
     *
     * @psalm-suppress InvalidNullableReturnType
     */
    public function request($method, $uri, $options = [])
    {
        try {
            $response = $this->http->request(
                $method,
                $uri,
                $options
            );

            return ResponseHandler::success((string)$response->getBody());
        } catch (InvalidJsonException $exception) {
            throw $exception;
        } catch (ClientException $exception) {
            ResponseHandler::failure($exception);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * Build an user-agent string to be informed on requests
     *
     * @param string $customUserAgent
     *
     * @return string
     */
    private function buildUserAgent($customUserAgent = '')
    {
        return trim(sprintf(
            '%s PHP/%s',
            $customUserAgent,
            phpversion()
        ));
    }

    /**
     * Append new keys (the default and delivery) related to user-agent
     *
     * @param string $customUserAgent
     * @return array
     */
    private function addUserAgentHeaders($customUserAgent = '')
    {
        return [
            'User-Agent' => $this->buildUserAgent($customUserAgent),
            self::DELIVERY_USER_AGENT_HEADER => $this->buildUserAgent(
                $customUserAgent
            )
        ];
    }

    /**
     * @return \Delivery\Endpoints\Ride
     */
    public function ride()
    {
        return $this->ride;
    }
}
