<?php

declare(strict_types=1);

namespace SitemapPlugin\Builder\Model;

final class ChangeFrequency
{
    private string $value;

    private function __construct(string $changeFrequency)
    {
        $this->value = $changeFrequency;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function always(): self
    {
        return new self('always');
    }

    public static function hourly(): self
    {
        return new self('hourly');
    }

    public static function daily(): self
    {
        return new self('daily');
    }

    public static function weekly(): self
    {
        return new self('weekly');
    }

    public static function monthly(): self
    {
        return new self('monthly');
    }

    public static function yearly(): self
    {
        return new self('yearly');
    }

    public static function never(): self
    {
        return new self('never');
    }
}
