<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = (new Finder())
    ->in([
        __DIR__ . '/bin',
        __DIR__ . '/config',
        __DIR__ . '/public',
        __DIR__ . '/src',
        __DIR__ . '/tests',
        // __DIR__ . '/.php-cs-fixer.dist.php',
        // __DIR__ . '/rector.php',
    ])
    ->exclude([
        __DIR__ . '/var',
        __DIR__ . '/vendor',
    ])
;

return (new Config())
    ->setRules([
        '@PSR12' => true,
        'phpdoc_to_comment' => false,
    ])
    ->setFinder($finder)
;
