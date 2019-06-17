<?php

declare(strict_types=1);

namespace SitemapPlugin\Command;

use SitemapPlugin\Builder\SitemapIndexBuilderInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GenerateSitemapIndexCommand extends Command
{

    /** @var SitemapIndexBuilderInterface */
    protected $sitemapBuilder;

    /** @var SitemapRendererInterface */
    protected $sitemapRenderer;

    /** @var string */
    private $publicDir;

    public function __construct(
        SitemapRendererInterface $sitemapRenderer,
        SitemapIndexBuilderInterface $sitemapBuilder,
        string $publicDir
    ) {
        $this->sitemapRenderer = $sitemapRenderer;
        $this->sitemapBuilder = $sitemapBuilder;
        /** @TODO replace this with a writer class - check how sylius does this */
        $this->publicDir = $publicDir;

        parent::__construct();
    }

    /** @TODO */
    protected function configure(): void
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $sitemap = $this->sitemapBuilder->build();
        $xml = $this->sitemapRenderer->render($sitemap);

        file_put_contents(
            sprintf('%s/sitemap_index.xml', $this->publicDir),
            $xml
        );
    }
}
