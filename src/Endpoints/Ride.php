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
        return $this->client->request(
            self::POST,
            Routes::ride()->resend(),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return \ArrayObject
     */
    public function tracking(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::ride()->tracking($payload['id']),
            ['query' => $payload]
        );
    }
}
