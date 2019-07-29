<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Provider;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;
use PhpSpec\ObjectBehavior;
use SitemapPlugin\Factory\AlternativeUrlFactoryInterface;
use SitemapPlugin\Factory\UrlFactoryInterface;
use SitemapPlugin\Generator\ProductImagesToSitemapImagesCollectionGeneratorInterface;
use SitemapPlugin\Model\AlternativeUrlInterface;
use SitemapPlugin\Model\ChangeFrequency;
use SitemapPlugin\Model\UrlInterface;
use SitemapPlugin\Provider\ProductUrlProvider;
use SitemapPlugin\Provider\UrlProviderInterface;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ProductImageInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductTranslation;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Model\LocaleInterface;
use Symfony\Component\Routing\RouterInterface;

final class ProductUrlProviderSpec extends ObjectBehavior
{
    function let(
        ProductRepository $repository,
        RouterInterface $router,
        UrlFactoryInterface $urlFactory,
        AlternativeUrlFactoryInterface $alternativeUrlFactory,
        LocaleContextInterface $localeContext,
        ProductImagesToSitemapImagesCollectionGeneratorInterface $productToImageSitemapArrayGenerator
    ): void {
        $this->beConstructedWith($repository, $router, $urlFactory, $alternativeUrlFactory, $localeContext, $productToImageSitemapArrayGenerator);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(ProductUrlProvider::class);
    }

    function it_implements_provider_interface(): void
    {
        $this->shouldImplement(UrlProviderInterface::class);
    }

    function it_generates_urls_for_the_unique_channel_locale(
        ProductRepository $repository,
        RouterInterface $router,
        UrlFactoryInterface $urlFactory,
        AlternativeUrlFactoryInterface $alternativeUrlFactory,
        LocaleContextInterface $localeContext,
        LocaleInterface $locale,
        Collection $products,
        \Iterator $iterator,
        ProductInterface $product,
        ProductImageInterface $productImage,
        ProductTranslation $productEnUSTranslation,
        ProductTranslation $productNlNLTranslation,
        UrlInterface $url,
        AlternativeUrlInterface $alternativeUrl,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        ChannelInterface $channel,
        ProductImagesToSitemapImagesCollectionGeneratorInterface $productToImageSitemapArrayGenerator
    ): void {
        $now = new \DateTime();

        $localeContext->getLocaleCode()->willReturn('en_US');

        $locale->getCode()->willReturn('en_US');

        $channel->getLocales()->shouldBeCalled()->willReturn(new ArrayCollection([
            $locale->getWrappedObject(),
        ]));

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

        $iterator->current()->willReturn($product);

        $productImage->getPath()->willReturn(null);

        $product->getUpdatedAt()->willReturn($now);
        $product->getImages()->willReturn(new ArrayCollection([
            $productImage->getWrappedObject(),
        ]));

        $sitemapImageCollection = new ArrayCollection([]);

        $productToImageSitemapArrayGenerator->generate($product)->willReturn($sitemapImageCollection);

        $productEnUSTranslation->getLocale()->willReturn('en_US');
        $productEnUSTranslation->getSlug()->willReturn('t-shirt');

        $productNlNLTranslation->getLocale()->willReturn('nl_NL');
        $productNlNLTranslation->getSlug()->willReturn('t-shirt');

        $product->getTranslations()->shouldBeCalled()->willReturn(new ArrayCollection([
            $productEnUSTranslation->getWrappedObject(),
            $productNlNLTranslation->getWrappedObject(),
        ]));

        $router->generate('sylius_shop_product_show', [
            'slug' => 't-shirt',
            '_locale' => 'en_US',
        ])->willReturn('http://sylius.org/en_US/products/t-shirt');

        $urlFactory->createNew('')->willReturn($url);
        $alternativeUrlFactory->createNew('')->willReturn($alternativeUrl);

        $url->setImages($sitemapImageCollection)->shouldBeCalled();
        $url->setLocation('http://sylius.org/en_US/products/t-shirt')->shouldBeCalled();
        $url->setLocation('http://sylius.org/nl_NL/products/t-shirt')->shouldNotBeCalled();
        $url->setLastModification($now)->shouldBeCalled();
        $url->setChangeFrequency(ChangeFrequency::always())->shouldBeCalled();
        $url->setPriority(0.5)->shouldBeCalled();

        $url->addAlternative($alternativeUrl)->shouldNotBeCalled();

        $this->generate($channel);
    }

