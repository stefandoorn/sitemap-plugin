<?php

declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\AlternativeUrlInterface;

interface AlternativeUrlFactoryInterface
{
    public function createNew(string $location, string $locale): AlternativeUrlInterface;
}
