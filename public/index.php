<?php declare(strict_types=1);

/**
 * This file is part of Auto AI Audio,
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

require_once __DIR__ . '/../vendor/autoload.php';

/* Load external routes file */
require_once __DIR__ . '/../src/routes.php';

// I *HATE* CORS!!!
// Check if the request is a preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Handle preflight requests
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    exit;
}

// Handle the actual request
header('Access-Control-Allow-Origin: *');

/*
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

SimpleRouter::setDefaultNamespace('\Demo\Controllers');

// Start the routing
SimpleRouter::start();
