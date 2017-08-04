<?php

namespace Tests\SitemapPlugin\Controller;

use Sylius\Component\Core\Model\Taxon;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapStaticControllerApiTest extends AbstractTestController
{
    use TearDownTrait;

    public function testShowActionResponse()
    {
        $this->client->request('GET', '/sitemap/static.xml');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'show_sitemap_static');
    }
}
