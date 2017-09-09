<?php declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexFactoryInterface
{
    /**
     * @return SitemapInterface
     */
    public function createNew(): SitemapInterface;
}
