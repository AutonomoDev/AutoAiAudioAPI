<?php declare(strict_types=1);

/**
 * This file is part of Auto AI Audio API,
 * an Autonomo by Autonomous Programming, LLC, project.
 *
 * Copyright © 2025 Autonomous Programming, LLC
 * Author: Theodore R. Smith <theodore.smith@autonomo.codes>
 *   GPG Fingerprint: 6CAC F838 454C 8912 8AA2  26DB 89DC D8F1 3BB9 33B3
 *   https://audio.autonomo.dev/
 *   https://github.com/AutonomoDev/AutoAiAudioAPI
 *
 * This file is licensed under the Small Business License.
 */

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\SimpleRouter\SimpleRouter as Router;

SimpleRouter::get('/', function () {
    return <<<HTML
    <!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" href="/css/main.css" />
            <style>
            code { display: block; white-space: pre; font-family: 'Fira Code', monospace; } 
            </style>
        </head>
        <body style="background: #DFDFFF">
            <h1>An API Server for tempest/highlight</h1>
            <p>Welcome to the API server for <span style="font-family: 'Fira Code', monospace;"><a target="_blank" href="https://github.com/tempestphp/highlight/">tempest/highlight</a></span>.</p>
            <p>The API route is pretty simple:</p>
            <code>
        POST: /highlight
    $postJSON
                
        Output: text/html
            </code>
            <p>Don't forget to include the Tempest Highlight CSS links in your HTML:</p>
            <code>    wget <a href="https://gitcdn.link/repo//tempestphp/highlight/main/src/Themes/highlight-tempest.css" target="_blank">https://gitcdn.link/repo//tempestphp/highlight/main/src/Themes/highlight-tempest.css</a></code>
        </body>
    </html>
    HTML;
});

SimpleRouter::post('/highlight', function () {
    $response = Router::response();
    $data     = json_decode(file_get_contents('php://input'), true);

    $errors = '';
    $lang   = $data['lang'] ?? null;
    if (!$lang) {
        $errors .= '<h3 style="color: red">[HIGHLIGHTER ERROR] No "lang" provided.</h3>' . "\n";
    }

    $text = $data['text'] ?? null;
    if (!$text) {
        $errors .= '<h3 style="color: red">[HIGHLIGHTER ERROR] No "text" provided.</h3>' . "\n";
    }
    if ($errors !== '') {
        $response->httpCode(400);

        return $errors;
    }

    $highlighter = new Tempest\Highlight\Highlighter();

    return $highlighter->parse($text, strtolower($lang));
});
