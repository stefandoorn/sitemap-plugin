<?php
 
namespace SitemapPlugin\Exception;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class RouteExistsException extends \Exception
{
    /**
     * {@inheritdoc}
     */
    public function __construct($routeName, \Exception $previousException = null)
    {
        parent::__construct(sprintf('Sitemap route %s already exists, probably a provider with a non-unique name', $routeName), 0, $previousException);
    }
}
