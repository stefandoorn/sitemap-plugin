<?php

declare(strict_types=1);

namespace SitemapPlugin\Controller;

use SitemapPlugin\Filesystem\Reader;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Symfony\Component\HttpFoundation\Response;

final class SitemapIndexController extends AbstractController
{

    /** @var ChannelContextInterface */
    private $channelContext;

    /** @var Reader  */
    private $reader;

    public function __construct(
        ChannelContextInterface $channelContext,
        Reader $reader
    ) {
        $this->channelContext = $channelContext;
        $this->reader = $reader;
    }

    public function showAction(): Response
    {
        $data = $this->reader->get(sprintf('%s/%s', $this->channelContext->getCode(), 'sitemap_index.xml')); // @todo put this in a service - its duplicated now
        
        return $this->createXmlResponse($data);
    }
}
