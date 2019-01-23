<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Controller;

trait TearDownTrait
{
    public function tearDown(): void
    {
        if (null !== $this->client && null !== $this->client->getContainer()) {
            if (\method_exists($this->client->getContainer(), 'getMockedServices')) {
                foreach ($this->client->getContainer()->getMockedServices() as $id => $service) {
                    $this->client->getContainer()->unmock($id);
                }
            }
        }

        \Mockery::close();
        $this->client = null;
        $this->entityManager = null;
        $this->fixtureLoader = null;
    }
}
