<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Generator;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use PhpSpec\ObjectBehavior;
use SitemapPlugin\Factory\ImageFactoryInterface;
use SitemapPlugin\Generator\ProductImagesToSitemapImagesCollectionGenerator;
use SitemapPlugin\Generator\ProductImagesToSitemapImagesCollectionGeneratorInterface;
use Sylius\Component\Core\Model\ProductInterface;

final class ProductImagesToSitemapImagesCollectionGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable(ImageFactoryInterface $imageFactory, CacheManager $cacheManager)
    {
        $this->beConstructedWith($imageFactory, $cacheManager);
        $this->shouldHaveType(ProductImagesToSitemapImagesCollectionGenerator::class);
    }

    function it_implements_product_images_to_sitemap_images_collection_generator_interface(ImageFactoryInterface $imageFactory,
                                                                                           CacheManager $cacheManager
    ) {
        $this->beConstructedWith($imageFactory, $cacheManager);
        $this->shouldImplement(ProductImagesToSitemapImagesCollectionGeneratorInterface::class);
    }

    function it_generates_collection_of_images_from_a_product(ImageFactoryInterface $imageFactory,
                                                              CacheManager $cacheManager,
                                                              ProductInterface $product
    ) {
        $this->beConstructedWith($imageFactory, $cacheManager);
        $product->getImages()->willReturn(new ArrayCollection());
        $this->generate($product)->shouldImplement(Collection::class);
    }
}
