<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response;
use Pecee\Http\Request;

/**
 * Get url for a route by using either name/alias, class or method name.
 *
 * The name parameter supports the following values:
 * - Route name
 * - Controller/resource name (with or without method)
 * - Controller class name
 *
 * When searching for controller/resource by name, you can use this syntax "route.name@method".
 * You can also use the same syntax when searching for a specific controller-class "MyController@home".
 * If no arguments is specified, it will return the url for the current loaded route.
 *
 * @param string|null $name
 * @param string|array|null $parameters
 * @param array|null $getParams
 * @return \Pecee\Http\Url
 * @throws \InvalidArgumentException
 */
function url(?string $name = null, $parameters = null, ?array $getParams = null): Url
{
    return Router::getUrl($name, $parameters, $getParams);
}

/**
 * @return \Pecee\Http\Response
 */
function response(): Response
{
    return Router::response();
}

/**
 * @return \Pecee\Http\Request
 */
function request(): Request
{
    return Router::request();
}

/**
 * Get input class
 * @param string|null $index Parameter index name
 * @param string|mixed|null $defaultValue Default return value
 * @param array ...$methods Default methods
 * @return \Pecee\Http\Input\InputHandler|array|string|null
 */
function input($index = null, $defaultValue = null, ...$methods)
{
    if ($index !== null) {
        return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
    }

    return request()->getInputHandler();
}

/**
 * @param string $url
 * @param int|null $code
 */
function redirect(string $url, ?int $code = null): void
{
    if ($code !== null) {
        response()->httpCode($code);
    }

    response()->redirect($url);
}

/**
 * Get current csrf-token
 * @return string|null
 */
function csrf_token(): ?string
{
    $baseVerifier = Router::router()->getCsrfVerifier();
    if ($baseVerifier !== null) {
        return $baseVerifier->getTokenProvider()->getToken();
    }

    return null;
}

/**
 * Finds the root path of a Composer project by looking for the composer.json file.
 *
 * @param string|null $startingPath The directory path to start searching from (defaults to current working directory)
 * @return string The absolute path to the project root
 * @throws RuntimeException If composer.json cannot be found
 */
function findProjectRoot(?string $startingPath = null): string
{
    $currentPath = $startingPath ?: getcwd();

    // Normalize the path (remove trailing slashes, resolve relative paths)
    $currentPath = realpath($currentPath);

    if ($currentPath === false) {
        throw new RuntimeException("The starting path does not exist");
    }

    // Check if we've reached the filesystem root
    while ($currentPath !== '/' && $currentPath !== '') {
        // Check for composer.json in the current directory
        if (file_exists($currentPath . DIRECTORY_SEPARATOR . 'composer.json')) {
            return $currentPath;
        }

        // Move up one directory level
        $parentPath = dirname($currentPath);

        // Prevent infinite loop if we can't go up further
        if ($parentPath === $currentPath) {
            break;
        }

        $currentPath = $parentPath;
    }

    throw new RuntimeException('Could not find composer.json in any parent directory');
}
