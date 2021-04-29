<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

use Sylius\Component\Core\Model\Channel;

final class MultiChannelSitemapStaticControllerApiTest extends AbstractTestController
{
    use TearDownTrait;

    /** @var ChannelInterface */
    protected $channel2;

    /**
     * @before
     */
    public function setUpDatabase(): void
    {
        parent::setUpDatabase();
        $this->channel->setHostname('localhost');

        $this->channel2 = new Channel();
        $this->channel2->setCode('FR_WEB');
        $this->channel2->setName('FR Web Store');
        $this->channel2->setDefaultLocale($this->locale);
        $this->channel2->setBaseCurrency($this->currency);
        $this->channel2->setTaxCalculationStrategy('order_items_based');
        $this->channel2->setHostname('store.fr');

        $this->channel2->addLocale($this->locale);
        $this->channel2->addLocale($this->locale2);

        $this->getEntityManager()->persist($this->channel2);
        $this->getEntityManager()->flush();

        $this->generateSitemaps();
    }

    public function testShowActionResponse()
    {
        $response = $this->getBufferedResponse('http://store.fr/sitemap/static.xml');

        $this->assertResponse($response, 'show_sitemap_static_fr');
    }
}
