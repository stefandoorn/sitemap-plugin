<?php

namespace SyliusSitemapBundle\Provider;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface IndexUrlProviderInterface
{
    /**
     * @return array
     */
    public function generate();
}
