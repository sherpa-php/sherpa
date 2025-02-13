<?php

use Sherpa\Core\router\Router;
use Sherpa\Sherpa\test\simple\SimpleTest;

/*
 * Sherpa Test routes definition
 */

Router::get("/test", function ()
{
    echo "<a href='"
        . route("test.simple")
        . "'>Let's test with Sherpa Test!</a>";
});

Router::get("/test/simple",
            fn () => test(SimpleTest::class))
      ->name("test.simple");