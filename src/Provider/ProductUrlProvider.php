<?php declare(strict_types=1);

namespace SitemapPlugin\Provider;

use Doctrine\Common\Collections\Collection;
use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductTranslationInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
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
        /** @var ChannelInterface $channel */
        $channel = $this->channelContext->getChannel();

        $locales = $channel->getLocales();

        $localeCodes = $locales->map(function ($locale) {
            return $locale->getCode();
        })->toArray();

        $productTranslationsFilter = function ($translation) use ($localeCodes) {
            return in_array($translation->getLocale(), $localeCodes);
        };

        foreach ($this->getProducts() as $product) {
            $productUrl = $this->sitemapUrlFactory->createNew();
            $productUrl->setChangeFrequency(ChangeFrequency::always());
            $productUrl->setPriority(0.5);
            if ($product->getUpdatedAt()) {
                $productUrl->setLastModification($product->getUpdatedAt());
            }

            $translations = $product->getTranslations()->filter($productTranslationsFilter);

            /** @var ProductTranslationInterface $translation */
            foreach ($translations as $translation) {
                $location = $this->router->generate('sylius_shop_product_show', [
                    'slug' => $translation->getSlug(),
                    '_locale' => $translation->getLocale(),
                ]);

                if ($translation->getLocale() === $this->localeContext->getLocaleCode()) {
                    $productUrl->setLocalization($location);
                    continue;
                }

                if ($translation->getLocale()) {
                    $productUrl->addAlternative($location, $translation->getLocale());
                }
            }

            $this->urls[] = $productUrl;
        }

        return $this->urls;
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
}
