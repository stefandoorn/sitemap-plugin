<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Model;

interface AlternativeUrlInterface
{
    public function getLocation(): string;

    public function setLocation(string $location): void;

    public function getLocale(): string;

    public function setLocale(string $locale): void;
}
