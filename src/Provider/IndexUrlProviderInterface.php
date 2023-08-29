<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;
use Sylius\Component\Core\Model\ChannelInterface;
interface IndexUrlProviderInterface
{
    public function generate(ChannelInterface $channel): iterable;

    public function addProvider(UrlProviderInterface $provider): void;
}
