<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

final class SitemapStaticControllerApiTest extends AbstractTestController
{
    use TearDownTrait;

    public function setUpDatabase()
    {
        parent::setUpDatabase();

        $this->generateSitemaps();
    }

    public function testShowActionResponse()
    {
        $response = $this->getResponse('/sitemap/static.xml');

        $this->assertResponse($response, 'show_sitemap_static');
    }
}
