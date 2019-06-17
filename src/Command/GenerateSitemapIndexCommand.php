<?php

declare(strict_types=1);

namespace SitemapPlugin\Command;

use SitemapPlugin\Builder\SitemapIndexBuilderInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use SitemapPlugin\Writer\FilesystemWriter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GenerateSitemapIndexCommand extends Command
{

    /** @var SitemapIndexBuilderInterface */
    protected $sitemapBuilder;

    /** @var SitemapRendererInterface */
    protected $sitemapRenderer;

    /** @var FilesystemWriter */
    protected $writer;

    public function __construct(
        SitemapRendererInterface $sitemapRenderer,
        SitemapIndexBuilderInterface $sitemapBuilder,
        FilesystemWriter $writer
    ) {
        $this->sitemapRenderer = $sitemapRenderer;
        $this->sitemapBuilder = $sitemapBuilder;
        $this->writer = $writer;

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

        $this->writer->write(
            sprintf('%ssitemap_index.xml', $this->publicDir),
            $xml
        );
    }
}
