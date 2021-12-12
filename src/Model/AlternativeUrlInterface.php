<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

interface AlternativeUrlInterface
{
    public function getLocation(): string;

    public function setLocation(string $location): void;

    public function getLocale(): string;

    public function setLocale(string $locale): void;
}
