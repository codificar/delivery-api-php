<?php

namespace Delivery\Endpoints;

use Delivery\Client;
use Delivery\Routes;
use Delivery\Endpoints\Endpoint;

class Store extends Endpoint
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
            Routes::store()->create(),
            ['json' => $payload]
        );
    }
}

