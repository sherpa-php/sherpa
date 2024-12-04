<?php

use Sherpa\Core\views\SherpaEngine;
use Sherpa\Core\views\SherpaRendering;

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