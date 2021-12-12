<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

final class SitemapIndexControllerApiTest extends XmlApiTestCase
{
    protected function setUp(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml']);
        $this->generateSitemaps();
    }

    public function testRedirectActionResponse()
    {
        $response = $this->getBufferedResponse('/sitemap.xml');
        self::assertResponseRedirects('http://localhost/sitemap_index.xml', 301);
        $this->deleteSitemaps();
    }

    public function testShowActionResponse()
    {
        $response = $this->getBufferedResponse('/sitemap_index.xml');
        $this->assertResponse($response, 'show_sitemap_index');
        $this->deleteSitemaps();
    }

    public function testRedirectResponse()
    {
        $response = $this->getBufferedResponse('/sitemap.xml');

        $this->assertResponseCode($response, 301);
        $this->assertTrue($response->isRedirect());

        $location = $response->headers->get('Location');
        $this->assertStringContainsString('sitemap_index.xml', $location);
        $this->deleteSitemaps();
    }
}
