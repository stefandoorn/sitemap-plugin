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
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class ProductUrlProviderSpec extends ObjectBehavior
{
    function let(ProductRepository $repository, RouterInterface $router, SitemapUrlFactoryInterface $sitemapUrlFactory)
    {
        $this->beConstructedWith($repository, $router, $sitemapUrlFactory);
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
        Collection $products,
        \Iterator $iterator,
        ProductInterface $product,
        SitemapUrlInterface $sitemapUrl,
        \DateTime $now
    ) {
        $repository->findBy(['enabled'])->willReturn($products);
        $products->getIterator()->willReturn($iterator);
        $iterator->valid()->willReturn(true, false);
        $iterator->next()->shouldBeCalled();
        $iterator->rewind()->shouldBeCalled();

        $iterator->current()->willReturn($product);
        $product->getUpdatedAt()->willReturn($now);

        $product->getSlug()->willReturn('t-shirt');

        $router->generate('sylius_shop_product_show', ['slug' => 't-shirt'], true)->willReturn('http://sylius.org/products/t-shirt');
        $router->generate($product, [], true)->willReturn('http://sylius.org/products/t-shirt');
        $sitemapUrlFactory->createNew()->willReturn($sitemapUrl);

        $sitemapUrl->setLocalization('http://sylius.org/products/t-shirt')->shouldBeCalled();
        $sitemapUrl->setLastModification($now)->shouldBeCalled();
        $sitemapUrl->setChangeFrequency(ChangeFrequency::always())->shouldBeCalled();
        $sitemapUrl->setPriority(0.5)->shouldBeCalled();

        $this->generate();
    }
}
