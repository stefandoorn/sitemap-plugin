<?php declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapImageUrl;
use SitemapPlugin\Model\SitemapImageUrlInterface;

/**
 * @author Stéphane DECOCK <s.decock@behappycom.com>
 */
final class SitemapImageUrlFactory implements SitemapImageUrlFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNew(): SitemapImageUrlInterface
    {
        return new SitemapImageUrl();
    }
}
