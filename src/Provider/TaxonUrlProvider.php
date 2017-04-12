<?php

namespace SitemapPlugin\Provider;

use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
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
     * @var array
     */
    private $urls = [];

    /**
     * @param RepositoryInterface $taxonRepository
     * @param RouterInterface $router
     * @param SitemapUrlFactoryInterface $sitemapUrlFactory
     */
    public function __construct(
        RepositoryInterface $taxonRepository,
        RouterInterface $router,
        SitemapUrlFactoryInterface $sitemapUrlFactory
    ) {
        $this->taxonRepository = $taxonRepository;
        $this->router = $router;
        $this->sitemapUrlFactory = $sitemapUrlFactory;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'taxons';
    }

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $taxons = $this->taxonRepository->findAll();

        foreach ($taxons as $taxon) {
            /** @var TaxonInterface $product */
            $taxonUrl = $this->sitemapUrlFactory->createNew();
            $localization = $this->router->generate('sylius_shop_product_index', ['slug' => $taxon->getSlug()], true);

            $taxonUrl->setLocalization($localization);
            $taxonUrl->setChangeFrequency(ChangeFrequency::always());
            $taxonUrl->setPriority(0.5);

            $this->urls[] = $taxonUrl;
        }

        return $this->urls;
    }
}
