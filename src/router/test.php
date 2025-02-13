<?php

use Sherpa\Core\router\Router;

/*
 * Sherpa Test routes definition
 */

Router::get("/test", fn () => test());