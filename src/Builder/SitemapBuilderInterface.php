<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Builder;

use StefanDoorn\SyliusSitemapPlugin\Model\SitemapInterface;
use StefanDoorn\SyliusSitemapPlugin\Provider\UrlProviderInterface;
use Sylius\Component\Core\Model\ChannelInterface;

interface SitemapBuilderInterface extends BuilderInterface
{
    public function build(UrlProviderInterface $provider, ChannelInterface $channel): SitemapInterface;

    /**
     * @return UrlProviderInterface[]
     */
    public function getProviders(): iterable;
}
