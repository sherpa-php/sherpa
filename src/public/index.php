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
use Sherpa\Core\router\Request;
use Sherpa\Core\router\Router;

session_start();
ob_start();

const __ROOT__ = __DIR__ . "/../..";
const __SRC__ = __DIR__ . "/..";

require_once __ROOT__ . "/vendor/autoload.php";


Dotenv::createImmutable(__ROOT__)
    ->load();


require_once __ROOT__ . "/vendor/sherpa/core/src/core/utils.php";
require_once __SRC__ . "/app/shortcuts.php";


/*
 * Router Loading
 */

require_once __SRC__ . "/router/default.php";

$request = new Request();
Router::resolve($request);

ob_end_flush();
