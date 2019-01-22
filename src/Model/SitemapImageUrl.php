<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

class SitemapImageUrl implements SitemapImageUrlInterface
{
    /** @var string */
    private $localization;

    /** @var string */
    private $title;

    /** @var string */
    private $caption;

    /** @var string */
    private $geo_location;

    /** @var string */
    private $license;

    public function getLocalization(): string
    {
        return $this->localization ?? '';
    }

    public function setLocalization(string $localization): void
    {
        $this->localization = $localization;
    }

    public function getTitle(): string
    {
        return $this->title ?? '';
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCaption(): string
    {
        return $this->caption ?? '';
    }

    public function setCaption(string $caption): void
    {
        $this->caption = $caption;
    }

    public function getGeoLocation(): string
    {
        return $this->geo_location ?? '';
    }

    public function setGeoLocation(string $geo_location): void
    {
        $this->geo_location = $geo_location;
    }

    public function getLicense(): string
    {
        return $this->license ?? '';
    }

    public function setLicense(string $license): void
    {
        $this->license = $license;
    }
}
