<?php

namespace spec\SitemapPlugin\Provider;

use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository;
use SitemapPlugin\Factory\SitemapUrlFactoryInterface;
use SitemapPlugin\Model\ChangeFrequency;
use SitemapPlugin\Model\SitemapUrlInterface;
use SitemapPlugin\Provider\ProductUrlProvider;
use SitemapPlugin\Provider\UrlProviderInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Core\Model\ProductTranslation;
use Sylius\Component\Core\Model\ProductTranslationInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class ProductUrlProviderSpec extends ObjectBehavior
{
    function let(ProductRepository $repository, RouterInterface $router, SitemapUrlFactoryInterface $sitemapUrlFactory, LocaleContextInterface $localeContext)
    {
        $this->beConstructedWith($repository, $router, $sitemapUrlFactory, $localeContext);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProductUrlProvider::class);
    }

    function it_implements_provider_interface()
    {
        $this->shouldImplement(UrlProviderInterface::class);
    }

    function it_generates_urls(
        $repository,
        $router,
        $sitemapUrlFactory,
        $localeContext,
        Collection $translations,
        Collection $products,
        \Iterator $iterator,
        \Iterator $iteratorTranslations,
        ProductInterface $product,
        ProductTranslation $productTranslation,
        SitemapUrlInterface $sitemapUrl,
        \DateTime $now
    ) {
        $localeContext->getLocaleCode()->willReturn('en_US');

        $repository->findBy(['enabled' => true])->willReturn($products);
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

        $router->generate('sylius_shop_product_show', ['slug' => 't-shirt', '_locale' => 'en_US'])->willReturn('http://sylius.org/en_US/products/t-shirt');
        $router->generate($product, [], true)->willReturn('http://sylius.org/en_US/products/t-shirt');
        $sitemapUrlFactory->createNew()->willReturn($sitemapUrl);

        $sitemapUrl->setLocalization('http://sylius.org/en_US/products/t-shirt')->shouldBeCalled();
        $sitemapUrl->setLastModification($now)->shouldBeCalled();
        $sitemapUrl->setChangeFrequency(ChangeFrequency::always())->shouldBeCalled();
        $sitemapUrl->setPriority(0.5)->shouldBeCalled();

        $this->generate();
    }
}
