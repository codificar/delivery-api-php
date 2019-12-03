<?php

namespace Delivery;

use GuzzleHttp\Exception\ClientException;
use Delivery\Exceptions\DeliveryException;
use Delivery\Exceptions\InvalidJsonException;

class ResponseHandler
{
    /**
     * @param string $payload
     *
     * @throws \Delivery\Exceptions\InvalidJsonException
     * @return \ArrayObject
     */
    public static function success($payload)
    {
        return self::toJson($payload);
    }

    /**
     * @param ClientException $originalException
     *
     * @throws DeliveryException
     * @return void
     */
    public static function failure(\Exception $originalException)
    {
        throw self::parseException($originalException);
    }

    /**
     * @param ClientException $guzzleException
     *
     * @return DeliveryException|ClientException
     */
    private static function parseException(ClientException $guzzleException)
    {
        $response = $guzzleException->getResponse();

        if (is_null($response)) {
            return $guzzleException;
        }

        $body = $response->getBody()->getContents();

        try {
            $jsonError = self::toJson($body);
        } catch (InvalidJsonException $invalidJson) {
            return $guzzleException;
        }

        return new DeliveryException(
            $jsonError->errors[0]->type,
            $jsonError->errors[0]->parameter_name,
            $jsonError->errors[0]->message
        );
    }

    /**
     * @param string $json
     * @return \ArrayObject
     */
    private static function toJson($json)
    {
        $result = json_decode($json);

        if (json_last_error() != \JSON_ERROR_NONE) {
            if(json_last_error_msg() == 'Syntax error')
                return $json;
            throw new InvalidJsonException(json_last_error_msg());
        }

        return $result;
    }
}
