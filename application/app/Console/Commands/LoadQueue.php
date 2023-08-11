<?php

namespace App\Console\Commands;

use App\Jobs\DownloadDataFile;
use App\Models;
use Illuminate\Console\Command;

/**
 * Class LoadQueue
 * @package App\Console\Commands
 * Load all available municipalities and put them into queue to processing
 */
class LoadQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load queue data to process them further';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->output->writeln('Load things to queue');
        DownloadDataFile::dispatch();

        return Command::SUCCESS;
    }
}
