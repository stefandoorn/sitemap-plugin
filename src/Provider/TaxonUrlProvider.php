<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\AlternativeUrlFactoryInterface;
use SitemapPlugin\Factory\UrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxonomy\Model\TaxonTranslationInterface;
use Symfony\Component\Routing\RouterInterface;

final class TaxonUrlProvider implements UrlProviderInterface
{
    public function __construct(
        private readonly RepositoryInterface $taxonRepository,
        private readonly RouterInterface $router,
        private readonly UrlFactoryInterface $sitemapUrlFactory,
        private readonly AlternativeUrlFactoryInterface $urlAlternativeFactory,
        private readonly LocaleContextInterface $localeContext,
        private readonly bool $excludeTaxonRoot = true,
    ) {
    }

    public function getName(): string
    {
        return 'taxons';
    }

    public function generate(ChannelInterface $channel): iterable
    {
        $urls = [];

        foreach ($this->getTaxons() as $taxon) {
            /** @var TaxonInterface $taxon */
            if ($this->excludeTaxonRoot && $taxon->isRoot()) {
                continue;
            }

            $taxonUrl = $this->sitemapUrlFactory->createNew(''); // todo bypassing this new constructor right now
            $taxonUrl->setChangeFrequency(ChangeFrequency::always());
            $taxonUrl->setPriority(0.5);

            /** @var TaxonTranslationInterface $translation */
            foreach ($taxon->getTranslations() as $translation) {
                $location = $this->router->generate('sylius_shop_product_index', [
                    'slug' => $translation->getSlug(),
                    '_locale' => $translation->getLocale(),
                ]);

                if ($translation->getLocale() === $this->localeContext->getLocaleCode()) {
                    $taxonUrl->setLocation($location);

                    continue;
                }

                $locale = $translation->getLocale();
                if (null !== $locale) {
                    $taxonUrl->addAlternative($this->urlAlternativeFactory->createNew($location, $locale));
                }
            }

            $urls[] = $taxonUrl;
        }

        return $urls;
    }

    /**
     * @return TaxonInterface[]
     */
    private function getTaxons(): iterable
    {
        /** @var TaxonInterface[] $taxons */
        $taxons = $this->taxonRepository->findBy(['enabled' => true]);

        return $taxons;
    }
}
