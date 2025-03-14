<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider\Data;

use Sylius\Component\Core\Model\ChannelInterface;

interface DataProviderInterface
{
    public function get(ChannelInterface $channel): iterable;
}