    function it_generates_urls_for_all_channel_locales(
        ProductRepository $repository,
        RouterInterface $router,
        UrlFactoryInterface $urlFactory,
        AlternativeUrlFactoryInterface $alternativeUrlFactory,
        LocaleContextInterface $localeContext,
        LocaleInterface $enUSLocale,
        LocaleInterface $nlNLLocale,
        Collection $products,
        \Iterator $iterator,
        ProductInterface $product,
        ProductImageInterface $productImage,
        ProductTranslation $productEnUSTranslation,
        ProductTranslation $productNlNLTranslation,
        UrlInterface $url,
        AlternativeUrlInterface $alternativeUrl,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        ChannelInterface $channel,
        ProductImagesToSitemapImagesCollectionGeneratorInterface $productToImageSitemapArrayGenerator
    ): void {
        $now = new \DateTime();

        $localeContext->getLocaleCode()->willReturn('en_US');

        $enUSLocale->getCode()->willReturn('en_US');
        $nlNLLocale->getCode()->willReturn('nl_NL');

        $channel->getLocales()->shouldBeCalled()->willReturn(new ArrayCollection([
            $enUSLocale->getWrappedObject(),
            $nlNLLocale->getWrappedObject(),
        ]));

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

        $iterator->current()->willReturn($product);

        $productImage->getPath()->willReturn(null);

        $product->getUpdatedAt()->willReturn($now);
        $product->getImages()->willReturn(new ArrayCollection([
            $productImage->getWrappedObject(),
        ]));

        $sitemapImageCollection = new ArrayCollection([]);

        $productToImageSitemapArrayGenerator->generate($product)->willReturn($sitemapImageCollection);

        $productEnUSTranslation->getLocale()->willReturn('en_US');
        $productEnUSTranslation->getSlug()->willReturn('t-shirt');

        $productNlNLTranslation->getLocale()->willReturn('nl_NL');
        $productNlNLTranslation->getSlug()->willReturn('t-shirt');

        $product->getTranslations()->shouldBeCalled()->willReturn(new ArrayCollection([
            $productEnUSTranslation->getWrappedObject(),
            $productNlNLTranslation->getWrappedObject(),
        ]));

        $router->generate('sylius_shop_product_show', [
            'slug' => 't-shirt',
            '_locale' => 'en_US',
        ])->willReturn('http://sylius.org/en_US/products/t-shirt');

        $router->generate('sylius_shop_product_show', [
            'slug' => 't-shirt',
            '_locale' => 'nl_NL',
        ])->shouldBeCalled()->willReturn('http://sylius.org/nl_NL/products/t-shirt');

        $urlFactory->createNew('')->willReturn($url);
        $alternativeUrlFactory->createNew('http://sylius.org/nl_NL/products/t-shirt', 'nl_NL')->willReturn($alternativeUrl);

        $url->setImages($sitemapImageCollection)->shouldBeCalled();
        $url->setLocation('http://sylius.org/en_US/products/t-shirt')->shouldBeCalled();
        $url->setLocation('http://sylius.org/nl_NL/products/t-shirt')->shouldNotBeCalled();
        $url->setLastModification($now)->shouldBeCalled();
        $url->setChangeFrequency(ChangeFrequency::always())->shouldBeCalled();
        $url->setPriority(0.5)->shouldBeCalled();

        $url->addAlternative($alternativeUrl)->shouldBeCalled();

        $this->generate($channel);
    }
}
