<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\IndexUrlInterface;

interface IndexUrlFactoryInterface
{
    public function createNew(string $location): IndexUrlInterface;
}
