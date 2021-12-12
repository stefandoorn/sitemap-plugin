<?php

declare(strict_types=1);

namespace SitemapPlugin\Exception;

use SitemapPlugin\Model\UrlInterface;

final class SitemapUrlNotFoundException extends \Exception
{
    public function __construct(UrlInterface $sitemapUrl, \Exception $previousException = null)
    {
        $template = 'Sitemap url "%s" not found';

        parent::__construct(\sprintf($template, $sitemapUrl->getLocation()), 0, $previousException);
    }
}
