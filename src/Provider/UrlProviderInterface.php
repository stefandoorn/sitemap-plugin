<?php

namespace SyliusSitemapBundle\Provider;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
interface UrlProviderInterface
{
    /**
     * @return array
     */
    public function generate();
}
