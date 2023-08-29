<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder;

use SitemapPlugin\Model\SitemapInterface;
use SitemapPlugin\Provider\IndexUrlProviderInterface;
use Sylius\Component\Core\Model\ChannelInterface;
interface SitemapIndexBuilderInterface extends BuilderInterface
{
    public function addIndexProvider(IndexUrlProviderInterface $indexProvider): void;

    public function build(ChannelInterface $channel): SitemapInterface;
}

