<?php

use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import('vendor/sylius-labs/coding-standard/ecs.php');

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::SKIP, [
        VisibilityRequiredFixer::class => ['*Spec.php'],
        'tests/Application/*',
    ]);

    $services = $containerConfigurator->services();
    $services->set(
        NativeFunctionInvocationFixer::class
    )->call('configure', [['include' => ['@all'], 'scope' => 'all', 'strict' => \true]]);
};
