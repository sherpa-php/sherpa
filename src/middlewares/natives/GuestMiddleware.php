<?php

namespace Sherpa\Sherpa\middlewares\natives;

use Sherpa\Core\middlewares\Middleware;
use Sherpa\Core\middlewares\MiddlewareResponse;
use Sherpa\Core\router\Request;
use Sherpa\Sherpa\app\core\authenticate\Auth;

class GuestMiddleware implements Middleware
{
    public function run(Request $request): MiddlewareResponse
    {
        return Auth::check()
            ? MiddlewareResponse::ABORT
            : MiddlewareResponse::CONTINUE;
    }
}