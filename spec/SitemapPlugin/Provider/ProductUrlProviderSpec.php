<?php

namespace spec\SitemapPlugin\Provider;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;
use PhpSpec\ObjectBehavior;
use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use SitemapPlugin\Model\SitemapUrlInterface;
use SitemapPlugin\Provider\ProductUrlProvider;
use SitemapPlugin\Provider\UrlProviderInterface;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductTranslation;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class ProductUrlProviderSpec extends ObjectBehavior
{
    function let(
        ProductRepository $repository,
        RouterInterface $router,
        SitemapUrlFactoryInterface $sitemapUrlFactory,
        LocaleContextInterface $localeContext,
        ChannelContextInterface $channelContext
    ): void {
        $this->beConstructedWith($repository, $router, $sitemapUrlFactory, $localeContext, $channelContext);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(ProductUrlProvider::class);
    }

    function it_implements_provider_interface(): void
    {
        $this->shouldImplement(UrlProviderInterface::class);
    }

    function it_generates_urls(
        $repository,
        $router,
        $sitemapUrlFactory,
        $localeContext,
        $channelContext,
        Collection $translations,
        Collection $products,
        \Iterator $iterator,
        \Iterator $iteratorTranslations,
        ProductInterface $product,
        ProductTranslation $productTranslation,
        SitemapUrlInterface $sitemapUrl,
        \DateTime $now,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        ChannelInterface $channel
    ): void {
        $localeContext->getLocaleCode()->willReturn('en_US');
        $channelContext->getChannel()->willReturn($channel);

        $repository->createQueryBuilder('o')->willReturn($queryBuilder);
        $queryBuilder->addSelect('translation')->willReturn($queryBuilder);
        $queryBuilder->innerJoin('o.translations', 'translation')->willReturn($queryBuilder);
        $queryBuilder->andWhere(':channel MEMBER OF o.channels')->willReturn($queryBuilder);
        $queryBuilder->andWhere('o.enabled = :enabled')->willReturn($queryBuilder);
        $queryBuilder->setParameter('channel', $channel)->willReturn($queryBuilder);
        $queryBuilder->setParameter('enabled', true)->willReturn($queryBuilder);
        $queryBuilder->getQuery()->willReturn($query);
        $query->getResult()->willReturn($products);

        $products->getIterator()->willReturn($iterator);
        $iterator->valid()->willReturn(true, false);
        $iterator->next()->shouldBeCalled();
        $iterator->rewind()->shouldBeCalled();

        $translations->getIterator()->willReturn($iteratorTranslations);
        $iteratorTranslations->valid()->willReturn(true, false);
        $iteratorTranslations->next()->shouldBeCalled();
        $iteratorTranslations->rewind()->shouldBeCalled();
        $iteratorTranslations->current()->willReturn($productTranslation);

        $iterator->current()->willReturn($product);
        $product->getUpdatedAt()->willReturn($now);

        $productTranslation->getLocale()->willReturn('en_US');
        $productTranslation->getSlug()->willReturn('t-shirt');
        $product->getTranslations()->willReturn($translations);

        $router->generate('sylius_shop_product_show',
            ['slug' => 't-shirt', '_locale' => 'en_US'])->willReturn('http://sylius.org/en_US/products/t-shirt');
        $router->generate($product, [], true)->willReturn('http://sylius.org/en_US/products/t-shirt');
        $sitemapUrlFactory->createNew()->willReturn($sitemapUrl);

        $sitemapUrl->setLocalization('http://sylius.org/en_US/products/t-shirt')->shouldBeCalled();
        $sitemapUrl->setLastModification($now)->shouldBeCalled();
        $sitemapUrl->setChangeFrequency(ChangeFrequency::always())->shouldBeCalled();
        $sitemapUrl->setPriority(0.5)->shouldBeCalled();

        $this->generate();
    }
}
