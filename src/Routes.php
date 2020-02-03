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
            return Client::VERSION_API . 'user/request/create';
        };

        $anonymous->estimate = static function () {
            return Client::VERSION_API . 'int​/corp​/estimate_request';
        };

        $anonymous->resend = static function () {
            return Client::VERSION_API . 'request/resend';
        };

        $anonymous->details = static function () {
            return Client::VERSION_API . "user/request_details";
        };

        return $anonymous;
    }
}
