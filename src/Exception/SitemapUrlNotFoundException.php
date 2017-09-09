<?php declare(strict_types=1);

namespace SitemapPlugin\Exception;

use SitemapPlugin\Model\SitemapUrlInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class SitemapUrlNotFoundException extends \Exception
{
    /**
     * {@inheritdoc}
     */
    public function __construct(SitemapUrlInterface $sitemapUrl, \Exception $previousException = null)
    {
        $template = 'Sitemap url "%s" not found';

        parent::__construct(sprintf($template, $sitemapUrl->getLocalization()), 0, $previousException);
    }
}
