<?php

use Sherpa\Core\views\SherpaEngine;
use Sherpa\Core\views\SherpaRendering;

function views_path(): string
{
    return __SRC__ . "/views";
}

function controllers_path(): string
{
    return __SRC__ . "/controllers";
}

function public_path(): string
{
    return __SRC__ . "/public";
}

function assets_path(): string
{
    return public_path() . "/assets";
}

function render(string $viewPath, array $props = [], string $title = ""): SherpaRendering
{
    $viewPathSplit = explode(':', $viewPath, 2);

    if (isset($viewPathSplit[1]))
    {
        $title = $viewPathSplit[1];
    }

    $viewPath = $viewPathSplit[0];

    return SherpaEngine::prepare(views_path() . "/template.html")
                       ->render(
                           views_path() . "/pages/$viewPath.php",
                           $props,
                           $title);
}