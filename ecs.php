<?php

use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $config): void {
    $config->import('vendor/sylius-labs/coding-standard/ecs.php');

    $config->paths([
        __DIR__ . '/spec',
        __DIR__ . '/src',
        __DIR__ . '/tests',
        'ecs.php',
    ]);

    $config->skip([
        VisibilityRequiredFixer::class => ['*Spec.php'],
        'tests/Application/*',
    ]);

    $config->ruleWithConfiguration(
        NativeFunctionInvocationFixer::class,
        ['include' => ['@all'], 'scope' => 'all', 'strict' => \true]);

    $config->ruleWithConfiguration(
        TrailingCommaInMultilineFixer::class,
        ['elements' => ['arguments', 'array_destructuring', 'arrays', 'match', 'parameters']]);
};
