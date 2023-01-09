<?php

use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return static function (ECSConfig $config): void {
    $config->import('vendor/sylius-labs/coding-standard/ecs.php');

    $config->skip([
        VisibilityRequiredFixer::class => ['*Spec.php'],
        'tests/Application/*',
    ]);

    $services = $config->services();
    $services->set(
        NativeFunctionInvocationFixer::class
    )->call('configure', [['include' => ['@all'], 'scope' => 'all', 'strict' => \true]]);
};
