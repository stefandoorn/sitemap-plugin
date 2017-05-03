<?php

namespace SitemapPlugin\Builder;

use SitemapPlugin\Provider\IndexUrlProviderInterface;
use SitemapPlugin\Model\SitemapInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexBuilderInterface extends BuilderInterface
{
    /**
     * @param IndexUrlProviderInterface $provider
     */
    public function addIndexProvider(IndexUrlProviderInterface $provider);

    /**
     * @return SitemapInterface
     */
    public function build();
}
