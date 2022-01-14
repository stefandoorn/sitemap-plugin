<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use Doctrine\Common\Collections\Collection;
use SitemapPlugin\Factory\AlternativeUrlFactoryInterface;
use SitemapPlugin\Factory\UrlFactoryInterface;
use SitemapPlugin\Generator\ProductImagesToSitemapImagesCollectionGeneratorInterface;
use SitemapPlugin\Model\ChangeFrequency;
use SitemapPlugin\Model\UrlInterface;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductTranslationInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Model\TranslationInterface;
use Symfony\Component\Routing\RouterInterface;

final class ProductUrlProvider implements UrlProviderInterface
{
    private ProductRepository $productRepository;

    private RouterInterface $router;

    private UrlFactoryInterface $urlFactory;

    private AlternativeUrlFactoryInterface $urlAlternativeFactory;

    private LocaleContextInterface $localeContext;

    private ChannelInterface $channel;

    private string $defaultLocaleCode;

    /** @var array<string|null> */
    private array $channelLocaleCodes;

    private ProductImagesToSitemapImagesCollectionGeneratorInterface $productToImageSitemapArrayGenerator;

    public function __construct(
        ProductRepository $productRepository,
        RouterInterface $router,
        UrlFactoryInterface $urlFactory,
        AlternativeUrlFactoryInterface $urlAlternativeFactory,
        LocaleContextInterface $localeContext,
        ProductImagesToSitemapImagesCollectionGeneratorInterface $productToImageSitemapArrayGenerator
    ) {
        $this->productRepository = $productRepository;
        $this->router = $router;
        $this->urlFactory = $urlFactory;
        $this->urlAlternativeFactory = $urlAlternativeFactory;
        $this->localeContext = $localeContext;
        $this->productToImageSitemapArrayGenerator = $productToImageSitemapArrayGenerator;
    }

    public function getName(): string
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function generate(ChannelInterface $channel): iterable
    {
        $this->channel = $channel;
        $urls = [];
        $this->channelLocaleCodes = [];
        $channelDefaultLocaleCode = $this->getChannelDefaultLocaleCode($channel);
        $this->defaultLocaleCode = $channelDefaultLocaleCode ?? $this->localeContext->getLocaleCode();

        foreach ($this->getProducts() as $product) {
            $urls[] = $this->createProductUrl($product);
        }

        return $urls;
    }

    private function getTranslations(ProductInterface $product): Collection
    {
        return $product->getTranslations()->filter(function (TranslationInterface $translation): bool {
            return $this->localeInLocaleCodes($translation);
        });
    }

    private function localeInLocaleCodes(TranslationInterface $translation): bool
    {
        return \in_array($translation->getLocale(), $this->getLocaleCodes(), true);
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
            ->setParameter('channel', $this->channel)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getResult();
    }

    private function getLocaleCodes(): array
    {
        if ($this->channelLocaleCodes === []) {
            $this->channelLocaleCodes = $this->channel->getLocales()->map(function (LocaleInterface $locale): ?string {
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
        if ($updatedAt !== null) {
            $productUrl->setLastModification($updatedAt);
        }
        $productUrl->setImages($this->productToImageSitemapArrayGenerator->generate($product));

        /** @var ProductTranslationInterface $translation */
        foreach ($this->getTranslations($product) as $translation) {
            $localeCode = $translation->getLocale();

            if ($localeCode === null) {
                continue;
            }

            if (!$this->localeInLocaleCodes($translation)) {
                continue;
            }

            $location = $this->router->generate('sylius_shop_product_show', [
                'slug' => $translation->getSlug(),
                '_locale' => $translation->getLocale(),
            ]);

            if ($localeCode === $this->defaultLocaleCode) {
                $productUrl->setLocation($location);

                continue;
            }

            $productUrl->addAlternative($this->urlAlternativeFactory->createNew($location, $localeCode));
        }

        return $productUrl;
    }

    private function getChannelDefaultLocaleCode(ChannelInterface $channel): ?string
    {
        $channelDefaultLocale = $channel->getDefaultLocale();
        if ($channelDefaultLocale === null) {
            return null;
        }

        return $channelDefaultLocale->getCode();
    }
}
