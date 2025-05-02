<?php

$header = <<<HEADER
This file is part of AI Interviewer, an Autonomo by Autonomous Programming, LLC, project.

Copyright © 2025 Autonomous Programming, LLC
Author: Theodore R. Smith <theodore.smith@autonomo.codes>
  GPG Fingerprint: 6CAC F838 454C 8912 8AA2  26DB 89DC D8F1 3BB9 33B3
  https://audio.autonomo.dev/
  https://github.com/AutonomoDev/AIInterviewer

This file is closed source.
All rights reserved.
HEADER;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony'       => true,
        'elseif'         => false,
        'yoda_style'     => false,
        'list_syntax'    => ['syntax'  => 'short'],
        'concat_space'   => ['spacing' => 'one'],
        'binary_operator_spaces' => [
            'operators' => [
                '='  => 'align',
                '=>' => 'align',
            ],
        ],
        'phpdoc_no_alias_tag'          => false,
        'declare_strict_types'         => true,
        'no_superfluous_elseif'        => true,
        'blank_line_after_opening_tag' => false,
        'header_comment' => [
            'header'       => $header,
            'location'     => 'after_declare_strict',
            'comment_type' => 'PHPDoc',
        ]
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude('vendor')
            ->in(__DIR__)
    );
