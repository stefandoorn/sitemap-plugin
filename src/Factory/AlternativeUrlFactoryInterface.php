<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Factory;

use SitemapPlugin\Builder\Model\AlternativeUrlInterface;

interface AlternativeUrlFactoryInterface
{
    public function createNew(string $location, string $locale): AlternativeUrlInterface;
}
