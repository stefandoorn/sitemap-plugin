<?php

namespace SyliusSitemapBundle\Builder;

use SyliusSitemapBundle\Model\SitemapInterface;
use SyliusSitemapBundle\Provider\IndexUrlProviderInterface;
use SyliusSitemapBundle\Provider\UrlProviderInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexBuilderInterface
{

    /**
     * @param UrlProviderInterface $provider
     */
    public function addProvider(UrlProviderInterface $provider);

    /**
     * @param IndexUrlProviderInterface $provider
     */
    public function addIndexProvider(IndexUrlProviderInterface $provider);

    /**
     * @return SitemapInterface
     */
    public function build();
}
