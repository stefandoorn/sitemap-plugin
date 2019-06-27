<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use Doctrine\Common\Collections\Collection;
use SitemapPlugin\Factory\AlternativeUrlFactoryInterface;
use SitemapPlugin\Factory\UrlFactoryInterface;
use SitemapPlugin\Generator\ProductImagesToSitemapImagesCollectionGeneratorInterface;
use SitemapPlugin\Model\ChangeFrequency;
use SitemapPlugin\Model\UrlInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductTranslationInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Model\TranslationInterface;
use Symfony\Component\Routing\RouterInterface;

final class ProductUrlProvider implements UrlProviderInterface
{
    /** @var ProductRepositoryInterface|EntityRepository */
    private $productRepository;

    /** @var RouterInterface */
    private $router;

    /** @var UrlFactoryInterface */
    private $urlFactory;

    /** @var AlternativeUrlFactoryInterface */
    private $urlAlternativeFactory;

    /** @var LocaleContextInterface */
    private $localeContext;

    /** @var ChannelContextInterface */
    private $channelContext;

    /** @var array */
    private $urls = [];

    /** @var array */
    private $channelLocaleCodes;

    /** @var ProductImagesToSitemapImagesCollectionGeneratorInterface */
    private $productToImageSitemapArrayGenerator;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        RouterInterface $router,
        UrlFactoryInterface $urlFactory,
        AlternativeUrlFactoryInterface $urlAlternativeFactory,
        LocaleContextInterface $localeContext,
        ChannelContextInterface $channelContext,
        ProductImagesToSitemapImagesCollectionGeneratorInterface $productToImageSitemapArrayGenerator
    ) {
        $this->productRepository = $productRepository;
        $this->router = $router;
        $this->urlFactory = $urlFactory;
        $this->urlAlternativeFactory = $urlAlternativeFactory;
        $this->localeContext = $localeContext;
        $this->channelContext = $channelContext;
        $this->productToImageSitemapArrayGenerator = $productToImageSitemapArrayGenerator;
    }

    public function getName(): string
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function generate(): iterable
    {
        foreach ($this->getProducts() as $product) {
            $this->urls[] = $this->createProductUrl($product);
        }

        return $this->urls;
    }

    /**
     * @return Collection|ProductTranslationInterface[]
     */
    private function getTranslations(ProductInterface $product): Collection
    {
        return $product->getTranslations()->filter(function (TranslationInterface $translation) {
            return $this->localeInLocaleCodes($translation);
        });
    }

    private function localeInLocaleCodes(TranslationInterface $translation): bool
    {
        return \in_array($translation->getLocale(), $this->getLocaleCodes());
    }

    /**
     * @return array|Collection|ProductInterface[]
     */
    private function getProducts(): iterable
    {
        return $this->productRepository->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin('o.translations', 'translation')
            ->andWhere(':channel MEMBER OF o.channels')
            ->andWhere('o.enabled = :enabled')
            ->setParameter('channel', $this->channelContext->getChannel())
            ->setParameter('enabled', true)
            ->getQuery()
            ->getResult();
    }

    private function getLocaleCodes(): array
    {
        if ($this->channelLocaleCodes === null) {
            /** @var ChannelInterface $channel */
            $channel = $this->channelContext->getChannel();

            $this->channelLocaleCodes = $channel->getLocales()->map(function (LocaleInterface $locale) {
                return $locale->getCode();
            })->toArray();
        }

        return $this->channelLocaleCodes;
    }

    private function createProductUrl(ProductInterface $product): UrlInterface
    {
        $productUrl = $this->urlFactory->createNew(''); // todo bypassing this new constructor right now
        $productUrl->setChangeFrequency(ChangeFrequency::always());
        $productUrl->setPriority(0.5);
        $updatedAt = $product->getUpdatedAt();
        if ($updatedAt) {
            $productUrl->setLastModification($updatedAt);
        }
        $productUrl->setImages($this->productToImageSitemapArrayGenerator->generate($product));

        /** @var ProductTranslationInterface $translation */
        foreach ($this->getTranslations($product) as $translation) {
            $locale = $translation->getLocale();

            if (!$locale) {
                continue;
            }

            if (!$this->localeInLocaleCodes($translation)) {
                continue;
            }

            $location = $this->router->generate('sylius_shop_product_show', [
                'slug' => $translation->getSlug(),
                '_locale' => $translation->getLocale(),
            ]);

            if ($locale === $this->localeContext->getLocaleCode()) {
                $productUrl->setLocation($location);

                continue;
            }

            $productUrl->addAlternative($this->urlAlternativeFactory->createNew($location, $locale));
        }

        return $productUrl;
    }
}
