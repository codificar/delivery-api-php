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

        $anonymous->estimate = static function () {
            return 'estimate/estimate-request';
        };

        return $anonymous;
    }
}
