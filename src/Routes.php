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
            return 'user/request/create';
        };

        $anonymous->estimate = static function () {
            return 'estimate/estimate';
        };

        return $anonymous;
    }
}
