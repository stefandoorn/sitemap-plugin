<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\AlternativeUrlFactoryInterface;
use SitemapPlugin\Factory\UrlFactoryInterface;
use SitemapPlugin\Generator\TaxonImagesToSitemapImagesCollectionGeneratorInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Component\Core\Model\ChannelInterface;
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

    /** @var UrlFactoryInterface */
    private $sitemapUrlFactory;

    /** @var AlternativeUrlFactoryInterface */
    private $urlAlternativeFactory;

    /** @var LocaleContextInterface */
    private $localeContext;

    /** @var array */
    private $urls = [];

    /** @var bool */
    private $excludeTaxonRoot = true;

    /** @var TaxonImagesToSitemapImagesCollectionGeneratorInterface */
    private $taxonImagesToSitemapImagesCollectionGenerator;

    /** @var bool */
    private $generateImagesUrls = true;

    public function __construct(
        RepositoryInterface $taxonRepository,
        RouterInterface $router,
        UrlFactoryInterface $sitemapUrlFactory,
        AlternativeUrlFactoryInterface $urlAlternativeFactory,
        LocaleContextInterface $localeContext,
        bool $excludeTaxonRoot,
        TaxonImagesToSitemapImagesCollectionGeneratorInterface $taxonImagesToSitemapImagesCollectionGenerator,
        bool $generateImagesUrls = true
    ) {
        $this->taxonRepository = $taxonRepository;
        $this->router = $router;
        $this->sitemapUrlFactory = $sitemapUrlFactory;
        $this->urlAlternativeFactory = $urlAlternativeFactory;
        $this->localeContext = $localeContext;
        $this->excludeTaxonRoot = $excludeTaxonRoot;
        $this->taxonImagesToSitemapImagesCollectionGenerator = $taxonImagesToSitemapImagesCollectionGenerator;
        $this->generateImagesUrls = $generateImagesUrls;
    }

    public function getName(): string
    {
        return 'taxons';
    }

    public function generate(ChannelInterface $channel): iterable
    {
        $this->urls = [];

        foreach ($this->getTaxons() as $taxon) {
            /** @var TaxonInterface $taxon */
            if ($this->excludeTaxonRoot && $taxon->isRoot()) {
                continue;
            }

            $taxonUrl = $this->sitemapUrlFactory->createNew(''); // todo bypassing this new constructor right now
            $taxonUrl->setChangeFrequency(ChangeFrequency::always());
            $taxonUrl->setPriority(0.5);

            if ($this->generateImagesUrls) {
                $taxonUrl->setImages($this->taxonImagesToSitemapImagesCollectionGenerator->generate($taxon));
            }

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
                if ($locale) {
                    $taxonUrl->addAlternative($this->urlAlternativeFactory->createNew($location, $locale));
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
