<?php declare(strict_types=1);

namespace SitemapPlugin\Provider;

use Doctrine\Common\Collections\Collection;
use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use SitemapPlugin\Model\SitemapUrlInterface;
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

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class ProductUrlProvider implements UrlProviderInterface
{
    /**
     * @var ProductRepositoryInterface|EntityRepository
     */
    private $productRepository;

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
     * @var ChannelContextInterface
     */
    private $channelContext;

    /**
     * @var array
     */
    private $urls = [];

    /**
     * @var array
     */
    private $channelLocaleCodes;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param RouterInterface $router
     * @param SitemapUrlFactoryInterface $sitemapUrlFactory
     * @param LocaleContextInterface $localeContext
     * @param ChannelContextInterface $channelContext
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        RouterInterface $router,
        SitemapUrlFactoryInterface $sitemapUrlFactory,
        LocaleContextInterface $localeContext,
        ChannelContextInterface $channelContext
    ) {
        $this->productRepository = $productRepository;
        $this->router = $router;
        $this->sitemapUrlFactory = $sitemapUrlFactory;
        $this->localeContext = $localeContext;
        $this->channelContext = $channelContext;
    }

    /**
     * @return string
     */
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
     * @param ProductInterface $product
     * @return Collection|ProductTranslationInterface[]
     */
    private function getTranslations(ProductInterface $product): Collection
    {
        return $product->getTranslations()->filter(function (TranslationInterface $translation) {
            return $this->localeInLocaleCodes($translation);
        });
    }

    /**
     * @param TranslationInterface $translation
     * @return bool
     */
    private function localeInLocaleCodes(TranslationInterface $translation): bool
    {
        return in_array($translation->getLocale(), $this->getLocaleCodes());
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

    /**
     * @return array
     */
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

    /**
     * @param ProductInterface $product
     * @return SitemapUrlInterface
     */
    private function createProductUrl(ProductInterface $product): SitemapUrlInterface
    {
        $productUrl = $this->sitemapUrlFactory->createNew();
        $productUrl->setChangeFrequency(ChangeFrequency::always());
        $productUrl->setPriority(0.5);
        if ($product->getUpdatedAt()) {
            $productUrl->setLastModification($product->getUpdatedAt());
        }

        /** @var ProductTranslationInterface $translation */
        foreach ($this->getTranslations($product) as $translation) {
            if (!$translation->getLocale()) {
                continue;
            }

            if (!$this->localeInLocaleCodes($translation)) {
                continue;
            }

            $location = $this->router->generate('sylius_shop_product_show', [
                'slug' => $translation->getSlug(),
                '_locale' => $translation->getLocale(),
            ]);

            if ($translation->getLocale() === $this->localeContext->getLocaleCode()) {
                $productUrl->setLocalization($location);
                continue;
            }

            $productUrl->addAlternative($location, $translation->getLocale());
        }

        return $productUrl;
    }
}
