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
    public function estimate(array $payload)
    {
        return $this->client->request(
            self::GET,
            Routes::ride()->estimate(),
            ['json' => $payload]
        );
    }
}
