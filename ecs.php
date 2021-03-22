<?php

use PhpCsFixer\Fixer\FunctionNotation\NativeFunctionInvocationFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import('vendor/sylius-labs/coding-standard/ecs.php');

    $parameters = $containerConfigurator->parameters();
    $parameters->set('exclude_files', ['tests/Application/*']);

    $services = $containerConfigurator->services();
    $services->set(NativeFunctionInvocationFixer::class);
};
