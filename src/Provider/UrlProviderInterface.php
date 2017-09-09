<?php

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
    public function generate(): array;

    /**
     * @return string
     */
    public function getName(): string;
}
