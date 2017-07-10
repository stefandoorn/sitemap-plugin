<?php

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductTranslationInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Resource\Model\TranslationInterface;
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
     * @var LocaleContextInterface
     */
    private $localeContext;

    /**
     * @var array
     */
    private $urls = [];

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param RouterInterface $router
     * @param SitemapUrlFactoryInterface $sitemapUrlFactory
     * @param LocaleContextInterface $localeContext
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        RouterInterface $router,
        SitemapUrlFactoryInterface $sitemapUrlFactory,
        LocaleContextInterface $localeContext
    ) {
        $this->productRepository = $productRepository;
        $this->router = $router;
        $this->sitemapUrlFactory = $sitemapUrlFactory;
        $this->localeContext = $localeContext;
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
        foreach ($this->getProducts() as $product) {
            $productUrl = $this->sitemapUrlFactory->createNew();
            $productUrl->setChangeFrequency(ChangeFrequency::always());
            $productUrl->setPriority(0.5);
            $productUrl->setLastModification($product->getUpdatedAt());

            foreach ($product->getTranslations() as $translation) {
                /** @var ProductTranslationInterface|TranslationInterface $translation */
                $location = $this->router->generate('sylius_shop_product_show', [
                    'slug' => $translation->getSlug(),
                    '_locale' => $translation->getLocale()
                ]);

                if ($translation->getLocale() === $this->localeContext->getLocaleCode()) {
                    $productUrl->setLocalization($location);
                } else {
                    $productUrl->addAlternative($location, $translation->getLocale());
                }
            }

            $this->urls[] = $productUrl;
        }

        return $this->urls;
    }

    /**
     * @return array|ProductInterface[]
     */
    private function getProducts()
    {
        return $this->productRepository->findBy([
            'enabled' => true,
        ]);
    }
}
