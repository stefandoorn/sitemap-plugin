<?php

use Sylius\Bundle\CoreBundle\Application\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use SitemapPlugin\SitemapPlugin;

final class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles(): array
    {
        $bundles = array_merge(parent::registerBundles(), [
            new \Sylius\Bundle\AdminBundle\SyliusAdminBundle(),
            new \Sylius\Bundle\ShopBundle\SyliusShopBundle(),

            new \FOS\OAuthServerBundle\FOSOAuthServerBundle(), // Required by SyliusApiBundle
            new \Sylius\Bundle\AdminApiBundle\SyliusAdminApiBundle(),

            new SitemapPlugin(),
        ]);

        if (version_compare(Kernel::VERSION, '1.2', 'lt')) {
            $bundles[] = new \Fidry\AliceDataFixtures\Bridge\Symfony\FidryAliceDataFixturesBundle();
            $bundles[] = new \Nelmio\Alice\Bridge\Symfony\NelmioAliceBundle();
        }

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        if ($this->getEnvironment() === 'test_relative') {
            $loader->load($this->getRootDir() . '/config/config_test_relative.yml');
            return;
        }

        $loader->load($this->getRootDir() . '/config/config.yml');
    }
}
