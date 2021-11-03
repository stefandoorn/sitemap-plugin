<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Controller;

use StefanDoorn\SyliusSitemapPlugin\Filesystem\Reader;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\HttpFoundation\Response;

final class SitemapIndexController extends AbstractController
{
    private ChannelContextInterface $channelContext;

    public function __construct(
        ChannelContextInterface $channelContext,
        Reader $reader
    ) {
        $this->channelContext = $channelContext;

        parent::__construct($reader);
    }

    public function showAction(): Response
    {
        $path = \sprintf('%s/%s', $this->channelContext->getChannel()->getCode() ?? 'no_code', 'sitemap_index.xml');

        return $this->createResponse($path);
    }
}
