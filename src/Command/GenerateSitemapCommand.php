<?php

declare(strict_types=1);

namespace SitemapPlugin\Command;

use SitemapPlugin\Builder\SitemapBuilderInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GenerateSitemapCommand extends Command
{

    /** @TODO implement filter from SitemapController to save to separate files */

    /** @var SitemapRendererInterface */
    private $sitemapRenderer;

    /** @var SitemapBuilderInterface */
    private $sitemapBuilder;

    /** @var string */
    private $publicDir;

    public function __construct(
        SitemapRendererInterface $sitemapRenderer,
        SitemapBuilderInterface $sitemapBuilder,
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
        $sitemap = $this->sitemapBuilder->build($filter = []);
        $xml = $this->sitemapRenderer->render($sitemap);

        file_put_contents(
            sprintf('%s/sitemap/all.xml', $this->publicDir),
            $xml
        );
    }
}
