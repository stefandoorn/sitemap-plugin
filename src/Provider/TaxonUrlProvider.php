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
    private RepositoryInterface $taxonRepository;

    private RouterInterface $router;

    private UrlFactoryInterface $sitemapUrlFactory;

    private AlternativeUrlFactoryInterface $urlAlternativeFactory;

    private LocaleContextInterface $localeContext;

    private bool $excludeTaxonRoot;

    public function __construct(
        RepositoryInterface $taxonRepository,
        RouterInterface $router,
        UrlFactoryInterface $sitemapUrlFactory,
        AlternativeUrlFactoryInterface $urlAlternativeFactory,
        LocaleContextInterface $localeContext,
        bool $excludeTaxonRoot = true
    ) {
        $this->taxonRepository = $taxonRepository;
        $this->router = $router;
        $this->sitemapUrlFactory = $sitemapUrlFactory;
        $this->urlAlternativeFactory = $urlAlternativeFactory;
        $this->localeContext = $localeContext;
        $this->excludeTaxonRoot = $excludeTaxonRoot;
    }

    public function getName(): string
    {
        return 'taxons';
    }

    public function generate(ChannelInterface $channel): array
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
        $taxons = $this->taxonRepository->findAll();

        return $taxons;
    }
}
