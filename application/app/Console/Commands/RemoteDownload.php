<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Psr\Log\LoggerInterface;

/**
 * Class RemoteDownload
 * @package App\Console\Commands
 * Download JSON file with country data
 * @link https://raw.githubusercontent.com/mledoze/countries/master/countries.json
 */
class RemoteDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remote-download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download country file from github';

    /** @var LoggerInterface */
    protected $logger = null;

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct();
        $this->logger = $logger;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->logger->info('Downloading country data');
        $this->output->writeln('Downloading country data');

        $file = 'countries.json';
        $link = 'https://raw.githubusercontent.com/mledoze/countries/master/countries.json';

        try {
            if (!Storage::disk('local')->exists($file)) {
                // source is online

                $content = file_get_contents($link);
                if (false !== $content) {
                    Storage::disk('local')->put($file, $content);
                } else {
                    $this->logger->error('Cannot get country file');
                    $this->error('Cannot get country file');
                    return Command::FAILURE;
                }
            }
        } catch (\Throwable $ex) {
            $this->logger->error(sprintf('RemoteDownload error *%s* - trace: %s', $ex->getMessage(), $ex->getTraceAsString()));
            $this->error(sprintf('RemoteDownload error *%s* - trace: %s', $ex->getMessage(), $ex->getTraceAsString()));
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
