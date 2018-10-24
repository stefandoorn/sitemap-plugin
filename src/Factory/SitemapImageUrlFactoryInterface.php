<?php declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapImageUrlInterface;

/**
 * @author Stéphane DECOCK <s.decock@behappycom.com>
 */
interface SitemapImageUrlFactoryInterface
{
    /**
     * @return SitemapImageUrlInterface
     */
    public function createNew(): SitemapImageUrlInterface;
}
