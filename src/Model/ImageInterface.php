<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSitemapPlugin\Model;

interface ImageInterface
{
    public function getLocation(): string;

    public function setLocation(string $location): void;

    public function getTitle(): ?string;

    public function setTitle(string $title): void;

    public function getCaption(): ?string;

    public function setCaption(string $caption): void;

    public function getGeoLocation(): ?string;

    public function setGeoLocation(string $geoLocation): void;

    public function getLicense(): ?string;

    public function setLicense(string $license): void;
}
