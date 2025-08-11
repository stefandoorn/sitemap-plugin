<?php

declare(strict_types=1);

namespace SitemapPlugin\Provider\Data;

use Sylius\Bundle\TaxonomyBundle\Doctrine\ORM\TaxonRepository;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\TaxonInterface;

final class TaxonDataProvider implements TaxonDataProviderInterface
{
    public function __construct(
        private readonly TaxonRepository $repository,
    ) {
    }

    /**
     * @return array|TaxonInterface[]
     */
    public function get(ChannelInterface $channel): iterable
    {
        return $this->repository->findBy(['enabled' => true]);
    }
}
