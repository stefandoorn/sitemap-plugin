<?php

declare(strict_types=1);

namespace SitemapPlugin;

use SitemapPlugin\DependencyInjection\Compiler\SitemapProviderPass;
use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SitemapPlugin extends Bundle
{
    use SyliusPluginTrait;

    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new SitemapProviderPass());
    }
}
