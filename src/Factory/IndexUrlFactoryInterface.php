<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Factory;

use StefanDoorn\SyliusSitemapPlugin\Model\IndexUrlInterface;

interface IndexUrlFactoryInterface
{
    public function createNew(string $location): IndexUrlInterface;
}
