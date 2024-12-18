<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SitemapIndexMissingControllerApiTest extends XmlApiTestCase
{
    protected function setUp(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml']);
        $this->deleteSitemaps();
    }

    public function testShowActionResponse()
    {
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage('File "US_WEB/sitemap_index.xml" not found');

        try {
            $this->getResponse('/sitemap_index.xml');
        } finally {
            \ob_end_clean();
        }
    }
}
