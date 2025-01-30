<?php

use Sherpa\Exceptions\exceptions\Handle;


/*
 * Handle errors.
 */

set_error_handler(function ($severity, $message, $file, $line)
{
    throw new ErrorException($message, 0, $severity, $file, $line);
});


/*
 * Handle exceptions.
 */
set_exception_handler(function (Exception $exception)
{
    new Handle($exception)->render();
});