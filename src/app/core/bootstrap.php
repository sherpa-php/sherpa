<?php

use Sherpa\Core\core\Sherpa;

if (Sherpa::isDevMode())
{
    // It displays sensitive information, it should only be rendered
    // in DEVELOPMENT MODE ONLY.

    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}
else
{
    set_exception_handler(fn () => abort(500));
    set_error_handler(fn () => abort(500));
    register_shutdown_function(fn () => abort(500));
}