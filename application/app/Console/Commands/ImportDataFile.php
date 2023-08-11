<?php

namespace App\Console\Commands;

use App\Models\CountryData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Psr\Log\LoggerInterface;

/**
 * Class ImportDataFile
 * @package App\Console\Commands
 * Import downloaded data
 */
class ImportDataFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-data-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from downloaded file from remote source';

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
        $this->output->writeln('Extracting countries data');

        $source = 'countries.json';

        try {
            // load from local file
            $content = Storage::disk('local')->get($source);
            if (empty($content)) {
                throw new \Exception('No data from file');
            }

            // extract JSON
            $structure = json_decode($content, true);
            if (empty($structure)) {
                throw new \Exception('Cannot extract json');
            }

            // import into DB
            foreach ($structure as $country) {
                $data = new CountryData();
                $data->country_code = $country['cca3'];
                $data->json_data = $country;
                $data->save();
            }

            // now get data and make that MxN relations
            CountryData::resetNeighbours();

        } catch (\Throwable $ex) {
            $this->logger->error(sprintf('ImportDataFile error *%s* - trace: %s', $ex->getMessage(), $ex->getTraceAsString()));
            $this->error(sprintf('ImportDataFile error *%s* - trace: %s', $ex->getMessage(), $ex->getTraceAsString()));
            return Command::FAILURE;

        } finally {
            if (!empty($stream)) {
                fclose($stream);
            }
        }

        $this->output->writeln('Import remote data done');
        return Command::SUCCESS;
    }
}
