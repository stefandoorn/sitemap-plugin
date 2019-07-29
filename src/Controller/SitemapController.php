<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use SitemapPlugin\Filesystem\Reader;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\HttpFoundation\Response;

final class SitemapController extends AbstractController
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

    public function showAction(string $name): Response
    {
        $path = \sprintf('%s/%s', $this->channelContext->getChannel()->getCode(), sprintf('sitemap/%s.xml', $name));

        return $this->createResponse($path);
    }
}
