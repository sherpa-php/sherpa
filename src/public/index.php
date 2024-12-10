<?php

/**
 * ==========================================================
 *  Sherpa Frameworks  --  Private Development Version
 * ==========================================================
 *
 * @package    Sherpa
 * @version    0.x (PDV)
 * @author     belicfr
 * @license    MIT
 * @link       https://github.com/sherpa-php
 *
 * ==========================================================
 */


use Dotenv\Dotenv;
use Sherpa\Core\core\Sherpa;
use Sherpa\Core\exceptions\database\CannotConnectToDatabaseException;
use Sherpa\Core\router\Request;
use Sherpa\Core\router\Router;
use Sherpa\Core\security\CSRF;
use Sherpa\Db\database\DB;

session_start();
ob_start();

/** Sherpa project root path */
const __ROOT__ = __DIR__ . "/../..";

/** src/ directory path */
const __SRC__ = __DIR__ . "/..";

require_once __ROOT__ . "/vendor/autoload.php";


Dotenv::createImmutable(__ROOT__)
    ->load();


/*
 * CSRF generation
 */

if (Sherpa::session("CSRF_TOKEN") === null)
{
    CSRF::regenerate();
}


require_once __ROOT__ . "/vendor/sherpa/core/src/core/utils.php";
require_once __SRC__ . "/app/shortcuts.php";


/*
 * Sherpa Environment Initialization
 */

Sherpa::loadEnv();


/*
 * Database Connection
 */

if (!DB::connect(...Sherpa::db()))
{
    throw new CannotConnectToDatabaseException();
}


/*
 * Router Loading
 */

require_once __SRC__ . "/router/default.php";

$request = new Request();
Router::middlewares(include __SRC__ . "/app/config/middlewares.php");
Router::resolve($request);

ob_end_flush();
