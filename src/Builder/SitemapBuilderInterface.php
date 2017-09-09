<?php declare(strict_types=1);

namespace SitemapPlugin\Builder;

use SitemapPlugin\Model\SitemapInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapBuilderInterface extends BuilderInterface
{
    /**
     * @return SitemapInterface
     */
    public function build(array $filter = []): SitemapInterface;

    /**
     * @return array
     */
    public function getProviders(): iterable;
}
