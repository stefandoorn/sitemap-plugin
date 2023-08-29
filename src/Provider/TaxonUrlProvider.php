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
    public function getCountryCodeByLocale(string $locale): string {
       return $locale == 'en_US'?'us': explode("_",$locale)[0];
    }
    public function generate(ChannelInterface $channel): iterable
    {
        $urls = [];

        foreach ($this->findTaxonsWithProducts() as $taxon) {
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
                    'countryCode'=>$this->getCountryCodeByLocale($translation->getLocale())
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
    public function findTaxonsWithProducts()
    {  
        $qb = $this->taxonRepository->createQueryBuilder('t');
        $qb
            ->select('t')
            ->join('Sylius\Component\Core\Model\ProductTaxon', 'pt', 'WITH', 't.id = pt.taxon')
            ->where('t.enabled = true')
            ->groupBy('t.id')
            ->having($qb->expr()->gt($qb->expr()->count('pt.product'), 0));

        return $qb->getQuery()->getResult();
    }

}
