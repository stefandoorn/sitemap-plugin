<?php

namespace SyliusSitemapBundle\Builder;

use SyliusSitemapBundle\Model\SitemapInterface;
use SyliusSitemapBundle\Provider\UrlProviderInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapBuilderInterface
{
    /**
     * @param UrlProviderInterface $provider
     */
    public function addProvider(UrlProviderInterface $provider);

    /**
     * @return SitemapInterface
     */
    public function build(array $filter = []);

    /**
     * @return array
     */
    public function getProviders();
}
