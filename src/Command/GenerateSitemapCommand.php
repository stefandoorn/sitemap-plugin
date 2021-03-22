<?php

declare(strict_types=1);

namespace SitemapPlugin\Command;

use SitemapPlugin\Builder\SitemapBuilderInterface;
use SitemapPlugin\Builder\SitemapIndexBuilderInterface;
use SitemapPlugin\Filesystem\Writer;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class GenerateSitemapCommand extends Command
{
    /** @var \SitemapPlugin\Builder\SitemapBuilderInterface */
    private $sitemapBuilder;

    /** @var SitemapIndexBuilderInterface */
    private $sitemapIndexBuilder;

    /** @var SitemapRendererInterface */
    private $sitemapRenderer;

    /** @var SitemapRendererInterface */
    private $sitemapIndexRenderer;

    /** @var Writer */
    private $writer;

    /** @var ChannelRepositoryInterface */
    private $channelRepository;

    public function __construct(
        SitemapRendererInterface $sitemapRenderer,
        SitemapRendererInterface $sitemapIndexRenderer,
        SitemapBuilderInterface $sitemapBuilder,
        SitemapIndexBuilderInterface $sitemapIndexBuilder,
        Writer $writer,
        ChannelRepositoryInterface $channelRepository
    ) {
        $this->sitemapRenderer = $sitemapRenderer;
        $this->sitemapIndexRenderer = $sitemapIndexRenderer;
        $this->sitemapBuilder = $sitemapBuilder;
        $this->sitemapIndexBuilder = $sitemapIndexBuilder;
        $this->writer = $writer;
        $this->channelRepository = $channelRepository;

        parent::__construct('sylius:sitemap:generate');
    }

    protected function configure(): void
    {
        $this->addOption('channel', 'c', InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, 'Channel codes to generate. If none supplied, all channels will generated.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->channels($input) as $channel) {
            $this->executeChannel($channel, $output);
        }

        return 0;
    }

    private function executeChannel(ChannelInterface $channel, OutputInterface $output): void
    {
        // TODO make sure providers are every time emptied (reset call or smth?)
        var_dump('Providers count: ' . count($this->sitemapBuilder->getProviders()));
        foreach ($this->sitemapBuilder->getProviders() as $provider) {
            $output->writeln(\sprintf('Start generating sitemap "%s" for channel "%s"', $provider->getName(), $channel->getCode()));

            $sitemap = $this->sitemapBuilder->build($provider, $channel); // TODO use provider instance, not the name
            $xml = $this->sitemapRenderer->render($sitemap);
            $path = $path = $this->path($channel, \sprintf('%s.xml', $provider->getName()));
            var_dump('write path', $path);

            $this->writer->write(
                $path,
                $xml
            );

            $output->writeln(\sprintf('Finished generating sitemap "%s" for channel "%s" at path "%s"', $provider->getName(), $channel->getCode(), $path));
        }

        $output->writeln(\sprintf('Start generating sitemap index for channel "%s"', $channel->getCode()));

        $sitemap = $this->sitemapIndexBuilder->build();
        $xml = $this->sitemapIndexRenderer->render($sitemap);
        $path = $this->path($channel, 'sitemap_index.xml');

        $this->writer->write(
            $path,
            $xml
        );

        $output->writeln(\sprintf('Finished generating sitemap index for channel "%s" at path "%s"', $channel->getCode(), $path));
    }

    private function path(ChannelInterface $channel, string $path): string
    {
        return \sprintf('%s/%s', $channel->getCode(), $path);
    }

    /**
     * @return ChannelInterface[]
     */
    private function channels(InputInterface $input): iterable
    {
        if (null !== $input->getOption('channel')) {
            return $this->channelRepository->findBy(['code' => $input->getOption('channel'), 'enabled' => true]);
        }

        return $this->channelRepository->findBy(['enabled' => true]);
    }
}
