<?php declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapIndexInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexFactoryInterface
{
    /**
     * @return SitemapIndexInterface
     */
    public function createNew(): SitemapIndexInterface;
}
