<?php

namespace Delivery\Endpoints;

use Delivery\Client;

abstract class Endpoint
{
    /**
     * @var string
     */
    const POST = 'POST';
    /**
     * @var string
     */
    const GET = 'GET';
    /**
     * @var string
     */
    const PUT = 'PUT';
    /**
     * @var string
     */
    const DELETE = 'DELETE';

    /**
     * @var \Delivery\Client
     */
    protected $client;

    /**
     * @param \Delivery\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
