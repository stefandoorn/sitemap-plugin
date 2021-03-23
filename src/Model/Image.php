<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

final class Image implements ImageInterface
{
    private string $location;

    private ?string $title = null;

    private ?string $caption = null;

    private ?string $geoLocation = null;

    private ?string $license = null;

    public function __construct(string $location)
    {
        $this->setLocation($location);
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): void
    {
        $this->caption = $caption;
    }

    public function getGeoLocation(): ?string
    {
        return $this->geoLocation;
    }

    public function setGeoLocation(string $geoLocation): void
    {
        $this->geoLocation = $geoLocation;
    }

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(string $license): void
    {
        $this->license = $license;
    }
}
