<?php

declare(strict_types=1);

namespace SitemapPlugin\Exception;

use Exception;

final class RouteExistsException extends Exception
{
    public function __construct(string $routeName, Exception $previousException = null)
    {
        $template = 'Sitemap route "%s" already exists, probably a provider with a non-unique name';

        parent::__construct(\sprintf($template, $routeName), 0, $previousException);
    }
}
