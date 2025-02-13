<?php

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\router\Request;
use Sherpa\Core\router\Router;
use Sherpa\Core\security\CSRF;
use Sherpa\Core\views\SherpaEngine;
use Sherpa\Core\views\SherpaRendering;
use Sherpa\Db\database\DB;
use Sherpa\Db\database\Reference;
use Sherpa\Sherpa\test\exceptions\InvalidTestClass;
use Sherpa\Sherpa\test\exceptions\InvalidTestClassException;
use Sherpa\Test\core\Test;
use Sherpa\Test\core\TestManager;

/**
 * @return string Views directory absolute path
 */
function views_path(): string
{
    return __SRC__ . "/views";
}

/**
 * @return string Controllers directory absolute path
 */
function controllers_path(): string
{
    return __SRC__ . "/controllers";
}

/**
 * @return string Public directory absolute path
 */
function public_path(): string
{
    return __SRC__ . "/public";
}

/**
 * @return string Public/assets directory absolute path
 */
function assets_path(): string
{
    return public_path() . "/assets";
}

/**
 * View rendering shortcut, using Sherpa Engine
 *
 * @param string $viewPath
 * @param array $props
 * @param string $title (optional) Page's title
 * @return SherpaRendering
 */
function render(string $viewPath, array $props = [], string $title = ""): SherpaRendering
{
    $viewPathSplit = explode(':', $viewPath, 2);

    if (isset($viewPathSplit[1]))
    {
        $title = $viewPathSplit[1];
    }

    $viewPath = $viewPathSplit[0];

    return SherpaEngine::prepare(views_path() . "/template.php")
                       ->render(
                           views_path() . "/pages/$viewPath.php",
                           $props,
                           $title);
}

/**
 * Create a DB Reference object.
 *
 * @param string $ref
 * @return Reference
 */
function ref(string $ref): Reference
{
    return DB::ref($ref);
}

/**
 * @return string|null Current CSRF token if exists
 */
function csrf(): ?string
{
    return Sherpa::session("CSRF_TOKEN");
}

/**
 * Retrieve route by name, and return its path.
 *
 * @param string $name Route's name
 * @return string Route's path if exists,
 *                or '#'
 */
function route(string $name): string
{
    $route = Router::getRouteByName($name);

    if ($route !== null)
    {
        return "/{$route->path()}";
    }

    return "#";
}

/**
 * Launch a Sherpa test.
 * @throws InvalidTestClassException If provided class does
 *                                   not implement Test interface
 */
function test(string $testClass): void
{
    require_once __SRC__ . "/test/startup.php";

    TestManager::run($testClass);
}