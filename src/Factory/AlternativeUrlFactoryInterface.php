<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Factory;

use StefanDoorn\SyliusSitemapPlugin\Model\AlternativeUrlInterface;

interface AlternativeUrlFactoryInterface
{
    public function createNew(string $location, string $locale): AlternativeUrlInterface;
}
