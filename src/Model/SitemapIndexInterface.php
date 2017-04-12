<?php

namespace SitemapPlugin\Model;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexInterface
{
    /**
     * @return SitemapUrlInterface[]
     */
    public function getUrls();

    /**
     * @param SitemapUrlInterface[] $urlSet
     */
    public function setUrls(array $urlSet);

    /**
     * @param SitemapUrlInterface $url
     */
    public function addUrl(SitemapUrlInterface $url);

    /**
     * @param SitemapUrlInterface $url
     */
    public function removeUrl(SitemapUrlInterface $url);

    /**
     * @return \DateTime
     */
    public function getLastModification();

    /**
     * @param \DateTime $lastModification
     */
    public function setLastModification(\DateTime $lastModification);
}
