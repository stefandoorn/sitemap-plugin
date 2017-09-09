<?php declare(strict_types=1);

namespace SitemapPlugin\Provider;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface IndexUrlProviderInterface
{
    /**
     * @return array
     */
    public function generate(): array;

    /**
     * @param UrlProviderInterface $provider
     */
    public function addProvider(UrlProviderInterface $provider): void;
}
