<?php

declare(strict_types=1);

namespace spec\SitemapPlugin\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use SitemapPlugin\Model\ChangeFrequency;
use SitemapPlugin\Model\ImageInterface;
use SitemapPlugin\Model\Url;
use SitemapPlugin\Model\UrlInterface;

final class UrlSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith('location');
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(Url::class);
    }

    function it_implements_sitemap_url_interface(): void
    {
        $this->shouldImplement(UrlInterface::class);
    }

    function it_has_localization(): void
    {
        $this->setLocation('http://sylius.org/');
        $this->getLocation()->shouldReturn('http://sylius.org/');
    }

    function it_has_last_modification(\DateTime $now): void
    {
        $this->setLastModification($now);
        $this->getLastModification()->shouldReturn($now);
    }

    function it_has_change_frequency(): void
    {
        $this->setChangeFrequency(ChangeFrequency::always());
        $this->getChangeFrequency()->shouldReturn('always');
    }

    function it_has_priority(): void
    {
        $this->setPriority(0.5);
        $this->getPriority()->shouldReturn(0.5);
    }

    function it_throws_invalid_argument_exception_if_priority_wont_be_between_zero_and_one(): void
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', [-1]);
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', [-0.5]);
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', [2]);
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', [1.1]);
    }

    function it_initializes_image_collection_by_default(): void
    {
        $this->getImages()->shouldHaveType(Collection::class);
    }

    function it_adds_an_image(ImageInterface $image): void
    {
        $this->addImage($image);
        $this->hasImages()->shouldReturn(true);
        $this->hasImage($image)->shouldReturn(true);
    }

    function it_removes_an_image(ImageInterface $image): void
    {
        $this->addImage($image);
        $this->removeImage($image);
        $this->hasImages()->shouldReturn(false);
        $this->hasImage($image)->shouldReturn(false);
    }

    function it_returns_images(ImageInterface $image): void
    {
        $this->addImage($image);
        $this->getImages()->shouldBeLike(new ArrayCollection([$image->getWrappedObject()]));
    }
}
