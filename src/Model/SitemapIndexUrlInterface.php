<?php

namespace SyliusSitemapBundle\Model;

/**
 * @author Stefan Doorn <stefan@efectos.nl>
 */
interface SitemapIndexUrlInterface
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
     * @return \DateTime
     */
    public function getLastModification();

    /**
     * @param \DateTime $lastModification
     */
    public function setLastModification(\DateTime $lastModification);
}
