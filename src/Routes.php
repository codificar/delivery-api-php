<?php

namespace Delivery;

use Delivery\Anonymous;

class Routes
{
    /**
     * @return \Delivery\Anonymous
     */
    public static function ride()
    {
        $anonymous = new Anonymous();

        $anonymous->create = static function () {
            return Client::VERSION_API . 'int/corp/request/create';
        };

        $anonymous->estimate = static function () {
            return Client::VERSION_API . 'int/corp/estimate_request';
        };

        $anonymous->resend = static function () {
            return Client::VERSION_API . 'request/resend';
        };

        $anonymous->details = static function ($id) {
            return Client::VERSION_API . "int/corp/request/details/$id";
        };

        return $anonymous;
    }

      /**
     * @return \PagarMe\Anonymous
     */
    public static function store()
    {
        $anonymous = new Anonymous();

        $anonymous->create = static function () {
            return Client::VERSION_API . 'corp/new';
        };
        return $anonymous;
    }
}
