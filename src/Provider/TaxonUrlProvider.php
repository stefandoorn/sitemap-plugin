<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxonomy\Model\TaxonTranslationInterface;
use Symfony\Component\Routing\RouterInterface;

final class TaxonUrlProvider implements UrlProviderInterface
{
    /** @var RepositoryInterface */
    private $taxonRepository;

    /** @var RouterInterface */
    private $router;

    /** @var SitemapUrlFactoryInterface */
    private $sitemapUrlFactory;

    /** @var LocaleContextInterface */
    private $localeContext;

    /** @var array */
    private $urls = [];

    /** @var bool */
    private $excludeTaxonRoot = true;

    /**
     * TaxonUrlProvider constructor.
     *
     * @param bool $excludeTaxonRoot
     */
    public function __construct(
        RepositoryInterface $taxonRepository,
        RouterInterface $router,
        SitemapUrlFactoryInterface $sitemapUrlFactory,
        LocaleContextInterface $localeContext,
        $excludeTaxonRoot
    ) {
        $this->taxonRepository = $taxonRepository;
        $this->router = $router;
        $this->sitemapUrlFactory = $sitemapUrlFactory;
        $this->localeContext = $localeContext;
        $this->excludeTaxonRoot = $excludeTaxonRoot;
    }

    public function getName(): string
    {
        return 'taxons';
    }

    /**
     * {@inheritdoc}
     */
    public function generate(): iterable
    {
        foreach ($this->getTaxons() as $taxon) {
            /** @var TaxonInterface $taxon */
            if ($this->excludeTaxonRoot && $taxon->isRoot()) {
                continue;
            }

            $taxonUrl = $this->sitemapUrlFactory->createNew();
            $taxonUrl->setChangeFrequency(ChangeFrequency::always());
            $taxonUrl->setPriority(0.5);

            /** @var TaxonTranslationInterface $translation */
            foreach ($taxon->getTranslations() as $translation) {
                $location = $this->router->generate('sylius_shop_product_index', [
                    'slug' => $translation->getSlug(),
                    '_locale' => $translation->getLocale(),
                ]);

                if ($translation->getLocale() === $this->localeContext->getLocaleCode()) {
                    $taxonUrl->setLocalization($location);

                    continue;
                }

                if ($translation->getLocale()) {
                    $taxonUrl->addAlternative($location, $translation->getLocale());
                }
            }

            $this->urls[] = $taxonUrl;
        }

        return $this->urls;
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
