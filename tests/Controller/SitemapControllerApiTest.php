<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\SyliusSitemapBundle\Controller;

use Lakion\ApiTestCase\XmlApiTestCase;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
class SitemapControllerApiTest extends XmlApiTestCase
{
    /**
     * @before
     */
    public function setUpDatabase()
    {
        /*
        $em = static::$sharedKernel->getContainer()->get('doctrine.orm.entity_manager');
        $em->getConnection()->connect();*/

        passthru('php tests/Application/bin/console doctrine:schema:update --force --env=test');
        parent::setUpDatabase();
        passthru('php tests/Application/bin/console sylius:fixtures:load --env=test');

    }

    public function testShowActionResponse()
    {
        //$this->loadFixturesFromFile('resources/products.yml');
        $this->client->request('GET', '/sitemap.xml');

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'show_sitemap');
    }
}
