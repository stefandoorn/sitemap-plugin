<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Generator;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\ProductInterface;

interface ProductImagesToSitemapImagesCollectionGeneratorInterface
{
    public function generate(ProductInterface $product): Collection;
}
