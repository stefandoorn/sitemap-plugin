<?php

namespace Tests\SitemapPlugin\Controller;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
trait RelativeClientTrait
{
    /**
     * @beforeClass
     */
    public static function createSharedKernel()
    {
        static::$sharedKernel = static::createKernel(['debug' => false, 'environment' => 'test_relative']);
        static::$sharedKernel->boot();
    }

    /**
     * @before
     */
    public function setUpClient()
    {
        $this->client = static::createClient(array('environment' => 'test_relative'), []);
    }
}
