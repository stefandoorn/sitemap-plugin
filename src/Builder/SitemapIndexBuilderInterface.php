<?php declare(strict_types=1);

namespace SitemapPlugin\Builder;

use SitemapPlugin\Model\SitemapIndexInterface;
use SitemapPlugin\Provider\IndexUrlProviderInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexBuilderInterface extends BuilderInterface
{
    /**
     * @param IndexUrlProviderInterface $provider
     */
    public function addIndexProvider(IndexUrlProviderInterface $provider): void;

    /**
     * @return SitemapIndexInterface
     */
    public function build(): SitemapIndexInterface;
}
