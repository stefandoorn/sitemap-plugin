<?php declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapIndex;
use SitemapPlugin\Model\SitemapIndexInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
final class SitemapIndexFactory implements SitemapIndexFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew(): SitemapIndexInterface
    {
        return new SitemapIndex();
    }
}
