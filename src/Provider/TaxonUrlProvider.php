<?php declare(strict_types=1);

namespace SitemapPlugin\Provider;

use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Resource\Model\TranslationInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxonomy\Model\TaxonTranslationInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class TaxonUrlProvider implements UrlProviderInterface
{
    /**
     * @var RepositoryInterface
     */
    private $taxonRepository;

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
     * @var bool
     */
    private $excludeTaxonRoot = true;

    /**
     * TaxonUrlProvider constructor.
     * @param RepositoryInterface $taxonRepository
     * @param RouterInterface $router
     * @param SitemapUrlFactoryInterface $sitemapUrlFactory
     * @param LocaleContextInterface $localeContext
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

    /**
     * @return string
     */
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

            foreach ($taxon->getTranslations() as $translation) {
                /** @var TranslationInterface|TaxonTranslationInterface $translation */
                $location = $this->router->generate('sylius_shop_product_index', [
                    'slug' => $translation->getSlug(),
                    '_locale' => $translation->getLocale(),
                ]);

                if ($translation->getLocale() === $this->localeContext->getLocaleCode()) {
                    $taxonUrl->setLocalization($location);
                } else {
                    $taxonUrl->addAlternative($location, $translation->getLocale());
                }
            }

            $this->urls[] = $taxonUrl;
        }

        return $this->urls;
    }

    /**
     * @return array|TaxonInterface[]
     */
    private function getTaxons(): iterable
    {
        return $this->taxonRepository->findAll();
    }
}
