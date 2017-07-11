<?php

namespace SitemapPlugin\Model;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
interface SitemapUrlInterface
{
    /**
     * @return string
     */
    public function getLocalization();

    /**
     * @param string $localization
     */
    public function setLocalization($localization);

    /**
     * {@inheritdoc}
     */
    public function addAlternative($location, $locale);

    /**
     * {@inheritdoc}
     */
    public function setAlternatives(array $alternatives);

    /**
     * {@inheritdoc}
     */
    public function getAlternatives();

    /**
     * @return \DateTime
     */
    public function getLastModification();

    /**
     * @param \DateTime $lastModification
     */
    public function setLastModification(\DateTime $lastModification);

    /**
     * @return string
     */
    public function getChangeFrequency();

    /**
     * @param ChangeFrequency $changeFrequency
     */
    public function setChangeFrequency(ChangeFrequency $changeFrequency);

    /**
     * @return float
     */
    public function getPriority();

    /**
     * @param float $priority
     */
    public function setPriority($priority);
}
