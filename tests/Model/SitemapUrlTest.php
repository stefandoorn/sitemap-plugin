<?php

declare(strict_types=1);

namespace Tests\SitemapPlugin\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;
use SitemapPlugin\Model\Image;
use SitemapPlugin\Model\Url;

final class SitemapUrlTest extends TestCase
{
    public function testHasImage(): void
    {
        $obj = new Url('location');
        $image = new Image('location');

        $this->assertFalse($obj->hasImage($image));

        $obj->addImage($image);

        $this->assertTrue($obj->hasImage($image));
    }

    public function testSetImages(): void
    {
        $obj = new Url('location');
        $image = new Image('location');
        $collection = new ArrayCollection([$image]);
        $obj->setImages($collection);

        $this->assertInstanceOf(Collection::class, $obj->getImages());
        $this->assertInstanceOf(ArrayCollection::class, $obj->getImages());
        $this->assertCount(1, $obj->getImages());

        $this->assertTrue($obj->hasImage($image));
    }

    public function testHasImages(): void
    {
        $obj = new Url('location');
        $image = new Image('location');

        $this->assertFalse($obj->hasImages());

        $obj->addImage($image);

        $this->assertTrue($obj->hasImages());
    }

    public function testGetImages(): void
    {
        $obj = new Url('location');
        $image = new Image('location');

        $obj->addImage($image);

        $this->assertInstanceOf(Collection::class, $obj->getImages());
        $this->assertInstanceOf(ArrayCollection::class, $obj->getImages());
        $this->assertCount(1, $obj->getImages());
    }

    public function testAddImage(): void
    {
        $obj = new Url('location');
        $image = new Image('location');

        $obj->addImage($image);
        $this->assertTrue($obj->hasImages());
    }

    public function testRemoveImage(): void
    {
        $obj = new Url('location');
        $image = new Image('location');

        $this->assertFalse($obj->hasImages());

        $obj->addImage($image);

        $this->assertTrue($obj->hasImages());

        $obj->removeImage($image);
        $this->assertFalse($obj->hasImages());
        $this->assertFalse($obj->hasImage($image));
    }
}
