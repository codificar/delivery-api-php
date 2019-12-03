<?php

namespace Delivery\Endpoints;

use Delivery\Client;
use Delivery\Routes;
use Delivery\Endpoints\Endpoint;

class Ride extends Endpoint
{

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function create(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::ride()->create(),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function estimate(array $payload)
    {
        return $this->client->request(
            self::POST,
            Routes::ride()->estimate(),
            ['json' => $payload]
        );
    }
    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function resend(array $payload)
    {
        return $this->client->resend(
            self::POST,
            Routes::ride()->estimate(),
            ['json' => $payload]
        );
    }
}
