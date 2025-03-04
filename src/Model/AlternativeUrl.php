<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

final class AlternativeUrl implements AlternativeUrlInterface
{
    public function __construct(
        private string $location,
        private string $locale,
    ) {
        $this->setLocation($location);
        $this->setLocale($locale);
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }
}
