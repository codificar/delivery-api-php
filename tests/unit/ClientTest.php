<?php
namespace Delivery\Test;

require_once ('vendor/autoload.php');

use Delivery\Client;
use Delivery\Exceptions\DeliveryException;
use Delivery\Endpoints\Endpoint;
use Delivery\Endpoints\Ride;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

final class ClientTest extends TestCase
{
    public function testSuccessfulResponse()
    {
        $container = [];
        $history = Middleware::history($container);
        $mock = new MockHandler([
            new Response(200, [], '{"status":"Ok!"}'),
        ]);
        $handler = HandlerStack::create($mock);
        $handler->push($history);

        $client = new Client(['handler' => $handler], true);

        $options =[
            "user_id" => 35,
            "toekn" => "2y10b3Zb8X03lI3qA0q3B170zuJDpQMOSJcykgrv2qK62OFsp3nIjYNee"
        ];

        $response = $client->request(Endpoint::GET, 'estimate/estimate-request', $options );

        $this->assertEquals($response->status, "Ok!");
    }

    /**
     * @expectException() \Delivery\Exceptions\DeliveryException
     */
    /*
    public function testDeliveryRideFailedResponse()
    {
        $mock = new MockHandler([
            new Response(401, [], '{
                "errors": [{
                    "message": "api_key está faltando",
                    "parameter_name": "api_key",
                    "type": "invalid_parameter"
                }],
                "method": "get",
                "url": "/ride"
            }')
        ]);

        $handler = HandlerStack::create($mock);

        $client = new Client(['handler' => $handler], true);

        $errorType = 'invalid_parameter';
        $parameter = 'api_key';
        $message = 'api_key está faltando';
        $expectedExceptionMessage = sprintf(
            'ERROR TYPE: %s. PARAMETER: %s. MESSAGE: %s',
            $errorType,
            $parameter,
            $message
        );
        $options =[
            "user_id" => 35,
            "toekn" => "2y10b3Zb8X03lI3qA0q3B170zuJDpQMOSJcykgrv2qK62OFsp3nIjYNee"
        ];

        try {
            $response = $client->request(Endpoint::GET, 'estimate/estimate-request', $options );
        } catch (\Delivery\Exceptions\DeliveryException $exception) {
            $this->assertEquals($expectedExceptionMessage, $exception->getMessage());
            $this->assertEquals($parameter, $exception->getParameterName());
            $this->assertEquals($errorType, $exception->getType());

            throw $exception;
        }
    }*/

    /**
     * @expectException() \GuzzleHttp\Exception\ServerException
     */
    /*
    public function testRequestRideFailedResponse()
    {
        $mock = new MockHandler([
            new Response(502, [], '<div>Bad Gateway</div>')
        ]);

        $handler = HandlerStack::create($mock);

        $client = new Client(['handler' => $handler], true);

        $options =[
            "user_id" => 35,
            "toekn" => "2y10b3Zb8X03lI3qA0q3B170zuJDpQMOSJcykgrv2qK62OFsp3nIjYNee"
        ];

        $response = $client->request(Endpoint::GET, 'estimate/estimate-request', $options );
    }
    */

    /*
    public function testSuccessfulResponseRideWithCustomUserAgentHeader()
    {
        $container = [];
        $history = Middleware::history($container);
        $mock = new MockHandler([
            new Response(200, [], '{"status":"Ok!"}'),
        ]);
        $handler = HandlerStack::create($mock);
        $handler->push($history);

        $client = new Client(
            'apiKey',
            [
                'handler' => $handler,
                'headers' => ['User-Agent' => 'MyCustomApplication/10.2.2']
            ]
        );

        $response = $client->request(Endpoint::GET, 'transactions');

        $this->assertEquals($response->status, "Ok!");
        $this->assertEquals(
            'api_key=apiKey',
            $container[0]['request']->getUri()->getQuery()
        );

        $expectedUserAgent = sprintf(
            'MyCustomApplication/10.2.2 PHP/%s',
            phpversion()
        );
        $this->assertEquals(
            $expectedUserAgent,
            $container[0]['request']->getHeaderLine('User-Agent')
        );
        $this->assertEquals(
            $expectedUserAgent,
            $container[0]['request']->getHeaderLine(
                Client::DELIVERY_USER_AGENT_HEADER
            )
        );
    }
    */
}
