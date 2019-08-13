<?php

declare(strict_types=1);

namespace SitemapPlugin\Generator;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\TaxonInterface;

interface TaxonImagesToSitemapImagesCollectionGeneratorInterface
{
    public function generate(TaxonInterface $taxon): Collection;
}
