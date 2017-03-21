<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SyliusSitemapBundle\Builder;

use SyliusSitemapBundle\Model\SitemapInterface;
use SyliusSitemapBundle\Provider\UrlProviderInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
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
    public function build();
}
