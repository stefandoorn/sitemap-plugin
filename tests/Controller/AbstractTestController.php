<?php

namespace Tests\SitemapPlugin\Controller;

use Lakion\ApiTestCase\XmlApiTestCase;
use Sylius\Component\Core\Model\Channel;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Currency\Model\Currency;
use Sylius\Component\Currency\Model\CurrencyInterface;
use Sylius\Component\Locale\Model\Locale;
use Sylius\Component\Locale\Model\LocaleInterface;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
abstract class AbstractTestController extends XmlApiTestCase
{
    /**
     * @var ChannelInterface
     */
    protected $channel;

    /**
     * @var LocaleInterface
     */
    protected $locale;

    /**
     * @var CurrencyInterface
     */
    protected $currency;
    
    /**
     * @before
     */
    public function setupDatabase()
    {
        parent::setUpDatabase();

        $this->locale = new Locale();
        $this->locale->setCode('en_US');

        $this->getEntityManager()->persist($this->locale);

        $locale = new Locale();
        $locale->setCode('nl_NL');

        $this->getEntityManager()->persist($locale);

        $this->currency = new Currency();
        $this->currency->setCode('USD');

        $this->getEntityManager()->persist($this->currency);

        $this->channel = new Channel();
        $this->channel->setCode('US_WEB');
        $this->channel->setName('US Web Store');
        $this->channel->setDefaultLocale($this->locale);
        $this->channel->setBaseCurrency($this->currency);
        $this->channel->setTaxCalculationStrategy('order_items_based');

        $this->channel->addLocale($this->locale);

        $this->getEntityManager()->persist($this->channel);
        $this->getEntityManager()->flush();
    }
}
