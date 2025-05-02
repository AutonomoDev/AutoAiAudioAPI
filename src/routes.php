<?php declare(strict_types=1);

/**
 * This file is part of AI Interviewer API,
 * an Autonomo by Autonomous Programming, LLC, project.
 *
 * Copyright © 2025 Autonomous Programming, LLC
 * Author: Theodore R. Smith <theodore.smith@autonomo.codes>
 *   GPG Fingerprint: 6CAC F838 454C 8912 8AA2  26DB 89DC D8F1 3BB9 33B3
 *   https://audio.autonomo.dev/
 *   https://github.com/AutonomoDev/AIInterviewer
 *
 * This file is closed source.
 * All rights reserved.
 */

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\SimpleRouter\SimpleRouter as Router;
use const _PHPStan_f2f2ddf44\__;

SimpleRouter::get('/', function () {
    return file_get_contents(__DIR__ . '/views/index.html');
});
