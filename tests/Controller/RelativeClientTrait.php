<?php

namespace Tests\SitemapPlugin\Controller;

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
        $this->client = static::createClient(array('environment' => 'test_relative'), array('HTTP_ACCEPT' => 'application/xml'));
    }
}
