<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Factory;

use SitemapPlugin\Builder\Model\IndexUrlInterface;

interface IndexUrlFactoryInterface
{
    public function createNew(string $location): IndexUrlInterface;
}
