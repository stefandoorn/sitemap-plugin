<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Provider\Data;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;
use PhpSpec\ObjectBehavior;
use SitemapPlugin\Provider\Data\ProductDataProvider;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository;
use Sylius\Component\Core\Model\ChannelInterface;

final class ProductDataProviderSpec extends ObjectBehavior
{
    function let(
        ProductRepository $repository,
    ): void {
        $this->beConstructedWith($repository);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(ProductDataProvider::class);
    }

    function it_provides_data(
        ProductRepository $repository,
        Collection $products,
        QueryBuilder $queryBuilder,
        AbstractQuery $query,
        ChannelInterface $channel,
    ): void {
        $repository->createQueryBuilder('o')->willReturn($queryBuilder);
        $queryBuilder->addSelect('translation')->willReturn($queryBuilder);
        $queryBuilder->innerJoin('o.translations', 'translation')->willReturn($queryBuilder);
        $queryBuilder->andWhere(':channel MEMBER OF o.channels')->willReturn($queryBuilder);
        $queryBuilder->andWhere('o.enabled = :enabled')->willReturn($queryBuilder);
        $queryBuilder->setParameter('channel', $channel)->willReturn($queryBuilder);
        $queryBuilder->setParameter('enabled', true)->willReturn($queryBuilder);
        $queryBuilder->getQuery()->willReturn($query);
        $query->getResult()->willReturn($products);

        $this->get($channel)->shouldReturn($products);
    }
}
