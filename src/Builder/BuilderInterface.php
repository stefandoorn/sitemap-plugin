<?php declare(strict_types=1);

namespace SitemapPlugin\Builder;

use SitemapPlugin\Provider\UrlProviderInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface BuilderInterface
{
    /**
     * @param UrlProviderInterface $provider
     */
    public function addProvider(UrlProviderInterface $provider): void;
}