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