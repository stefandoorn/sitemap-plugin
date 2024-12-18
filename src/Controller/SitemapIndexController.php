<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use SitemapPlugin\Filesystem\Reader;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\HttpFoundation\Response;

final class SitemapIndexController extends AbstractController
{
    public function __construct(
        private readonly ChannelContextInterface $channelContext,
        Reader $reader,
    ) {
        parent::__construct($reader);
    }

    public function showAction(): Response
    {
        $path = \sprintf('%s/%s', $this->channelContext->getChannel()->getCode(), 'sitemap_index.xml');

        return $this->createResponse($path);
    }
}
