<?php declare(strict_types=1);
 
namespace SitemapPlugin\Model;

use SitemapPlugin\Exception\SitemapUrlNotFoundException;
use DateTimeInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 * @author Stefan Doorn <stefan@efectos.nl>
 */
class Sitemap implements SitemapInterface
{
    /**
     * @var array
     */
    private $urls = [];

    /**
     * @var string
     */
    private $localization;

    /**
     * @var DateTimeInterface
     */
    private $lastModification;

    /**
     * {@inheritdoc}
     */
    public function setUrls(array $urls): void
    {
        $this->urls = $urls;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrls(): iterable
    {
        return $this->urls;
    }

    /**
     * {@inheritdoc}
     */
    public function addUrl(SitemapUrlInterface $url): void
    {
        $this->urls[] = $url;
    }

    /**
     * {@inheritdoc}
     */
    public function removeUrl(SitemapUrlInterface $url): void
    {
        $key = array_search($url, $this->urls, true);
        if (false === $key) {
            throw new SitemapUrlNotFoundException($url);
        }

        unset($this->urls[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function setLocalization(string $localization): void
    {
        $this->localization = $localization;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocalization(): ?string
    {
        return $this->localization;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastModification(DateTimeInterface $lastModification): void
    {
        $this->lastModification = $lastModification;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastModification(): ?DateTimeInterface
    {
        return $this->lastModification;
    }
}
