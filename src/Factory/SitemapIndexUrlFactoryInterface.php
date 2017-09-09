<?php declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapIndexUrlInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexUrlFactoryInterface
{
    /**
     * @return SitemapIndexUrlInterface
     */
    public function createNew(): SitemapIndexUrlInterface;
}
