<?php

declare(strict_types=1);

namespace SitemapPlugin\Command;

use SitemapPlugin\Builder\SitemapIndexBuilderInterface;
use SitemapPlugin\Renderer\SitemapRendererInterface;
use SitemapPlugin\Filesystem\Writer;
use Sylius\Bundle\ChannelBundle\Doctrine\ORM\ChannelRepository;
use Sylius\Component\Channel\Repository\ChannelRepositoryInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

final class GenerateSitemapIndexCommand extends Command
{

    /** @var SitemapIndexBuilderInterface */
    private $sitemapIndexBuilder;

    /** @var SitemapRendererInterface */
    private $sitemapRenderer;

    /** @var Writer */
    private $writer;

    /** @var ChannelRepositoryInterface */
    private $channelRepository;

    public function __construct(
        SitemapRendererInterface $sitemapRenderer,
        SitemapIndexBuilderInterface $sitemapIndexBuilder,
        Writer $writer,
        ChannelRepositoryInterface $channelRepository
    ) {
        $this->sitemapRenderer = $sitemapRenderer;
        $this->sitemapIndexBuilder = $sitemapIndexBuilder;
        $this->writer = $writer;
        $this->channelRepository = $channelRepository;

        parent::__construct();
    }

    /** @TODO */
    protected function configure(): void
    {
        $this->addArgument('channel', InputArgument::IS_ARRAY, 'Channel codes to render. If none supplied, all channels will generated.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        foreach($this->channels($input) as $channel) {
            $output->writeln(sprintf('Start generating sitemap index for channel "%s"', $channel->getCode()));

            $sitemap = $this->sitemapIndexBuilder->build(); // @todo does sitemap index need to know about channels?
            $xml = $this->sitemapRenderer->render($sitemap);
            $path = $this->path($channel, 'sitemap_index.xml');

            $this->writer->write(
                $path,
                $xml
            );

            $output->writeln(sprintf('Finished generating sitemap index for channel "%s" at path "%s"', $channel->getCode(), $path));
        }
    }

    private function path(ChannelInterface $channel, string $path): string
    {
        return sprintf('%s/%s', $channel->getCode(), $path);
    }

    /**
     * @return ChannelInterface[]
     */
    private function channels(InputInterface $input): array
    {
        if (!empty($input->getArgument('channel'))) {
            return $this->channelRepository->findBy(['code' => $input->getArgument('channel')]);
        }

        // return all (@todo only active)
        return $this->channelRepository->findBy(['enabled' => true]);
    }
}
