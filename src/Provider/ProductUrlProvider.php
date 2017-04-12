<?php

namespace SitemapPlugin\Provider;

use Sylius\Component\Core\Model\ProductInterface;
use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class ProductUrlProvider implements UrlProviderInterface
{
    /**
     * @var RepositoryInterface
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
     * @param RepositoryInterface $productRepository
     * @param RouterInterface $router
     * @param SitemapUrlFactoryInterface $sitemapUrlFactory
     */
    public function __construct(
        RepositoryInterface $productRepository,
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
        $products = $this->productRepository->findAll();

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
