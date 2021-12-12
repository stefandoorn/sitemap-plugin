<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Builder;

use SitemapPlugin\Builder\Model\SitemapInterface;
use SitemapPlugin\Builder\Provider\UrlProviderInterface;
use Sylius\Component\Core\Model\ChannelInterface;

interface SitemapBuilderInterface extends BuilderInterface
{
    public function build(UrlProviderInterface $provider, ChannelInterface $channel): SitemapInterface;

    /**
     * @return UrlProviderInterface[]
     */
    public function getProviders(): iterable;
}
