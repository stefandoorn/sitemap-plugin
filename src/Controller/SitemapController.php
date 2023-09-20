<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use SitemapPlugin\Filesystem\Reader;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\HttpFoundation\Response;

final class SitemapController extends AbstractController
{
    private ChannelContextInterface $channelContext;

    public function __construct(
        ChannelContextInterface $channelContext,
        Reader $reader
    ) {
        $this->channelContext = $channelContext;

        parent::__construct($reader);
    }

    public function showAction(string $name, int $index): Response
    {
        $path = \sprintf('%s/%s', $this->channelContext->getChannel()->getCode(), \sprintf('%s_%d.xml', $name, $index));

        return $this->createResponse($path);
    }
}
