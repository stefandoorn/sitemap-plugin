<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Factory;

use StefanDoorn\SyliusSitemapPlugin\Model\UrlInterface;

interface UrlFactoryInterface
{
    public function createNew(string $location): UrlInterface;
}
