<?php

namespace SitemapPlugin\Provider;

use Sylius\Component\Core\Model\ProductInterface;
use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class ProductUrlProvider implements UrlProviderInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var SitemapUrlFactoryInterface
     */
    private $sitemapUrlFactory;

    /**
     * @var array
     */
    private $urls = [];

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param RouterInterface $router
     * @param SitemapUrlFactoryInterface $sitemapUrlFactory
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        RouterInterface $router,
        SitemapUrlFactoryInterface $sitemapUrlFactory
    ) {
        $this->productRepository = $productRepository;
        $this->router = $router;
        $this->sitemapUrlFactory = $sitemapUrlFactory;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $products = $this->productRepository->findBy([
            'enabled' => true,
        ]);

        foreach ($products as $product) {
            /** @var ProductInterface $product */
            $productUrl = $this->sitemapUrlFactory->createNew();
            $localization = $this->router->generate('sylius_shop_product_show', ['slug' => $product->getSlug()], true);

            $productUrl->setLastModification($product->getUpdatedAt());
            $productUrl->setLocalization($localization);
            $productUrl->setChangeFrequency(ChangeFrequency::always());
            $productUrl->setPriority(0.5);

            $this->urls[] = $productUrl;
        }

        return $this->urls;
    }
}
