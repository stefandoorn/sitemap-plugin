<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

use ApiTestCase\XmlApiTestCase as BaseXmlApiTestCase;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpFoundation\Response;

abstract class XmlApiTestCase extends BaseXmlApiTestCase
{
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->dataFixturesPath = __DIR__ . '/../DataFixtures/ORM';
        $this->expectedResponsesPath = __DIR__ . '/../Responses/';
    }

    protected function generateSitemaps(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('sylius:sitemap:generate');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['command' => $command->getName()]);
    }

    protected function getBufferedResponse(string $uri): Response
    {
        \ob_start();
        $this->client->request('GET', $uri);
        $response = $this->client->getResponse();
        $contents = \ob_get_clean();

        return new Response($contents, $response->getStatusCode(), $response->headers->all());
    }

    protected function deleteSitemaps(): void
    {
        if (null !== $this->client && null !== $this->client->getContainer()) {
            $dir = $this->client->getContainer()->getParameter('sylius.sitemap.path');

            if (!empty($dir) && \is_dir($dir)) {
                $it = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
                $it = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
                foreach ($it as $file) {
                    if ($file->isDir()) {
                        \rmdir($file->getPathname());

                        continue;
                    }

                    \unlink($file->getPathname());
                }
                \rmdir($dir);
            }
        }
    }
}
