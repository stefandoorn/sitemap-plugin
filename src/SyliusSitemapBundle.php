<?php

namespace SyliusSitemapBundle;

use SyliusSitemapBundle\DependencyInjection\Compiler\SitemapProviderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SyliusSitemapBundle extends Bundle
{

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SitemapProviderPass());
    }
}
