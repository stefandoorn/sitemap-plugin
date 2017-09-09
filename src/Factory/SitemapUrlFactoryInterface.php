<?php declare(strict_types=1);

namespace SitemapPlugin\Factory;

use SitemapPlugin\Model\SitemapUrlInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapUrlFactoryInterface
{
    /**
     * @return SitemapUrlInterface
     */
    public function createNew(): SitemapUrlInterface;
}
