<?php

declare(strict_types=1);

namespace SitemapPlugin\Generator;

use Sylius\Component\Core\Model\ProductInterface;

interface ProductToImageSitemapArrayGeneratorInterface
{
    public function generate(ProductInterface $product): array;
}
