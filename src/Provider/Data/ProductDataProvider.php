<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider\Data;

use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ProductInterface;

final class ProductDataProvider implements ProductDataProviderInterface
{
    public function __construct(
        private readonly ProductRepository $repository,
    ) {
    }

    /**
     * @return array|ProductInterface[]
     */
    public function get(ChannelInterface $channel): iterable
    {
        return $this->repository->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin('o.translations', 'translation')
            ->andWhere(':channel MEMBER OF o.channels')
            ->andWhere('o.enabled = :enabled')
            ->setParameter('channel', $channel)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getResult()
        ;
    }
}
