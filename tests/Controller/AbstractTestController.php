<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

use ApiTestCase\XmlApiTestCase;
use SitemapPlugin\Command\GenerateSitemapCommand;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Model\Channel;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Currency\Model\Currency;
use Sylius\Component\Currency\Model\CurrencyInterface;
use Sylius\Component\Locale\Model\Locale;
use Sylius\Component\Locale\Model\LocaleInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractTestController extends XmlApiTestCase
{
    /** @var ChannelInterface */
    protected $channel;

    /** @var LocaleInterface */
    protected $locale;

    /** @var LocaleInterface */
    protected $locale2;

    /** @var CurrencyInterface */
    protected $currency;

    /**
     * @before
     */
    public function setupDatabase(): void
    {
        var_dump($_SERVER['IS_DOCTRINE_ORM_SUPPORTED']);
        parent::setUpDatabase();

        var_dump('start fixtures');

        $this->locale = new Locale();
        $this->locale->setCode('en_US');

        $this->getEntityManager()->persist($this->locale);

        $this->locale2 = new Locale();
        $this->locale2->setCode('nl_NL');

        $this->getEntityManager()->persist($this->locale2);

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
        $this->channel->addLocale($this->locale2);

        var_dump('save fixtures');

        $this->getEntityManager()->persist($this->channel);
        $this->getEntityManager()->flush();

        var_dump('done saving fixtures');
    }

    protected function generateSitemaps(): void
    {
        var_dump('generating sitemaps');
        $application = new Application(self::getKernelClass());

        /** @var ChannelRepositoryInterface $channelRepository */
        $channelRepository = self::$container->get('sylius.repository.channel');

        $application->addCommands([new GenerateSitemapCommand(
            self::$container->get('sylius.sitemap_renderer'),
            self::$container->get('sylius.sitemap_index_renderer'),
            self::$container->get('sylius.sitemap_builder'),
            self::$container->get('sylius.sitemap_index_builder'),
            self::$container->get('sylius.sitemap_writer'),
            $channelRepository,
        )]);
        $command = $application->find('sylius:sitemap:generate');
        $commandTester = new CommandTester($command);
        //$commandTester->getOutput()->setVerbosity(OutputInterface::VERBOSITY_DEBUG);
        var_dump('executing command');
        $commandTester->execute(['command' => $command->getName()], ['capture_stderr_separately' => true]);
        var_dump($commandTester->getErrorOutput());
        var_dump($commandTester->getDisplay());
        //var_dump($commandTester);
    }

    protected function getBufferedResponse(string $uri): Response
    {
        var_dump($uri);

        \ob_start();
        $this->client->request('GET', $uri);
        /** @var \Symfony\Component\HttpFoundation\Response $response */
        $response = $this->client->getResponse();
        $contents = \ob_get_contents();
        \ob_end_clean();

        var_dump($contents);

        return new Response($contents, $response->getStatusCode(), $response->headers->all());
    }
}
