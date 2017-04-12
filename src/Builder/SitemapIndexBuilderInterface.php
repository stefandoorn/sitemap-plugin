<?php

namespace SitemapPlugin\Builder;

use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Provider\IndexUrlProviderInterface;
use SitemapPlugin\Provider\UrlProviderInterface;

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
