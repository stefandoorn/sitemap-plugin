<?php

declare(strict_types=1);

namespace SitemapPlugin\Exception;

use function Safe\sprintf;

final class RouteExistsException extends \Exception
{
    /**
     * {@inheritdoc}
     */
    public function __construct($routeName, \Exception $previousException = null)
    {
        $template = 'Sitemap route "%s" already exists, probably a provider with a non-unique name';

        parent::__construct(sprintf($template, $routeName), 0, $previousException);
    }
}
