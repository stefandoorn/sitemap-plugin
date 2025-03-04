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

        self::assertFalse($obj->hasImage($image));

        $obj->addImage($image);

        self::assertTrue($obj->hasImage($image));
    }

    public function testSetImages(): void
    {
        $obj = new Url('location');
        $image = new Image('location');
        $collection = new ArrayCollection([$image]);
        $obj->setImages($collection);

        self::assertInstanceOf(Collection::class, $obj->getImages());
        self::assertInstanceOf(ArrayCollection::class, $obj->getImages());
        self::assertCount(1, $obj->getImages());

        self::assertTrue($obj->hasImage($image));
    }

    public function testHasImages(): void
    {
        $obj = new Url('location');
        $image = new Image('location');

        self::assertFalse($obj->hasImages());

        $obj->addImage($image);

        self::assertTrue($obj->hasImages());
    }

    public function testGetImages(): void
    {
        $obj = new Url('location');
        $image = new Image('location');

        $obj->addImage($image);

        self::assertInstanceOf(Collection::class, $obj->getImages());
        self::assertInstanceOf(ArrayCollection::class, $obj->getImages());
        self::assertCount(1, $obj->getImages());
    }

    public function testAddImage(): void
    {
        $obj = new Url('location');
        $image = new Image('location');
        $obj->addImage($image);

        self::assertTrue($obj->hasImages());
    }

    public function testRemoveImage(): void
    {
        $obj = new Url('location');
        $image = new Image('location');

        self::assertFalse($obj->hasImages());

        $obj->addImage($image);

        self::assertTrue($obj->hasImages());

        $obj->removeImage($image);

        self::assertFalse($obj->hasImages());
        self::assertFalse($obj->hasImage($image));
    }
}
