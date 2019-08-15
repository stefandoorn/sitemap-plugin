<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use function Safe\sprintf;
use SitemapPlugin\Filesystem\Reader;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\HttpFoundation\Response;

final class SitemapIndexController extends AbstractController
{
    /** @var ChannelContextInterface */
    private $channelContext;

    public function __construct(
        ChannelContextInterface $channelContext,
        Reader $reader
    ) {
        $this->channelContext = $channelContext;

        parent::__construct($reader);
    }

    public function showAction(): Response
    {
        $path = sprintf('%s/%s', $this->channelContext->getChannel()->getCode(), 'sitemap_index.xml');

        return $this->createResponse($path);
    }
}
