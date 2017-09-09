<?php declare(strict_types=1);

namespace SitemapPlugin;

use SitemapPlugin\DependencyInjection\Compiler\SitemapProviderPass;
use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapPlugin extends Bundle
{
    use SyliusPluginTrait;

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SitemapProviderPass());
    }
}
