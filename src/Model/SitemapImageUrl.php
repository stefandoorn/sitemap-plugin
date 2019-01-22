<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

class SitemapImageUrl implements SitemapImageUrlInterface
{
    /** @var string */
    private $location;

    /** @var string|null */
    private $title;

    /** @var string|null */
    private $caption;

    /** @var string|null */
    private $geoLocation;

    /** @var string|null */
    private $license;

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $localization): void
    {
        $this->location = $localization;
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
