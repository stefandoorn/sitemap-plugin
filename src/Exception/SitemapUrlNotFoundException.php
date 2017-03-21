<?php
 
namespace SyliusSitemapBundle\Exception;

use SyliusSitemapBundle\Model\SitemapUrlInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
class SitemapUrlNotFoundException extends \Exception
{
    /**
     * {@inheritdoc}
     */
    public function __construct(SitemapUrlInterface $sitemapUrl, \Exception $previousException = null)
    {
        parent::__construct(sprintf('Sitemap url %s not found', $sitemapUrl->getLocalization()), 0, $previousException);
    }
}
