<?php

return [

    /*
     * Middlewares definition
     * ============================
     *
     * Format:     "alias"  =>  MiddlewareClass::class
     */


    "auth" => \Sherpa\Sherpa\middlewares\natives\AuthMiddleware::class,
    "guest" => \Sherpa\Sherpa\middlewares\natives\GuestMiddleware::class,

];