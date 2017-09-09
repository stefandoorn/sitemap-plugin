<?php declare(strict_types=1);

namespace SitemapPlugin\Provider;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface UrlProviderInterface
{
    /**
     * @return array
     */
    public function generate(): iterable;

    /**
     * @return string
     */
    public function getName(): string;
}
