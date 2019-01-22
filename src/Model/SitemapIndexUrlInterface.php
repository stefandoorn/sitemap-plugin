<?php

declare(strict_types=1);

namespace SitemapPlugin\Model;

use DateTimeInterface;

interface SitemapIndexUrlInterface
{
    /**
     * @return string
     */
    public function getLocalization(): ?string;

    public function setLocalization(string $localization): void;

    /**
     * @return DateTimeInterface
     */
    public function getLastModification(): ?DateTimeInterface;

    public function setLastModification(DateTimeInterface $lastModification);
}
