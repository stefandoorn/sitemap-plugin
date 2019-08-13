<?php

declare(strict_types=1);

namespace SitemapPlugin\Generator;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use SitemapPlugin\Factory\ImageFactoryInterface;
use Sylius\Component\Core\Model\TaxonImageInterface;
use Sylius\Component\Core\Model\TaxonInterface;

final class TaxonImagesToSitemapImagesCollectionGenerator implements TaxonImagesToSitemapImagesCollectionGeneratorInterface
{
    /** @var CacheManager */
    private $imagineCacheManager;

    /** @var ImageFactoryInterface */
    private $sitemapImageUrlFactory;

    /** @var string */
    private $imagePreset;

    public function __construct(
        ImageFactoryInterface $sitemapImageUrlFactory,
        CacheManager $imagineCacheManager,
        string $imagePreset = 'sylius_medium'
    ) {
        $this->sitemapImageUrlFactory = $sitemapImageUrlFactory;
        $this->imagineCacheManager = $imagineCacheManager;
        $this->imagePreset = $imagePreset;
    }

    public function generate(TaxonInterface $taxon): Collection
    {
        $images = new ArrayCollection();

        /** @var TaxonImageInterface $image */
        foreach ($taxon->getImages() as $image) {
            /** @var string $path */
            $path = $image->getPath();

            if (!$path) {
                continue;
            }

            $sitemapImage = $this->sitemapImageUrlFactory->createNew($this->imagineCacheManager->getBrowserPath($path, $this->imagePreset));

            $images->add($sitemapImage);
        }

        return $images;
    }
}
