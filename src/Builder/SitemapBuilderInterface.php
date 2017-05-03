<?php

namespace SitemapPlugin\Builder;

use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Provider\UrlProviderInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapBuilderInterface extends BuilderInterface
{
    /**
     * @return SitemapInterface
     */
    public function build(array $filter = []);

    /**
     * @return array
     */
    public function getProviders();
}
