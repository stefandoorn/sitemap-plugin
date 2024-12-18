<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use SitemapPlugin\Filesystem\Reader;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\HttpFoundation\Response;

final class SitemapController extends AbstractController
{
    public function __construct(
        private readonly ChannelContextInterface $channelContext,
        Reader $reader,
    ) {
        parent::__construct($reader);
    }

    public function showAction(string $name): Response
    {
        $path = \sprintf('%s/%s', $this->channelContext->getChannel()->getCode(), \sprintf('%s.xml', $name));

        return $this->createResponse($path);
    }
}
