<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use Doctrine\Common\Collections\Collection;
use SitemapPlugin\Factory\AlternativeUrlFactoryInterface;
use SitemapPlugin\Factory\UrlFactoryInterface;
use SitemapPlugin\Generator\ProductImagesToSitemapImagesCollectionGeneratorInterface;
use SitemapPlugin\Model\ChangeFrequency;
use SitemapPlugin\Model\UrlInterface;
use SitemapPlugin\Provider\Data\ProductDataProviderInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductTranslationInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Model\TranslationInterface;
use Symfony\Component\Routing\RouterInterface;

final class ProductUrlProvider implements UrlProviderInterface
{
    private ChannelInterface $channel;

    /** @var array<string|null> */
    private array $channelLocaleCodes;

    public function __construct(
        private readonly ProductDataProviderInterface $dataProvider,
        private readonly RouterInterface $router,
        private readonly UrlFactoryInterface $urlFactory,
        private readonly AlternativeUrlFactoryInterface $urlAlternativeFactory,
        private readonly LocaleContextInterface $localeContext,
        private readonly ProductImagesToSitemapImagesCollectionGeneratorInterface $productToImageSitemapArrayGenerator,
    ) {
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
        $this->channelLocaleCodes = [];

        $urls = [];
        foreach ($this->dataProvider->get($channel) as $product) {
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
            $locale = $translation->getLocale();

            if ($locale === null) {
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
