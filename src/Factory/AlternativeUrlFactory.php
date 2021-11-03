<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Factory;

use StefanDoorn\SyliusSitemapPlugin\Model\AlternativeUrl;
use StefanDoorn\SyliusSitemapPlugin\Model\AlternativeUrlInterface;

final class AlternativeUrlFactory implements AlternativeUrlFactoryInterface
{
    public function createNew(string $location, string $locale): AlternativeUrlInterface
    {
        return new AlternativeUrl($location, $locale);
    }
}
