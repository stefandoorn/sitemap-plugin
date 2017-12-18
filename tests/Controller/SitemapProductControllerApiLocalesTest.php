<?php

namespace Tests\SitemapPlugin\Controller;

use Sylius\Component\Locale\Model\Locale;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapProductControllerApiLocalesTest extends SitemapProductControllerApiUniqueLocaleChannelTest
{
    use TearDownTrait;

    /**
     * @before
     */
    public function setUpDatabase()
    {
        parent::setUpDatabase();

        $localeRepository = $this->getEntityManager()->getRepository(Locale::class);

        $locale = $localeRepository->findOneBy(['code' => 'nl_NL']);

        $this->channel->addLocale($locale);

        $this->getEntityManager()->flush();
    }

    public function testShowActionResponse()
    {
        $this->client->request('GET', '/sitemap/products.xml');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'show_sitemap_products_locale');
    }
}
